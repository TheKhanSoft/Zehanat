@extends('layouts.admin')

@section('title', 'Permissions - Admin Panel')
@section('page_title', 'Permissions')

@section('content')
<div class="space-y-6">
    <div class="flex justify-end mb-4">
        <button onclick="openModal('addModal')" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 shadow-sm transition-colors">
            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add New Permission
        </button>
    </div>

    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm overflow-hidden">
        <x-admin.data-table>
            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Guard</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @forelse($permissions as $permission)
                <tr class="border-b border-slate-700/50 last:border-0 hover:bg-slate-700/20 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-white">
                        {{ $permission->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                        {{ $permission->guard_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="editPermission({{ $permission->id }}, '{{ addslashes($permission->name) }}')" class="p-2 inline-flex items-center justify-center rounded-lg text-slate-400 hover:text-teal-400 hover:bg-slate-700/50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-600" title="Edit">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            
                            <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this permission?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 inline-flex items-center justify-center rounded-lg text-slate-400 hover:text-rose-400 hover:bg-slate-700/50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-600" title="Delete">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-16 text-center text-slate-400">
                        No permissions found.
                    </td>
                </tr>
                @endforelse
            </x-slot>
        </x-admin.data-table>
    </div>
</div>

<!-- Add Modal -->
<x-admin.modal id="addModal" title="Add New Permission" confirmText="Save Permission" confirmColor="teal">
    <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf
        <x-admin.form-group label="Name" name="name" required>
            <input type="text" name="name" id="name" required class="w-full bg-slate-950 border border-slate-700/80 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 outline-none text-sm transition-colors shadow-inner">
        </x-admin.form-group>
    </form>
</x-admin.modal>

<!-- Edit Modal -->
<x-admin.modal id="editModal" title="Edit Permission" confirmText="Update Permission" confirmColor="teal">
    <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <x-admin.form-group label="Name" name="name" required>
            <input type="text" name="name" id="edit_name" required class="w-full bg-slate-950 border border-slate-700/80 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 outline-none text-sm transition-colors shadow-inner">
        </x-admin.form-group>
    </form>
</x-admin.modal>

@push('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
    
    function editPermission(id, name) {
        document.getElementById('edit_name').value = name;
        document.getElementById('editForm').action = `/admin/permissions/${id}`;
        openModal('editModal');
    }
</script>
@endpush
@endsection
