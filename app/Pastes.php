<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Pastes extends Model{

    // Disable Laravel's updated_at
    public function getUpdatedAtColumn(){
        
    }

    public static function getPaste($pasteStringID){

        $pasteData = self::where('string_id', '=', $pasteStringID)
            ->leftJoin('users', 'pastes.author', '=', 'users.id')
            ->where('expiry_at', '>', \DB::raw('now()'))
            ->get();

        if($pasteData -> isEmpty()){

            return false;
        }

        self::where('string_id', '=', $pasteStringID)
            ->increment('views');

        return $pasteData;
    }

    public static function addPasteToDatabase($pasteContent, $pasteExpiryDate, $pasteAuthor, $pasteTitle, $pasteIsPrivate, $pasteSyntaxHighlighting){

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
            'created_at' => \DB::raw('now()'),
            'is_private' => $pasteIsPrivate,
            'views' => '0',
            'syntax' => $pasteSyntaxHighlighting]);

    	if(!$insert){

    		return false;
    	}

        return $pasteStringID;
    }

    public static function getLastPastes(){

        $latestPastes = self::where('expiry_at', '>', \DB::raw('now()'))
            ->where('is_private', '=', '0')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return $latestPastes;
    }

    public static function getPopularPastes(){

        $popularPastes = self::orderBy('views', 'desc')
            ->leftJoin('users', 'pastes.author', '=', 'users.id')
            ->where('is_private', '=', '0')
            ->limit(10)
            ->get();

        if($popularPastes -> isEmpty()){

            return false;
        }

        return $popularPastes;
    }

    public static function removePasteFromDatabase($pasteStringID){

        $pasteAuthor = self::where('string_id', '=', $pasteStringID)
            ->select('author')
            ->get()[0]->author;

        if(Auth::user()->id != $pasteAuthor){

            return false;
        }

        self::where('string_id', '=', $pasteStringID)
            ->delete();

        return true;
    }
}
