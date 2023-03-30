<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (isset($request->isAdmin)) {
            $user->is_admin = 1;
            $user->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return to_route('admin.users.index')->with('success', 'User added successfully');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(User $user): View
    {
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $isAdmin = isset($request->isAdmin) ? 1 : 0;
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->is_admin = $isAdmin;

        $request->user()->save();

        return to_route('admin.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Delete the user's account.
     */
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

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
