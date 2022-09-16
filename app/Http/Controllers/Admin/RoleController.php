<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Admin\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('access-role-page'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.role.index');
    }

    public function create(): View
    {
        abort_if(Gate::denies('add-role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.role.create', [
            'permissions' => Permission::all(['id', 'name'])
        ]);
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $role = Role::create($request->validatedExcept('permissions'));

        $role->permissions()->sync($request->permissions, []);

        return redirect()->route('admin.roles.index')->with('success', 'Role Created Successfully!');
    }

    public function show(Role $role): View
    {
        return view('admin.role.show', compact('role'));
    }

    public function edit(Role $role): View
    {
        abort_if(Gate::denies('edit-role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.role.edit', [
            'role' => $role,
            'permissions' => Permission::all(['id', 'name'])
        ]);
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->validatedExcept('permissions'));

        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Role Updated Successfully!');
    }

    public function destroy(Role $role): RedirectResponse
    {
        abort_if(Gate::denies('delete-role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return redirect()->route('admin.roles.index')->with('error', 'Role Deleted Successfully!');
    }
}
