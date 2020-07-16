<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = [
        'subject','problem','choice1','choice2','choice3',
        'choice4','answer','user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
