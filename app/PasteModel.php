<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasteModel extends Model{

    public $table = "pastes";
    public $primaryKey = "pasteID";

    public static function addPasteToDatabase($pasteContent, $pasteExpiryDate, $pasteAuthor){

        echo $pasteExpiryDate;

    	$pasteStringID;

    	while(true){

    		$pasteStringID = str_random(6);

    		if(self::where('pasteStringID', '=', $pasteStringID)->count() == 0){

    			break;
    		}
    	}

    	$insert = self::insert(
    		['pasteStringID' => $pasteStringID, 
    		'pasteContent' => $pasteContent,
            'pasteAuthor' => $pasteAuthor,
            'pasteExpiryDate' => \DB::raw('now() + ' . $pasteExpiryDate),
            'pasteCreatedDate' => \DB::raw('now()')]);

    	if(!$insert){

    		return false;
    	}

        return $pasteStringID;
    }

    public static function getLastPastes(){

        $latestPastes = \App\PasteModel::where('pasteExpiryDate', '>', \DB::raw('now()'))->orderBy('pasteCreatedDate', 'desc')->limit(5)->get();
        return $latestPastes;
        
    }
}
