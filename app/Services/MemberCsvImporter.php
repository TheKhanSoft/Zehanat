<?php

namespace App\Services;

use App\Models\Member;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RuntimeException;

class MemberCsvImporter
{
    public const MAX_ROWS = 2000;

    private const REQUIRED_HEADERS = [
        'name',
        'email',
        'phone',
        'category',
        'institution',
        'status',
        'access',
        'ban reason',
        'joined',
    ];

    /**
     * @return array{imported: int, skipped: int, total: int, errors: array<int, array{row: int, messages: array<int, string>}>}
     */
    public function import(string $path): array
    {
        $handle = fopen($path, 'rb');

        if ($handle === false) {
            throw new RuntimeException('The selected CSV file could not be opened.');
        }

        try {
            $header = fgetcsv($handle, 0, ',', '"', '');

            if ($header === false) {
                throw new RuntimeException('The selected CSV file is empty.');
            }

            $indexes = $this->headerIndexes($header);
            $rows = $this->readRows($handle, $indexes);
        } finally {
            fclose($handle);
        }

        if ($rows === []) {
            throw new RuntimeException('The CSV contains headers but no member rows.');
        }

        $existingEmails = $this->existingEmails($rows);
        $seenEmails = [];
        $validRows = [];
        $errors = [];
        $now = CarbonImmutable::now();

        foreach ($rows as $row) {
            $values = $row['values'];
            $values['email'] = strtolower(trim($values['email']));
            $values['category'] = strtolower(trim($values['category']));
            $values['status'] = strtolower(trim($values['status'])) ?: 'pending';
            $values['access'] = strtolower(trim($values['access'])) ?: 'active';
            $values['phone'] = $this->normalizePhone($values['phone']);
            $values['institution'] = trim($values['institution']) ?: null;
            $values['ban_reason'] = trim($values['ban_reason']) ?: null;
            if ($values['access'] !== 'banned') {
                $values['ban_reason'] = null;
            }

            $validator = Validator::make($values, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'phone' => ['nullable', 'string', 'regex:/^\+?[0-9]{7,15}$/'],
                'category' => ['required', Rule::in(['individual', 'institution', 'industry', 'student'])],
                'institution' => [
                    Rule::requiredIf(in_array($values['category'], ['institution', 'industry', 'student'], true)),
                    'nullable',
                    'string',
                    'max:255',
                ],
                'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
                'access' => ['required', Rule::in(['active', 'banned'])],
                'ban_reason' => [
                    Rule::requiredIf($values['access'] === 'banned'),
                    'nullable',
                    'string',
                    'min:5',
                    'max:500',
                ],
            ], [
                'phone.regex' => 'Phone must contain 7 to 15 digits with an optional leading +.',
                'category.in' => 'Category must be individual, institution, industry, or student.',
                'institution.required' => 'Institution is required for institution, industry, and student members.',
                'status.in' => 'Status must be pending, approved, or rejected.',
                'access.in' => 'Access must be Active or Banned.',
                'ban_reason.required' => 'Ban Reason is required when Access is Banned.',
            ]);

            $rowErrors = collect($validator->errors()->all());

            if ($values['access'] === 'banned' && $values['status'] !== 'approved') {
                $rowErrors->push('Only approved members can have Banned access.');
            }

            if (isset($existingEmails[$values['email']])) {
                $rowErrors->push('A member with this email already exists.');
            }

            if (isset($seenEmails[$values['email']])) {
                $rowErrors->push('Email is duplicated within this CSV file.');
            }

            $joinedAt = $this->joinedAt($values['joined'], $now);
            if ($joinedAt === false) {
                $rowErrors->push('Joined must be blank or a valid past date in YYYY-MM-DD format.');
            }

            if ($rowErrors->isNotEmpty()) {
                $errors[] = [
                    'row' => $row['number'],
                    'messages' => $rowErrors->unique()->values()->all(),
                ];

                continue;
            }

            $seenEmails[$values['email']] = true;
            $joinedAt ??= $now;

            $validRows[] = [
                'name' => trim($values['name']),
                'email' => $values['email'],
                'phone' => $values['phone'],
                'category' => $values['category'],
                'institution' => $values['institution'],
                'message' => null,
                'status' => $values['status'],
                'banned_at' => $values['access'] === 'banned' ? $now : null,
                'ban_reason' => $values['access'] === 'banned' ? $values['ban_reason'] : null,
                'created_at' => $joinedAt,
                'updated_at' => $joinedAt,
            ];
        }

        if ($validRows !== []) {
            DB::transaction(fn () => Member::query()->insert($validRows));
        }

