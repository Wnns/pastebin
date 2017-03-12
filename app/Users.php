<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Pastes as Pastes;

class Users extends Authenticatable{

    public $timestamps = false;
    protected $fillable = ['name', 'password', 'email'];

    public static function getDashboardData(){

        $userPastes = Pastes::where('author', '=', Auth::user() -> id)
        	->orderBy('created_at', 'DESC')
            ->get();

        return $userPastes;
    }
}
