<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Support\Global\Breadcrumbs;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class RoleController extends Controller
{
    protected Breadcrumbs $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = (new Breadcrumbs())
            ->add(Lang::get('Role'), URL::route('admin.role.index'));
    }

    public function index(): Renderable
    {
        return View::make('admin.roles.index')->with([
            'roles' => Role::all(),
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    public function create(): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Create'), URL::route('admin.role.create'));

        return View::make('admin.roles.form')->with([
            'roles' => Role::all(),
            'breadcrumbs' => $this->breadcrumbs,
            'title' => Lang::get('Create role'),
            'method' => 'POST',
            'action' => URL::route('admin.role.store'),
            'backRoute' => URL::route('admin.role.index'),
            'submitButton' => Lang::get('Create'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'string'],
            'abbreviation' => ['required', 'string'],
        ]);

        Role::query()->create($request->only('role', 'abbreviation'));

        return Redirect::route('admin.role.index')
            ->with(['success' => 'Role created successfully']);
    }

    public function edit(Role $role): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Edit'), URL::route('admin.role.edit', ['role' => $role->id]));

        return View::make('admin.roles.form')->with([
            'role' => $role,
            'menus' => Role::all(),
            'breadcrumbs' => $this->breadcrumbs,
            'title' => Lang::get('Update menu'),
            'method' => 'Put',
            'action' => URL::route('admin.role.update', ['role' => $role->id]),
            'backRoute' => URL::route('admin.role.index'),
            'submitButton' => Lang::get('Update'),
        ]);
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'string'],
            'abbreviation' => ['required', 'string'],
        ]);

        $role->update($request->only('role', 'abbreviation'));

        return Redirect::route('admin.role.index')->with([
                'success' => 'Role updated successfully']
        );
    }

    public function destroy(Role $role)
    {
        $role->delete();

        //redirect to index page
        return Redirect::route('admin.role.index')->with([
            'success' => 'Role deleted successfully'
        ]);
    }
}
