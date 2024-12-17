<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donasi extends Model
{
    // $table->id();
    // $table->foreignId('user_id')->constrained(
    //     table: 'users',
    //     indexName: 'donasis_user_id'
    // );
    // $table->foreignId('category_id')->constrained(
    //     table: 'categories',
    //     indexName: 'donasis_categories_id'
    // );
    // $table->string('foto')->nullable();
    // $table->string('name');
    // $table->string('slug_donasis')->unique();
    // $table->text('description');
    // $table->unsignedBigInteger('jumlah_orang')->nullable();
    // $table->unsignedBigInteger('dana_terkumpul')->nullable();
    // $table->unsignedBigInteger('jumlah_target_dana');
    // $table->dateTime('Tanggal_Batas_Donasi');
    // $table->timestamps();
    protected $table = 'donasis';

    protected $fillable = [
        'foto',
        'user_id',
        'category_id',
        'name',
        'slug_donasis',
        'description',
        'tanggal_batas_donasi',
        'jumlah_target_dana',
    ];

    public function User():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function Category():BelongsTo{
        return $this->belongsTo(Category::class);
    }
}
