<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show all users
   public function index()
{
    $users = User::all();
    return view('crud-admin.user-management', compact('users'));
}

    // Show edit form for a specific user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('crud-admin.edit-user', compact('user'));
    }

  public function update(Request $request, $id)
{
    $request->validate([
        'is_admin' => 'required|boolean',
    ]);

    $user = User::findOrFail($id);
    $user->is_admin = $request->is_admin;
    $user->save();

    return redirect()->route('user.management')->with('success', 'User role updated successfully.');
}


public function toggleStatus($id)
{
    $user = User::findOrFail($id);
    $user->is_active = !$user->is_active;
    $user->save();

    return back()->with('success', 'User status updated.');
}


}

