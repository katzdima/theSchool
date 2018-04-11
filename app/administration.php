<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class administration extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    
    public function roleText()
    {
        return $this->belongsTo('App\role','role');
    }
}
