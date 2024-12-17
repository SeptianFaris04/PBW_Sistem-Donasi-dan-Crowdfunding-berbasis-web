<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    // Schema::create('categories', function (Blueprint $table) {
    //     $table->id();
    //     $table->string('name');
    //     $table->string('slug_categories')->unique();
    //     $table->string('color');
    //     $table->timestamps();
    // });

    protected $fillable = [
        'name',
        'slug_categories',
        'color'
    ];

    public function Donasi():HasOne{
        return $this->hasOne(Donasi::class, 'category_id');
    }

    public function UrunDana():HasOne{
        return $this->hasOne(UrunDana::class, 'urundana_id');
    }
}
