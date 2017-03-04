<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable{

    public $table = 'users';
    public $timestamps = false;

    public static function getDashboardData(){

        $userPastes = \App\PasteModel::where('author', '=', Auth::user() -> id)
        	->orderBy('created_at', 'DESC')
            ->get();

        return $userPastes;
    }
}
