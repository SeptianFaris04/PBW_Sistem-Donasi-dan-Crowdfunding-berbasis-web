<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Traits\HasRoles;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // has role tetap merah namun dapat digunakan untuk membedakan antara saat login user dengan admin
        
        // if (Auth::user()->hasRole('admin')){
        //     return redirect()->to('/');
        // }

        // if(Auth::user()->hasRole('user')){
        //     return redirect()->to('/');
        // }

        if($user->hasRole('admin')){
            $user->syncPermissions([
            'register-akun',
            'edit-profile',
            'hapus-akun',
            'lihat-profile',
            'tambah-user',
            'edit-user',
            'hapus-user',
            'lihat-user',
            'tambah-donasi',
            'edit-donasi',
            'hapus-donasi',
            'lihat-donasi',
            'tambah-urundana',
            'edit-urundana',
            'hapus-urundana',
            'lihat-urundana',
            'tambah-merchandise',
            'edit-merchandise',
            'hapus-merchandise',
            'lihat-merchandise',
            'buat-pemberian-donasi',
            'lihat-pemberian-donasi',
            'update-pemberian-donasi',
            'hapus-pemberian-donasi',
            'buat-pemberian-urundana',
            'lihat-pemberian-urundana',
            'update-pemberian-urundana',
            'hapus-pemberian-urundana',
            'buat-pembelian-merchandise',
            'lihat-pembelian-merchandise',
            'edit-pembelian-merchandise',
            'hapus-pembelian-merchandise',
        ]);
        return redirect()->to('/');
        } 
        else if($user->hasRole('user')) {
            $user->syncPermissions([
            'register-akun',
            'edit-profile',
            'hapus-akun',
            'lihat-profile',
            'buat-pemberian-donasi',
            'lihat-pemberian-donasi',
            'buat-pemberian-urundana',
            'lihat-pemberian-urundana',
            'buat-pembelian-merchandise',
            'lihat-pembelian-merchandise',
            ]);
            return redirect()->to('/');
        }

        return redirect()->intended(route('/', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
