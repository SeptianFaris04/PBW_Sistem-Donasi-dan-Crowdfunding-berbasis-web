<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Periksa email dan password untuk menentukan role admin
        if (str_contains($user->email, '@admindonate.com') && str_contains($request->password, '#admindonate')) {
            $user->assignRole('admin'); // Assign role admin
        } else{
            $user->assignRole('user');
        }

        if('assignRole' === 'admin'){
            $user->givepermissionTo('register-akun');
            $user->givepermissionTo('edit-profile');
            $user->givepermissionTo('hapus-akun');
            $user->givepermissionTo('lihat-profile');
            $user->givepermissionTo('tambah-user');
            $user->givepermissionTo('edit-user');
            $user->givepermissionTo('hapus-user');
            $user->givepermissionTo('lihat-user');
            $user->givepermissionTo('tambah-donasi');
            $user->givepermissionTo('edit-donasi');
            $user->givepermissionTo('hapus-donasi');
            $user->givepermissionTo('lihat-donasi');
            $user->givepermissionTo('tambah-urundana');
            $user->givepermissionTo('edit-urundana');
            $user->givepermissionTo('hapus-urundana');
            $user->givepermissionTo('lihat-urundana');
            $user->givepermissionTo('tambah-merchandise');
            $user->givepermissionTo('edit-merchandise');
            $user->givepermissionTo('hapus-merchandise');
            $user->givepermissionTo('lihat-merchandise');
            $user->givepermissionTo('buat-pemberian-donasi');
            $user->givepermissionTo('lihat-pemberian-donasi');
            $user->givepermissionTo('update-pemberian-donasi');
            $user->givepermissionTo('hapus-pemberian-donasi');
            $user->givepermissionTo('buat-pemberian-urundana');
            $user->givepermissionTo('lihat-pemberian-urundana');
            $user->givepermissionTo('update-pemberian-urundana');
            $user->givepermissionTo('hapus-pemberian-urundana');
            $user->givepermissionTo('buat-pembelian-merchandise');
            $user->givepermissionTo('lihat-pembelian-merchandise');
            $user->givepermissionTo('edit-pembelian-merchandise');
            $user->givepermissionTo('hapus-pembelian-merchandise');

        } else {
            $user->givePermissionTo('register-akun');
            $user->givePermissionTo('edit-profile');
            $user->givePermissionTo('hapus-akun');
            $user->givePermissionTo('lihat-profile');
            $user->givePermissionTo('buat-pemberian-donasi');
            $user->givePermissionTo('lihat-pemberian-donasi');
            $user->givePermissionTo('buat-pemberian-urundana');
            $user->givePermissionTo('lihat-pemberian-urundana');
            $user->givePermissionTo('buat-pembelian-merchandise');
            $user->givePermissionTo('lihat-pembelian-merchandise');
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
