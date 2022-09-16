<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Admin\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionRequest;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('access-permission-page'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permission.index');
    }

    public function create(): View
    {
        return view('admin.permission.create');
    }

    public function store(PermissionRequest $request): RedirectResponse
    {
        Permission::create($request->validated());

        return redirect()->route('admin.permissions.index')->with('success', 'Permission Created Successfully!');
    }

    public function show(Permission $permission): View
    {
        return view('admin.permission.show', compact('permission'));
    }

    public function edit(Permission $permission): View
    {
        return view('admin.permission.edit', compact('permission'));
    }

    public function update(PermissionRequest $request, Permission $permission): RedirectResponse
    {
        $permission->update($request->validated());

        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated Successfully!');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('error', 'Permission Deleted Successfully!');
    }
}
