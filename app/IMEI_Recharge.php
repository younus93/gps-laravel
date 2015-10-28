<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IMEI_Recharge extends Model
{
    protected $table = 'imei_recharge';
    public $timestamps = false;
    protected $fillable = [
        'imei_id',
        'recharge_date',
        'transaction_id',
        'recharge_method',
    ];

    public function imei()
    {
        return $this->belongsTo('App\IMEI_User','imei_id');
    }
}
