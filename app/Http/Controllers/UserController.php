<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
  public function index()
  {
    $users = Users::latest()->paginate(10);
    return view('pages.admin.users.index', compact('users'));
  }

  public function create()
  {
    return view('pages.admin.users.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name'     => 'required|string|max:255',
      'email'    => 'required|email|unique:users_222336,email_222336',
      'role'     => 'required|string|in:admin,customer',
      'password' => 'required|string|min:6',
    ]);

    Users::create([
      'name'            => $request->name,
      'role_222336'     => $request->role,
      'email_222336'    => $request->email,
      'password_222336' => bcrypt($request->password),
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
  }

  public function show(Users $user)
  {
    return view('pages.admin.users.show', compact('user'));
  }

  public function edit(Users $user)
  {
    return view('pages.admin.users.edit', compact('user'));
  }

  public function update(Request $request, Users $user)
  {
    $validated = $request->validate([
      'name'     => 'required|string|max:255',
      'email'    => 'required|email|unique:users_222336,email_222336,' . $user->email_222336 . ',email_222336',
      'role'     => 'required|in:admin,customer',
      'password' => 'nullable|string|min:8',
    ]);

    $data = [
      'name'         => $request->name,
      'role_222336'  => $request->role,
      'email_222336' => $request->email,
    ];

    if ($request->filled('password')) {
      $data['password_222336'] = bcrypt($request->password);
    }

    $user->update($data);

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
  }

  public function destroy(Users $user)
  {
    $user->delete();
    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
  }
}
