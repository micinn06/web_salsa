<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        // Simpan ke ActivityLog
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Created a new user: {$user->name}",
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $validatedData['role'] = 'user';
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        ActivityLog::create([
            'user_id' => $user->id,
            'description' => "Registered new user: {$user->name}",
        ]);

        return redirect()->route('login')->with('success', 'User registered successfully. Please log in.');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'description' => "User logged in: " . Auth::user()->name,
            ]);

            return Auth::user()->role === 'admin'
                ? redirect()->route('dashboard.index')->with('success', 'Welcome Admin!')
                : redirect()->route('home')->with('success', 'Login successful.');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "User logged out: " . Auth::user()->name,
        ]);

        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout successful.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|min:6',
            'role' => 'sometimes|required|in:user,admin',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Updated user: {$user->name}",
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $userName = $user->name; // Simpan nama pengguna sebelum dihapus
        $user->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Deleted user: {$userName}",
        ]);

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
