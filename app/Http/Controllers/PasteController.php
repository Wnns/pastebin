<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests;

class PasteController extends Controller{
    
    public function viewPaste($pasteStringID){

        $pasteData = \App\PasteModel::where('pasteStringID', '=', $pasteStringID)->where('pasteExpiryDate', '>', \DB::raw('now()'))->get();

        if($pasteData -> count() == 0){

            return view('notfound');
        }

        return view('paste', $pasteData[0]);
    }

    public function addPaste(Request $request){

        $pasteContent; $pasteExpiryDate = 'Never'; $pasteAuthor;

        $this -> validate($request, [

            'pasteContent' => 'required',
        ]);

        $expiryDates = [

            'Never' => "interval '100' year",
            '5 minutes' => "interval '5' minute",
            '30 minutes' => "interval '30' minute",
            '1 hour' => "interval '1' hour",
            '1 day' => "interval '1' day",
            '1 week' => "interval '1' week",
            '1 month' => "interval '1' month"
        ];

        foreach ($expiryDates as $key => $value) {
            
            if($request ->input('pasteExpiryDate') == $key){

                $pasteExpiryDate = $value;
                break;
            }
        }

        $pasteContent = $request -> input('pasteContent');
        $pasteAuthor = $request -> input('pasteAuthor');

        $insert = \App\PasteModel::addPasteToDatabase($pasteContent, $pasteExpiryDate, $pasteAuthor);

        if(!$insert){

            return back()->withInput()->withErrors('Error occured while adding this paste.');
        }

        return redirect("p/$insert");
    }
}
