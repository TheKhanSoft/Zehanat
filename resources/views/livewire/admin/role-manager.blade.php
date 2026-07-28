<div class="space-y-6">
    @section('title', 'Roles - Admin Panel')
    @section('page_title', 'Roles')
    <x-admin.page-header 
        title="Roles" 
        description="Manage system roles and their associated permissions." 
        module="Settings" 
        actionText="Add Role" 
        actionMethod="create" 
        actionPermission="create roles"
        icon="shield-check" 
    />

    <div class="flex items-start gap-3 rounded-2xl border border-amber-400/20 bg-amber-400/10 px-4 py-3.5 text-sm text-amber-200">
        <svg class="mt-0.5 h-5 w-5 flex-none text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21H6.75a2.25 2.25 0 0 1-2.25-2.25v-6a2.25 2.25 0 0 1 2.25-2.25Z" /></svg>
        <p><strong class="font-black">Protected capabilities:</strong> role management, permission management, and member impersonation are permanently reserved for the super-admin role and cannot be assigned here.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-admin.stat-card title="Total Roles" :value="$roles->total()" icon="shield-check" color="teal" />
    </div>

    <!-- Data Table -->
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm overflow-hidden">
        <div class="p-4 border-b border-slate-700/50 flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-700 rounded-xl leading-5 bg-slate-900/50 text-slate-300 placeholder-slate-400 focus:outline-none focus:bg-slate-900 focus:ring-1 focus:ring-teal-500 focus:border-teal-500 sm:text-sm transition-colors" placeholder="Search roles...">
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                @forelse($roles as $role)
                    <div class="group relative flex flex-col justify-between rounded-2xl border border-slate-700/60 bg-slate-800/40 p-5 transition-all hover:bg-slate-800/80 hover:shadow-xl hover:shadow-slate-950/50">
                        <!-- Decorative top glow -->
                        <div class="absolute inset-x-0 -top-px mx-auto h-px w-1/2 bg-gradient-to-r from-transparent via-teal-500/50 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                        
                        <div>
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-teal-500/20 bg-teal-500/10 text-teal-400">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-white">{{ $role->name }}</h3>
                                </div>
                                <div class="flex items-center gap-1.5 opacity-0 transition-opacity group-hover:opacity-100">
                                    @can('edit roles')
                                    <button wire:click="edit({{ $role->id }})" class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-700/50 text-slate-400 transition hover:bg-teal-500/20 hover:text-teal-300" title="Edit">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    @endcan
                                    @if(!in_array($role->name, ['admin', 'super-admin']))
                                        @can('delete roles')
                                        <button wire:click="confirmDelete({{ $role->id }})" class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-700/50 text-slate-400 transition hover:bg-rose-500/20 hover:text-rose-300" title="Delete">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                        @endcan
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="text-xs font-medium uppercase tracking-wider text-slate-500 mb-2.5">Assigned Permissions ({{ $role->permissions->count() }})</p>
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($role->permissions->take(8) as $perm)
                                        <span class="inline-flex items-center rounded-md border border-slate-700/80 bg-slate-800/80 px-2 py-1 text-xs font-medium text-slate-300">
                                            {{ $perm->name }}
                                        </span>
                                    @empty
                                        <span class="text-sm text-slate-500 italic">No permissions assigned</span>
                                    @endforelse
                                    
                                    @if($role->permissions->count() > 8)
                                        <span class="inline-flex items-center rounded-md border border-slate-700/80 bg-slate-800/80 px-2 py-1 text-xs font-medium text-slate-400">
                                            +{{ $role->permissions->count() - 8 }} more
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-slate-400">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 mb-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <p class="text-lg font-medium text-white">No roles found</p>
                            <p class="text-sm mt-1 text-slate-500">Try adjusting your search query or add a new role.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        @if($roles->hasPages())
            <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-900/30">
                {{ $roles->links() }}
            </div>
        @endif
    </div>

    <!-- Modal -->
    @if($showModal)
    <div class="fixed inset-0 z-[100]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-slate-950/80 transition-opacity" wire:click="$set('showModal', false)"></div>

        <div class="absolute inset-0 z-10 overflow-x-hidden overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-6">
                <div class="relative transform overflow-hidden rounded-2xl bg-slate-900/95 backdrop-blur-xl border border-slate-700/50 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    <form wire:submit.prevent="save">
                        <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="flex items-center justify-between mb-5">
                                <h3 class="text-lg font-semibold leading-6 text-white" id="modal-title">
                                    {{ $isEditing ? 'Edit Role' : 'Add New Role' }}
                                </h3>
                                <button type="button" wire:click="$set('showModal', false)" class="text-slate-400 hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            
                            <div class="space-y-4">
                                <x-admin.form-group label="Role Name" name="name" required>
                                    <input type="text" wire:model="name" id="name" required class="w-full bg-slate-950 border border-slate-700/80 rounded-xl px-4 py-2.5 text-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/30 outline-none text-sm transition-colors shadow-inner">
                                </x-admin.form-group>

                                <div>
                                    <label class="block text-sm font-medium text-slate-300 mb-3">Permissions</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 max-h-60 overflow-y-auto p-3 bg-slate-950/50 rounded-xl border border-slate-700/80 shadow-inner">
                                        @foreach($permissions as $permission)
                                        <label class="inline-flex items-center group cursor-pointer">
                                            <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->name }}" class="rounded bg-slate-900 border-slate-600 text-teal-500 focus:ring-teal-500/50 focus:ring-offset-slate-900 h-4 w-4 transition-colors">
                                            <span class="ml-2 text-sm text-slate-400 group-hover:text-white transition-colors">{{ $permission->name }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                    @error('selectedPermissions') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-900/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-700/50">
                            <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-teal-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-teal-500 sm:ml-3 sm:w-auto transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-teal-500 border border-transparent">
                                {{ $isEditing ? 'Update Role' : 'Save Role' }}
                            </button>
                            <button type="button" wire:click="$set('showModal', false)" class="mt-3 inline-flex w-full justify-center rounded-lg bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-300 shadow-sm ring-1 ring-inset ring-slate-600 hover:bg-slate-700 sm:mt-0 sm:w-auto transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-slate-500">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
