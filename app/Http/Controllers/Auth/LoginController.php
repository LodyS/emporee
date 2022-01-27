<?php

namespace App\Http\Controllers\Auth;
use App\Models\Buku;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:anggota')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function showAnggotaLoginForm()
    {
        return view('auth.login', ['url' => 'anggota']);
    }

    public function anggotaLogin(Request $request)
    {
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);

        if (Auth::guard('anggota')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/anggota');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function logoutAnggota()
    {
        Auth::guard('anggota')->logout();

        return view('welcome');
    }
}
