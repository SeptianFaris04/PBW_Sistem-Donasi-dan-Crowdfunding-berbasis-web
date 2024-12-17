<?php

namespace App\Observers;

use App\Models\Donasi;
use Illuminate\Support\Str;

class DonasiObserver
{
    public function creating(Donasi $donasi):void{
        $donasi->slug_donasis = Str::slug($donasi->name);
    }


    public function updating(Donasi $donasi):void {
        $donasi->slug_donasis = Str::slug($donasi->name);
    }
    // public function created(Donasi $donasi){
    //     $donasi->slug_donasis = Str()->donasi()->update()->slug($donasi->name);
    // }
}
