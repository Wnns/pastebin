<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasteModel extends Model{

    public $table = "pastes";

    public static function addPasteToDatabase($pasteContent, $pasteExpiryDate, $pasteAuthor, $pasteTitle){

        echo $pasteExpiryDate;

    	$pasteStringID;

    	while(true){

    		$pasteStringID = str_random(6);

    		if(self::where('string_id', '=', $pasteStringID)->count() == 0){

    			break;
    		}
    	}

    	$insert = self::insert(
    		['string_id' => $pasteStringID, 
    		'content' => $pasteContent,
            'title' => $pasteTitle,
            'author' => $pasteAuthor,
            'expiry_at' => \DB::raw('now() + ' . $pasteExpiryDate),
            'created_at' => \DB::raw('now()')]);

    	if(!$insert){

    		return false;
    	}

        return $pasteStringID;
    }

    public static function getLastPastes(){

        $latestPastes = \App\PasteModel::where('expiry_at', '>', \DB::raw('now()'))->orderBy('created_at', 'desc')->limit(5)->get();
        return $latestPastes;
        
    }
}
