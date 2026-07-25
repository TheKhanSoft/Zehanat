@props(['headers' => []])

<div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/80 rounded-xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full admin-table text-left whitespace-nowrap">
            <thead class="bg-slate-800/80">
                <tr>
                    @foreach($headers as $header)
                        <th scope="col">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700/50">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
