@props(['headers' => []])

<div {{ $attributes->merge(['class' => 'overflow-hidden']) }}>
    <div class="overflow-x-auto">
        <table class="w-full admin-table text-left">
            <thead class="bg-slate-800/80">
                @if(isset($head))
                    {{ $head }}
                @else
                    <tr>
                        @foreach($headers as $header)
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">{{ $header }}</th>
                        @endforeach
                    </tr>
                @endif
            </thead>
            <tbody class="divide-y divide-slate-700/30">
                @if(isset($body))
                    {{ $body }}
                @else
                    {{ $slot }}
                @endif
            </tbody>
        </table>
    </div>
</div>
