<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Admin\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('access-user-page'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.user.index');
    }

    public function create(Request $request): mixed
    {
        abort_if(Gate::denies('add-user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            return Role::where('id', $request->role_id)->first()->permissions;
        }

        return view('admin.user.create', [
            'roles' => Role::all()->pluck('name', 'id')
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        $user->roles()->attach($request->role);

        $user->permissions()->sync($request->permissions, []);

        return redirect()->route('admin.users.index')->with('success', 'User Created Successfully!');
    }

    public function edit(User $user): View
    {
        abort_if(Gate::denies('edit-user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userRole = $user->roles()->first();

        return view('admin.user.edit', [
            'user' => $user,
            'roles' => Role::all()->pluck('name', 'id'),
            'userRole' => $userRole,
            'rolePermissions' => $userRole?->permissions,
            'userPermissions' => $user->permissions
        ]);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        $user->roles()->sync($request->role);

        $user->permissions()->sync($request->permissions);

        return redirect()->route('admin.users.index')->with('success', 'User Updated Successfully!');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if(Gate::denies('delete-user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();
        return redirect()->route('admin.users.index')->with('error', 'User Deleted Successfully!');
    }
}
