<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    protected $table = 'payments';

    // 'user_id' => Auth::user()->id,
    //             'email' => $data['email'],
    //             'name' => $data['name'],
    //             'donasi_id' => $data['donasi_id'],
    //             'pesan' => $request->pesan,
    //             'phone' => $request->phone,
    //             'amount' => $data['amount'],
    //             'snap_token' => $snapToken,
    //             'status' => 'pending',
    protected $fillable = [
        'user_id',
        'donasi_id',
        'urundana_id',
        'name',
        'phone',
        'pesan',
        'amount',
        'order_id',
        'status',
    ];

    public function User():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function Donasi():BelongsTo{
        return $this->belongsTo(Donasi::class);
    }

    public function UrunDana():BelongsTo{
        return $this->belongsTo(UrunDana::class);
    }

     /**
     * Set status to Pending
     *
     * @return void
     */
    public function setStatusPending()
    {
        $this->attributes['status'] = 'pending';
        self::save();
    }

    /**
     * Set status to Success
     *
     * @return void
     */
    public function setStatusSuccess()
    {
        $this->attributes['status'] = 'success';
        self::save();
    }

    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setStatusFailed()
    {
        $this->attributes['status'] = 'failed';
        self::save();
    }

    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setStatusExpired()
    {
        $this->attributes['status'] = 'expired';
        self::save();
    }
}
