<?php

namespace App\Livewire\Admin;

use App\Support\SensitivePermissions;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionManager extends Component
{
    use WithPagination;

    public function mount()
    {
        $this->authorizeSuperAdmin('view permissions');
    }

    public $search = '';

    public $sortField = 'name';

    public $sortDirection = 'asc';

    public $showModal = false;

    public $isEditing = false;

    public $permissionId = null;

    public $name = '';

    protected $listeners = ['deletePermission'];

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
                Rule::unique('permissions', 'name')->ignore($this->permissionId),
            ],
        ];
    }

    public function create()
    {
        $this->authorizeSuperAdmin('create permissions');

        $this->resetValidation();
        $this->reset(['name', 'permissionId', 'isEditing']);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->authorizeSuperAdmin('edit permissions');

        $this->resetValidation();
        $permission = Permission::findOrFail($id);
        abort_if(SensitivePermissions::isSensitive($permission->name), 403, 'Protected permissions cannot be edited.');

        $this->permissionId = $permission->id;
        $this->name = $permission->name;

        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->authorizeSuperAdmin($this->isEditing ? 'edit permissions' : 'create permissions');

        $this->validate();

        if ($this->isEditing) {
            $permission = Permission::findOrFail($this->permissionId);
            abort_if(SensitivePermissions::isSensitive($permission->name), 403, 'Protected permissions cannot be edited.');
            $permission->update(['name' => $this->name]);
            $this->dispatch('notify', message: 'Permission updated successfully.', type: 'success');
        } else {
            Permission::create(['name' => $this->name]);
            $this->dispatch('notify', message: 'Permission created successfully.', type: 'success');
        }

        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $this->authorizeSuperAdmin('delete permissions');
        $permission = Permission::findOrFail($id);
        abort_if(SensitivePermissions::isSensitive($permission->name), 403, 'Protected permissions cannot be deleted.');

        $this->dispatch('confirm-action',
            title: 'Delete Permission',
            message: 'Are you sure you want to delete this permission?',
            action: 'deletePermission',
            params: ['id' => $id]
        );
    }

    public function deletePermission($id)
    {
        $this->authorizeSuperAdmin('delete permissions');

        $permission = Permission::findOrFail($id);
        abort_if(SensitivePermissions::isSensitive($permission->name), 403, 'Protected permissions cannot be deleted.');
        $permission->delete();
        $this->dispatch('notify', message: 'Permission deleted successfully.', type: 'success');
    }

    public function render()
    {
        $this->authorizeSuperAdmin('view permissions');

        $permissions = Permission::query()
            ->withCount('roles')
            ->where('name', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(24);

        return view('livewire.admin.permission-manager', [
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
