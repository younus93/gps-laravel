<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IMEI_User extends Model
{

    protected $table = 'imei_user';

    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function recharges()
    {
        return $this->hasMany('App\IMEI_Recharge','imei_id');
    }
}
