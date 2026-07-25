@extends('layouts.admin')

@section('title', 'Roles - Admin Panel')
@section('page_title', 'Roles')

@section('content')
<div class="space-y-6">
    <div class="flex justify-end mb-4">
        <button onclick="openModal('addModal')" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 shadow-sm transition-colors">
            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add New Role
        </button>
    </div>

    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm overflow-hidden">
        <x-admin.data-table>
            <x-slot name="head">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Permissions</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @forelse($roles as $role)
                <tr class="border-b border-slate-700/50 last:border-0 hover:bg-slate-700/20 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-white whitespace-nowrap">
                        {{ $role->name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-400">
                        <div class="flex flex-wrap gap-1">
                            @foreach($role->permissions->take(5) as $perm)
                                <span class="px-2 py-0.5 rounded text-xs bg-slate-700 border border-slate-600 text-slate-300">{{ $perm->name }}</span>
                            @endforeach
                            @if($role->permissions->count() > 5)
                                <span class="px-2 py-0.5 rounded text-xs bg-slate-700 border border-slate-600 text-slate-300">+{{ $role->permissions->count() - 5 }} more</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="editRole({{ $role->id }}, '{{ addslashes($role->name) }}', {{ json_encode($role->permissions->pluck('name')) }})" class="p-2 inline-flex items-center justify-center rounded-lg text-slate-400 hover:text-teal-400 hover:bg-slate-700/50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-600" title="Edit">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            
                            @if(!in_array($role->name, ['admin', 'super-admin']))
                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 inline-flex items-center justify-center rounded-lg text-slate-400 hover:text-rose-400 hover:bg-slate-700/50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-600" title="Delete">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-16 text-center text-slate-400">
                        No roles found.
                    </td>
                </tr>
                @endforelse
            </x-slot>
        </x-admin.data-table>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-slate-900 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('addModal')"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-700">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-white mb-4" id="modal-title">Add New Role</h3>
                    
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-slate-300 mb-1">Role Name</label>
                        <input type="text" name="name" id="name" required class="w-full bg-slate-900 border border-slate-700 rounded-md py-2 px-3 text-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-3">Permissions</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 max-h-60 overflow-y-auto p-2 bg-slate-900/50 rounded-lg border border-slate-700">
                            @foreach($permissions as $permission)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="rounded bg-slate-900 border-slate-600 text-teal-500 focus:ring-teal-500 focus:ring-offset-slate-800">
                                <span class="ml-2 text-sm text-slate-300">{{ $permission->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-teal-600 text-base font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Save
                    </button>
                    <button type="button" onclick="closeModal('addModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-600 shadow-sm px-4 py-2 bg-slate-800 text-base font-medium text-slate-300 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-slate-900 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('editModal')"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-700">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-white mb-4" id="modal-title">Edit Role</h3>
                    
                    <div class="mb-6">
                        <label for="edit_name" class="block text-sm font-medium text-slate-300 mb-1">Role Name</label>
                        <input type="text" name="name" id="edit_name" required class="w-full bg-slate-900 border border-slate-700 rounded-md py-2 px-3 text-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-3">Permissions</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 max-h-60 overflow-y-auto p-2 bg-slate-900/50 rounded-lg border border-slate-700">
                            @foreach($permissions as $permission)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="permissions[]" id="perm_{{ Str::slug($permission->name) }}" value="{{ $permission->name }}" class="edit-perm-checkbox rounded bg-slate-900 border-slate-600 text-teal-500 focus:ring-teal-500 focus:ring-offset-slate-800">
                                <span class="ml-2 text-sm text-slate-300">{{ $permission->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-teal-600 text-base font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Update
                    </button>
                    <button type="button" onclick="closeModal('editModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-600 shadow-sm px-4 py-2 bg-slate-800 text-base font-medium text-slate-300 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
    
    function editRole(id, name, permissions) {
        document.getElementById('edit_name').value = name;
        document.getElementById('editForm').action = `/admin/roles/${id}`;
        
        // Reset all checkboxes
        document.querySelectorAll('.edit-perm-checkbox').forEach(cb => {
            cb.checked = false;
        });
        
        // Check the ones that the role has
        permissions.forEach(permName => {
            const cb = document.querySelector(`.edit-perm-checkbox[value="${permName}"]`);
            if (cb) {
                cb.checked = true;
            }
        });
        
        openModal('editModal');
    }
</script>
@endpush
@endsection
