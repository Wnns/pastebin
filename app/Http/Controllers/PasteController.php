<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests;
use Auth;

class PasteController extends Controller{
    
    public function viewPaste($pasteStringID){

        $pasteData = \App\PasteModel::getPaste($pasteStringID);

        if(!$pasteData){

            return view('notfound');
        }

        return view('paste', $pasteData[0]);
    }

    public function viewPopularPastes(){

        $popularPastes = \App\PasteModel::getPopularPastes();

        return view('popular', compact('popularPastes'));
    }

    public function addPaste(Request $request){

        $pasteContent; $pasteExpiryDate = 'Never'; $pasteAuthor; $pasteTitle; $pasteSyntaxHighlight = 'None';

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

        $sytnaxHighlights = [

            'C#',
            'C++',
            'CSS',
            'HTML',
            'JSON',
            'Java',
            'JavaScript',
            'None',
            'PHP',
            'Python',
            'Ruby',
            'SQL',
        ];

        foreach ($expiryDates as $key => $value) {
            
            if($request ->input('pasteExpiryDate') == $key){

                $pasteExpiryDate = $value;
                break;
            }
        }

        foreach ($sytnaxHighlights as $value) {
            
            if($request ->input('pasteSyntaxHighlighting') == $value){

                $pasteSyntaxHighlighting = $value;
                break;
            }
        }

        $pasteContent = $request -> input('pasteContent');

        if(Auth::check()){

            $pasteAuthor = Auth::user() -> id;
        }
        else{

            $pasteAuthor = '0';
        }
        
        $pasteTitle = $request -> input('pasteTitle');
        $pasteIsPrivate = $request -> input('pasteIsPrivate');

        $pasteAuthor = (empty($pasteAuthor) ? 'Anonymous' : $pasteAuthor);
        $pasteTitle = (empty($pasteTitle) ? 'Untitled' : $pasteTitle);
        $pasteIsPrivate = (empty($pasteIsPrivate) ? '0' : '1');

        $dbInsert = \App\PasteModel::addPasteToDatabase($pasteContent, $pasteExpiryDate, $pasteAuthor, $pasteTitle, $pasteIsPrivate, $pasteSyntaxHighlighting);

        if(!$dbInsert){

            return back()->withInput()->withErrors('Error occured while adding this paste.');
        }
        
        return redirect("p/$dbInsert");
    }

    public function removePaste($pasteStringID){

        \App\PasteModel::removePasteFromDatabase($pasteStringID);
        return redirect('/dashboard');
    }

    public function viewRawPaste($pasteStringID){

        $pasteData = \App\PasteModel::getPaste($pasteStringID);

        if(!$pasteData){

            return view('notfound');
        }

        echo '<pre>';
        echo htmlspecialchars($pasteData[0]->content);
        echo '</pre>';

        return;
    }
}
