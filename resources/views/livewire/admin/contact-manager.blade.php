<div>
    @section('title', 'Contact Messages - Admin Panel')
    @section('page_title', 'Contact Messages')

    <div class="space-y-6"
        x-data="{
            init() {
                window.addEventListener('open-modal', event => {
                    if(window.openModal) window.openModal(event.detail.id);
                });
                window.addEventListener('close-modal', event => {
                    if(window.closeModal) window.closeModal(event.detail.id);
                });
            }
        }">
        
        <x-admin.page-header 
            title="Contact Inquiries" 
            description="Manage and respond to messages sent through the website contact form."
            module="Communication"
        />

        {{-- Statistics --}}
        <section class="grid gap-4 sm:grid-cols-2">
            <x-admin.stat-card 
                title="Total Messages" 
                value="{{ number_format($totalMessages) }}" 
                color="cyan" 
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>' 
            />
            <x-admin.stat-card 
                title="Unread Messages" 
                value="{{ number_format($unreadMessages) }}" 
                color="rose" 
                icon='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>' 
            />
        </section>

        {{-- Main content card --}}
        <section class="overflow-hidden rounded-3xl border border-slate-700/60 bg-slate-900/65 shadow-2xl shadow-slate-950/20 backdrop-blur-xl">
            <div class="border-b border-slate-700/60 p-4 sm:p-5">
                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-white">Message Inbox</h2>
                        <p class="mt-1 text-sm text-slate-500">Search by name, email, or subject.</p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <div class="relative min-w-0 sm:w-72">
                            <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4.5 w-4.5 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                            </svg>
                            <input
                                wire:model.live.debounce.250ms="search"
                                type="search"
                                placeholder="Search messages..."
                                class="h-11 w-full rounded-xl border border-slate-700 bg-slate-950/70 pl-10 pr-9 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"
                            >
                        </div>
                        <select
                            wire:model.live="status"
                            class="h-11 rounded-xl border border-slate-700 bg-slate-950/70 px-3.5 text-sm text-slate-300 outline-none transition focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10"
                        >
                            <option value="all">All Messages</option>
                            <option value="unread">Unread</option>
                            <option value="read">Read</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="relative min-h-[300px]">
                {{-- Loading overlay --}}
                <div wire:loading wire:target="search, previousPage, nextPage, gotoPage" class="absolute inset-0 z-10 flex items-center justify-center bg-slate-950/40 backdrop-blur-sm">
                    <div class="flex items-center gap-3 rounded-2xl bg-slate-900/90 px-5 py-3.5 text-sm font-semibold text-white shadow-2xl shadow-black/50 border border-slate-800">
                        Loading...
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-700/60">
                        <thead class="bg-slate-950/35">
                            <tr>
                                <th scope="col" class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Sender</th>
                                <th scope="col" class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Subject & Message</th>
                                <th scope="col" class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Date</th>
                                <th scope="col" class="px-5 py-4 text-right text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/80">
                            @forelse($messages as $msg)
                                <tr class="group bg-transparent transition hover:bg-slate-800/35 {{ !$msg->is_read ? 'bg-slate-800/20' : '' }}">
                                    <td class="px-5 py-5 whitespace-nowrap">
                                        <div class="font-semibold {{ !$msg->is_read ? 'text-white' : 'text-slate-300' }}">
                                            {{ $msg->name }}
                                        </div>
                                        <div class="text-sm text-slate-500">{{ $msg->email }}</div>
                                    </td>
                                    <td class="px-5 py-5 min-w-[300px]">
                                        <div class="font-medium {{ !$msg->is_read ? 'text-white' : 'text-slate-300' }}">
                                            {{ $msg->subject }}
                                            @if(!$msg->is_read)
                                                <span class="ml-2 inline-flex items-center rounded-full bg-rose-500/10 px-2 py-0.5 text-[10px] font-bold text-rose-400">NEW</span>
                                            @endif
                                        </div>
                                        <div class="mt-1 text-sm text-slate-500 truncate max-w-md">
                                            {{ Str::limit($msg->message, 80) }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 whitespace-nowrap text-sm text-slate-400">
                                        {{ $msg->created_at->format('M d, Y h:i A') }}
                                    </td>
                                    <td class="px-5 py-5 text-right">
                                        <div class="flex items-center justify-end gap-1.5">
                                            @can('edit contacts')
                                            <button
                                                type="button"
                                                wire:click="toggleRead({{ $msg->id }})"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent text-slate-400 transition hover:bg-slate-700/50 hover:text-white"
                                                title="Mark as {{ $msg->is_read ? 'Unread' : 'Read' }}"
                                            >
                                                @if($msg->is_read)
                                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" /></svg>
                                                @else
                                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                                @endif
                                            </button>
                                            @endcan
                                            <button type="button" wire:click="viewMessage({{ $msg->id }})" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent text-slate-400 transition hover:bg-teal-400/10 hover:text-teal-300" title="View Message">
                                                <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            </button>
                                            @can('delete contacts')
                                            <button type="button" wire:click="confirmDelete({{ $msg->id }})" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent text-slate-400 transition hover:bg-rose-400/10 hover:text-rose-300" title="Delete">
                                                <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-12 text-center text-slate-500">
                                        No messages found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="border-t border-slate-700/60 p-4">
                    {{ $messages->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </section>

        {{-- View Modal --}}
        <x-admin.modal id="viewContactModal" title="Message Details" maxWidth="2xl" :showFooter="false">
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-slate-500">From</p>
                        <p class="font-medium text-white">{{ $name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">Email</p>
                        <p class="font-medium text-white"><a href="mailto:{{ $email }}" class="text-teal-400 hover:underline">{{ $email }}</a></p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-slate-500">Subject</p>
                        <p class="font-bold text-white">{{ $subject }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-slate-500">Message</p>
                        <div class="mt-1 rounded-lg bg-slate-950/50 p-4 text-sm text-slate-200 whitespace-pre-wrap">{{ $messageContent }}</div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <a href="mailto:{{ $email }}?subject=Re: {{ urlencode($subject) }}" class="rounded-lg bg-teal-500 px-4 py-2 text-sm font-semibold text-white hover:bg-teal-400">Reply via Email</a>
                    <button type="button" onclick="window.closeModal('viewContactModal')" class="rounded-lg bg-slate-700 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-600">Close</button>
                </div>
            </div>
        </x-admin.modal>

    </div>
</div>