        return [
            'imported' => count($validRows),
            'skipped' => count($errors),
            'total' => count($rows),
            'errors' => $errors,
        ];
    }

    /**
     * @param  array<int, string|null>  $header
     * @return array<string, int>
     */
    private function headerIndexes(array $header): array
    {
        if (isset($header[0])) {
            $header[0] = ltrim((string) $header[0], "\xEF\xBB\xBF");
        }

        $normalized = array_map(fn ($value) => $this->normalizeHeader((string) $value), $header);
        $duplicates = collect($normalized)->duplicates()->filter()->unique()->values();

        if ($duplicates->isNotEmpty()) {
            throw new RuntimeException('The CSV contains duplicate headers: '.$duplicates->implode(', ').'.');
        }

        $missing = collect(self::REQUIRED_HEADERS)->diff($normalized)->values();

        if ($missing->isNotEmpty()) {
            throw new RuntimeException('Missing required CSV headers: '.$missing->map(fn ($name) => ucwords($name))->implode(', ').'.');
        }

        return collect($normalized)
            ->mapWithKeys(fn ($name, $index) => [$name => $index])
            ->only(self::REQUIRED_HEADERS)
            ->all();
    }

    private function normalizeHeader(string $header): string
    {
        $header = strtolower(trim($header));
        $header = preg_replace('/\s*\([^)]*\)\s*/', '', $header) ?? $header;

        return trim(preg_replace('/[^a-z0-9]+/', ' ', $header) ?? $header);
    }

    /**
     * @param  resource  $handle
     * @param  array<string, int>  $indexes
     * @return array<int, array{number: int, values: array<string, string>}>
     */
    private function readRows($handle, array $indexes): array
    {
        $rows = [];
        $lineNumber = 1;

        while (($columns = fgetcsv($handle, 0, ',', '"', '')) !== false) {
            $lineNumber++;

            if (collect($columns)->every(fn ($value) => trim((string) $value) === '')) {
                continue;
            }

            if (count($rows) >= self::MAX_ROWS) {
                throw new RuntimeException('The CSV may contain no more than '.number_format(self::MAX_ROWS).' member rows.');
            }

            $rows[] = [
                'number' => $lineNumber,
                'values' => [
                    'name' => trim((string) ($columns[$indexes['name']] ?? '')),
                    'email' => trim((string) ($columns[$indexes['email']] ?? '')),
                    'phone' => trim((string) ($columns[$indexes['phone']] ?? '')),
                    'category' => trim((string) ($columns[$indexes['category']] ?? '')),
                    'institution' => trim((string) ($columns[$indexes['institution']] ?? '')),
                    'status' => trim((string) ($columns[$indexes['status']] ?? '')),
                    'access' => trim((string) ($columns[$indexes['access']] ?? '')),
                    'ban_reason' => trim((string) ($columns[$indexes['ban reason']] ?? '')),
                    'joined' => trim((string) ($columns[$indexes['joined']] ?? '')),
                ],
            ];
        }

        return $rows;
    }

    /**
     * @param  array<int, array{number: int, values: array<string, string>}>  $rows
     * @return array<string, true>
     */
    private function existingEmails(array $rows): array
    {
        $emails = collect($rows)
            ->pluck('values.email')
            ->map(fn ($email) => strtolower(trim($email)))
            ->filter(fn (string $email): bool => filter_var($email, FILTER_VALIDATE_EMAIL) !== false)
            ->unique();
        $existing = [];

        foreach ($emails->chunk(500) as $chunk) {
            Member::query()
                ->whereIn(DB::raw('LOWER(email)'), $chunk->all())
                ->pluck('email')
                ->each(function ($email) use (&$existing): void {
                    $existing[strtolower($email)] = true;
                });
        }

        return $existing;
    }

    private function normalizePhone(string $phone): ?string
    {
        $phone = trim($phone);

        return $phone === '' ? null : preg_replace('/[\s().-]+/', '', $phone);
    }

    private function joinedAt(string $joined, CarbonImmutable $now): CarbonImmutable|false|null
    {
        $joined = trim($joined);

        if ($joined === '') {
            return null;
        }

        $date = CarbonImmutable::createFromFormat('!Y-m-d', $joined, config('app.timezone'));
        $parseErrors = CarbonImmutable::getLastErrors();

        if ($date === null || ($parseErrors !== false && ($parseErrors['warning_count'] > 0 || $parseErrors['error_count'] > 0))) {
            return false;
        }

        return $date->isFuture() ? false : $date;
    }
}
