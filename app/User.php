<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable{

    public $table = 'users';
    public $timestamps = false;
    protected $fillable = ['name', 'password', 'email'];

    public static function getDashboardData(){

        $userPastes = \App\PasteModel::where('author', '=', Auth::user() -> id)
        	->orderBy('created_at', 'DESC')
            ->get();

        return $userPastes;
    }
}
