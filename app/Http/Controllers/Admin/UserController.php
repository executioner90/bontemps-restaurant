<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Support\Global\Breadcrumbs;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    protected Breadcrumbs $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = (new Breadcrumbs())
            ->add(Lang::get('User'), URL::route('admin.user.index'));
    }

    public function index(): Renderable
    {
        return View::make('admin.users.index')->with([
            'users' => User::all(),
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    public function create(): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Create'), URL::route('admin.user.create'));

        return View::make('admin.auth.register')->with([
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('admin.user.index')->with([
            'success' => 'User added successfully'
        ]);
    }

    public function edit(User $user): Renderable
    {
        $this->breadcrumbs
            ->add(Lang::get('Edit'), URL::route('admin.user.edit', $user));

        return View::make('admin.users.edit')->with([
            'user' => $user,
            'roles' => Role::all(),
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.user.index')->with('success', 'User updated successfully');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        if ($user->id === $request->user()) {
            $currentUser = $request->user();
            Auth::logout();
        } else {
            $currentUser = $user;
        }

        $currentUser->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('admin.user.index')->with('success', 'User deleted successfully');
    }
}
