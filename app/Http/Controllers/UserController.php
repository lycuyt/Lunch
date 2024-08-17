<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Eatery;
use App\Models\LunchRequest;
use Carbon\Carbon;
use App\Models\Order;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Registration successful! Please log in.');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Kiểm tra role và chuyển hướng dựa trên role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin');
            } elseif (Auth::user()->role === 'employee') {
                return redirect()->route('employee');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Thông tin tài khoản hoặc mật khẩu không chính xác.']);
    }

    // public function showAdmin()
    // {
    //     $eateries = Eatery::all();
    //     $lunchRequests = LunchRequest::orderBy('date', 'desc')->get();
    //     // dd($eateries);  
    //     return view('admin.index', compact('eateries', 'lunchRequests'));
    // }
    public function showEmployee()
    {
        $lunchRequests = LunchRequest::whereDate('date', Carbon::today())
            ->orderBy('date', 'desc')
            ->get();
        return view('employee.index', compact('lunchRequests'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    // show order by user
    public function showOrder()
    {
        $orders = Order::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $lunchRequests = LunchRequest::whereIn('id', $orders->pluck('lunch_request_id'))->get();
        return view('employee.ordered', compact('orders', 'lunchRequests'));
    }
}
