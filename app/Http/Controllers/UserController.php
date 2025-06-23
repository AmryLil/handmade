<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
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

  public function myVouchers()
  {
    $user = Auth::user();

    $vouchers = \App\Models\Voucher::where('id_user_222336', $user->email_222336)
      ->orderBy('status_222336', direction: 'asc')
      ->orderBy('tanggal_kadaluarsa_222336', 'desc')
      ->get();

    return view('pages.users.voucher', [
      'vouchers' => $vouchers
    ]);
  }

  public function validateAjax(Request $request)
  {
    $request->validate(['kode_voucher' => 'required|string']);

    $kodeVoucher = $request->input('kode_voucher');
    $user        = Auth::user();

    $voucher = Voucher::where('kode_voucher_222336', $kodeVoucher)->first();

    if (!$voucher) {
      return response()->json(['valid' => false, 'message' => 'Kode voucher tidak ditemukan.'], 404);
    }
    if ($voucher->id_user_222336 !== $user->email_222336) {
      return response()->json(['valid' => false, 'message' => 'Voucher ini bukan milik Anda.'], 403);
    }
    if ($voucher->status_222336 === 'terpakai') {
      return response()->json(['valid' => false, 'message' => 'Voucher sudah pernah digunakan.'], 422);
    }
    if (Carbon::now()->isAfter($voucher->tanggal_kadaluarsa_222336)) {
      return response()->json(['valid' => false, 'message' => 'Voucher sudah kadaluarsa.'], 422);
    }

    // Jika semua validasi lolos
    return response()->json([
      'valid'             => true,
      'message'           => 'Voucher berhasil diterapkan!',
      'persentase_diskon' => $voucher->persentase_diskon_222336
    ]);
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
