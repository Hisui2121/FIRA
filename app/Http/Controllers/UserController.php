<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\ProfileController;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // SEARCH
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // ROLE FILTER
        if ($request->role) {
            $query->role($request->role);
        }

        $users = $query->latest()->paginate(10);

        return view('users.index', [
            'users' => $users,
            'roles' => Role::all(),
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles([$request->role]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }
        $user->delete();
       
        return back()->with('success', 'User deleted.');
    }
}