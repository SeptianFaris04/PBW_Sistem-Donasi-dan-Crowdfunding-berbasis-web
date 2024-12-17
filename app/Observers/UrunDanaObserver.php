<?php

namespace App\Observers;

use App\Models\UrunDana;
use Illuminate\Support\Str;

class UrunDanaObserver
{
    public function creating(UrunDana $urundana):void{
        $urundana->slug_urundana = Str::slug($urundana->name);
    }

    public function updating(UrunDana $urundana):void{
        $urundana->slug_urundana = Str::slug($urundana->name);
    }
}
