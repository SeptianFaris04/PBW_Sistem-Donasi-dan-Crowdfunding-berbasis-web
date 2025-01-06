<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UrunDana extends Model
{
    protected $table = 'urundanas';

    protected $fillable = [
        'foto',
        'user_id',
        'category_id',
        'name',
        'slug_urundana',
        'description',
        'jumlah_target_dana',
        'tanggal_batas_urundana',
    ];

    public function User():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function Category():BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function PaymentUrunDana():HasMany{
        return $this->hasMany(Payment::class, 'urundana_id');
    }

    public function getTotalUrunDanaAtribute(){
        return $this->donasis()->where('status', 'success')->sum('amount');
    }
}
