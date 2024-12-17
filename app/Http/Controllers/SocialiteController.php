<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect(); 
    }

    public function callback(){
        $userFromGoogle = Socialite::driver('google')->stateless()->user();

        $userFromDB = User::where('google_id', $userFromGoogle->getId())->first();

        if(!$userFromDB){
            $userFromDB = new User();
            $userFromDB->email = $userFromGoogle->getEmail();
            $userFromDB->google_id = $userFromGoogle->getId();
            $userFromDB->name = $userFromGoogle->getName();

            if(str_contains($userFromGoogle->getEmail(), '@admindonate.com')){
                $userFromDB->assignRole('admin');
                $userFromDB->save();
            } else {
                $userFromDB->assignRole('user');
                $userFromDB->save();
            }

            if('assignRole' === 'admin'){
                $userFromDB->givepermissionTo('register-akun');
                $userFromDB->givepermissionTo('edit-profile');
                $userFromDB->givepermissionTo('hapus-akun');
                $userFromDB->givepermissionTo('lihat-profile');
                $userFromDB->givepermissionTo('tambah-user');
                $userFromDB->givepermissionTo('edit-user');
                $userFromDB->givepermissionTo('hapus-user');
                $userFromDB->givepermissionTo('lihat-user');
                $userFromDB->givepermissionTo('tambah-donasi');
                $userFromDB->givepermissionTo('edit-donasi');
                $userFromDB->givepermissionTo('hapus-donasi');
                $userFromDB->givepermissionTo('lihat-donasi');
                $userFromDB->givepermissionTo('tambah-urundana');
                $userFromDB->givepermissionTo('edit-urundana');
                $userFromDB->givepermissionTo('hapus-urundana');
                $userFromDB->givepermissionTo('lihat-urundana');
                $userFromDB->givepermissionTo('tambah-merchandise');
                $userFromDB->givepermissionTo('edit-merchandise');
                $userFromDB->givepermissionTo('hapus-merchandise');
                $userFromDB->givepermissionTo('lihat-merchandise');
                $userFromDB->givepermissionTo('buat-pemberian-donasi');
                $userFromDB->givepermissionTo('lihat-pemberian-donasi');
                $userFromDB->givepermissionTo('update-pemberian-donasi');
                $userFromDB->givepermissionTo('hapus-pemberian-donasi');
                $userFromDB->givepermissionTo('buat-pemberian-urundana');
                $userFromDB->givepermissionTo('lihat-pemberian-urundana');
                $userFromDB->givepermissionTo('update-pemberian-urundana');
                $userFromDB->givepermissionTo('hapus-pemberian-urundana');
                $userFromDB->givepermissionTo('buat-pembelian-merchandise');
                $userFromDB->givepermissionTo('lihat-pembelian-merchandise');
                $userFromDB->givepermissionTo('edit-pembelian-merchandise');
                $userFromDB->givepermissionTo('hapus-pembelian-merchandise');
    
            } else {
                $userFromDB->givePermissionTo('register-akun');
                $userFromDB->givePermissionTo('edit-profile');
                $userFromDB->givePermissionTo('hapus-akun');
                $userFromDB->givePermissionTo('lihat-profile');
                $userFromDB->givePermissionTo('buat-pemberian-donasi');
                $userFromDB->givePermissionTo('lihat-pemberian-donasi');
                $userFromDB->givePermissionTo('buat-pemberian-urundana');
                $userFromDB->givePermissionTo('lihat-pemberian-urundana');
                $userFromDB->givePermissionTo('buat-pembelian-merchandise');
                $userFromDB->givePermissionTo('lihat-pembelian-merchandise');
            }
        }

        auth('web')->login($userFromDB);
        session()->regenerate();
        return redirect('home');
    }

    public function logout(Request $request){
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('home');
    }
}
