<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;

class AdminLoginController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest:admin', ['except' => ['logout']]);
	}

	protected $guard = 'admin';

	public function showLoginForm()
	{
		return view('admin.pages.login');
	}

	public function login(Request $request)
	{
		// Validate the form data
		$this->validate($request, [
			'email'   => 'required|email',
			'password' => 'required|min:6'
		]);

		$remember = true;
		// Attempt to log the user in
		if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
			// if successful, then redirect to their intended location

			return redirect()->intended(route('admin.dashboard'));
		}
		// if unsuccessful, then redirect back to the login with the form data
		return redirect()->back()->withInput($request->only('email', 'remember'));
	}

	public function logout()
	{
		Auth::guard('admin')->logout();
		return redirect()->route('admin.login');
	}
}