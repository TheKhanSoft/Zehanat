<?php

namespace App\Livewire\Admin;

use App\Support\SensitivePermissions;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleManager extends Component
{
    use WithPagination;

    public function mount()
    {
        $this->authorizeSuperAdmin('view roles');
    }

    public $search = '';

    public $sortField = 'name';

    public $sortDirection = 'asc';

    public $showModal = false;

    public $isEditing = false;

    public $roleId = null;

    public $name = '';

    public $selectedPermissions = [];

    protected $listeners = ['deleteRole'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($this->roleId),
            ],
            'selectedPermissions' => 'nullable|array',
            'selectedPermissions.*' => ['string', Rule::exists('permissions', 'name')],
        ];
    }

    public function create()
    {
        $this->authorizeSuperAdmin('create roles');

        $this->resetValidation();
        $this->reset(['name', 'selectedPermissions', 'roleId', 'isEditing']);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->authorizeSuperAdmin('edit roles');

        $this->resetValidation();
        $role = Role::with('permissions')->findOrFail($id);

        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('name')->toArray();

        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->authorizeSuperAdmin($this->isEditing ? 'edit roles' : 'create roles');

        $this->validate();
        $assignablePermissions = Permission::whereIn('name', $this->selectedPermissions)
            ->whereNotIn('name', SensitivePermissions::NAMES)
            ->pluck('name')
            ->all();

        if ($this->isEditing) {
            $role = Role::findOrFail($this->roleId);
            $role->update(['name' => $this->name]);
            $role->syncPermissions($assignablePermissions);
            $this->dispatch('notify', message: 'Role updated successfully.', type: 'success');
        } else {
            $role = Role::create(['name' => $this->name]);
            $role->syncPermissions($assignablePermissions);
            $this->dispatch('notify', message: 'Role created successfully.', type: 'success');
        }

        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $this->authorizeSuperAdmin('delete roles');

        $role = Role::findOrFail($id);
        if (in_array($role->name, ['admin', 'super-admin'])) {
            $this->dispatch('notify', message: 'Cannot delete core roles.', type: 'error');

            return;
        }

        $this->dispatch('confirm-action',
            title: 'Delete Role',
            message: 'Are you sure you want to delete this role?',
            action: 'deleteRole',
            params: ['id' => $id]
        );
    }

    public function deleteRole($id)
    {
        $this->authorizeSuperAdmin('delete roles');

        $role = Role::findOrFail($id);

        if (in_array($role->name, ['admin', 'super-admin'])) {
            return;
        }

        $role->delete();
        $this->dispatch('notify', message: 'Role deleted successfully.', type: 'success');
    }

    public function render()
    {
        $this->authorizeSuperAdmin('view roles');

        $roles = Role::with('permissions')
            ->where('name', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->whereNotIn('name', ['super-admin'])
            ->paginate(10);

        $permissions = Permission::whereNotIn('name', SensitivePermissions::NAMES)
            ->orderBy('name')
            ->get();

        return view('livewire.admin.role-manager', [
            'roles' => $roles,
            'permissions' => $permissions,
        ])->layout('layouts.admin');
    }

    private function authorizeSuperAdmin(string $permission): void
    {
        abort_unless(
            auth()->user()?->hasRole('super-admin') && auth()->user()->can($permission),
            403,
        );
    }
}
