@extends('layouts.admin')

@section('title', 'FAQs - Admin Panel')
@section('page_title', 'FAQs')

@section('content')
<div class="space-y-6">
    <div class="flex justify-end mb-4">
        <button type="button" onclick="openModal('createFaqModal')">
            <x-public.btn variant="primary">
                <svg class="-ml-1 mr-2 h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New FAQ
            </x-public.btn>
        </button>
    </div>

    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm overflow-hidden">
        <x-admin.data-table>
            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Question</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Sort Order</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @forelse($faqs ?? [] as $faq)
                <tr class="border-b border-slate-700/50 last:border-0 hover:bg-slate-700/20 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-white">
                        {{ Str::limit($faq->question, 60) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                        {{ $faq->sort_order }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($faq->is_active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Active</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-500/10 text-slate-400 border border-slate-500/20">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                        <form action="{{ route('admin.faqs.toggle-status', $faq) }}" method="POST" class="inline-block" title="Toggle Status">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-blue-400 hover:text-blue-300">
                                @if($faq->is_active)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                @endif
                            </button>
                        </form>
                        
                        <button type="button" onclick="editFaq({{ json_encode($faq) }})" class="inline-block text-teal-400 hover:text-teal-300" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>
                        
                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-400 hover:text-rose-300" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-slate-700/50 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" /></svg>
                            </div>
                            <p class="text-slate-400 font-medium mb-1">No FAQs yet</p>
                            <p class="text-slate-500 text-sm">Create an FAQ to help your users find answers quickly.</p>
                            <a href="{{ route('admin.faqs.create') }}" class="mt-4 text-teal-400 hover:text-teal-300 text-sm font-medium">Add New FAQ &rarr;</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </x-slot>
        </x-admin.data-table>
    </div>
</div>

<!-- Create FAQ Modal -->
<x-admin.modal id="createFaqModal" title="Create FAQ" confirmText="Save FAQ" confirmColor="teal">
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        <x-admin.form-group label="Question" name="question" required>
            <input type="text" name="question" id="question" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none text-sm">
        </x-admin.form-group>
        <x-admin.form-group label="Answer" name="answer" required>
            <textarea name="answer" id="answer" rows="4" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none text-sm"></textarea>
        </x-admin.form-group>
        <div class="flex items-center space-x-4">
            <div class="w-1/2">
                <x-admin.form-group label="Sort Order" name="sort_order">
                    <input type="number" name="sort_order" id="sort_order" value="0" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none text-sm">
                </x-admin.form-group>
            </div>
            <div class="w-1/2 mt-3">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="form-checkbox h-5 w-5 text-teal-500 rounded border-slate-700 bg-slate-900 focus:ring-teal-500 focus:ring-offset-slate-900">
                    <span class="text-sm font-medium text-slate-300">Is Active</span>
                </label>
            </div>
        </div>
    </form>
</x-admin.modal>

<!-- Edit FAQ Modal -->
<x-admin.modal id="editFaqModal" title="Edit FAQ" confirmText="Update FAQ" confirmColor="teal">
    <form id="editFaqForm" action="" method="POST">
        @csrf
        @method('PUT')
        <x-admin.form-group label="Question" name="question" required>
            <input type="text" name="question" id="edit_question" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none text-sm">
        </x-admin.form-group>
        <x-admin.form-group label="Answer" name="answer" required>
            <textarea name="answer" id="edit_answer" rows="4" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none text-sm"></textarea>
        </x-admin.form-group>
        <div class="flex items-center space-x-4">
            <div class="w-1/2">
                <x-admin.form-group label="Sort Order" name="sort_order">
                    <input type="number" name="sort_order" id="edit_sort_order" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none text-sm">
                </x-admin.form-group>
            </div>
            <div class="w-1/2 mt-3">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" name="is_active" id="edit_is_active" value="1" class="form-checkbox h-5 w-5 text-teal-500 rounded border-slate-700 bg-slate-900 focus:ring-teal-500 focus:ring-offset-slate-900">
                    <span class="text-sm font-medium text-slate-300">Is Active</span>
                </label>
            </div>
        </div>
    </form>
</x-admin.modal>

@push('scripts')
<script>
    function editFaq(faq) {
        document.getElementById('editFaqForm').action = `/admin/faqs/${faq.id}`;
        document.getElementById('edit_question').value = faq.question;
        document.getElementById('edit_answer').value = faq.answer;
        document.getElementById('edit_sort_order').value = faq.sort_order;
        document.getElementById('edit_is_active').checked = faq.is_active;
        openModal('editFaqModal');
    }
</script>
@endpush
@endsection
