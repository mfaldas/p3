<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MoneyFormat;

class PageController extends Controller
{
    public function welcomePage()
    {
        return view('pages.welcome');
    }

    public function errorPage() {
        return view('pages.error');
    }

    public function calculationPage($printResults) {
        return view('pages.calculation')->with('printResults', $printResults);
    }

    public function show(Request $request)
    {
        $this->validate($request, [
            "bill" => ["required", new MoneyFormat],
            "split" => "integer|min:1|max:100|required",
        ]);

        $split = $request->get("split", ""); //How Many People to Split Amongst
        $bill = $request->get("bill", ""); //Bill from User
        $tip = isset($_GET["tip"]) ? $_GET["tip"] : "1"; //How Much Tip
        $roundUp = $request->has("roundUp");

        $splitter = new SplitterController($split, $bill, $tip, $roundUp);

        $billWithTip = $splitter->getBillWithTip();
        $calcS = $splitter->calculatedSplit($billWithTip);

        //Creates an array with people who pay normal and how many pay extra by 1 cent
        //Ex. 9.99/4 = 1 person owes 2.49 and 3 people owe $2.50
        $splitBetween = $splitter->splitWays($billWithTip, $calcS);

        if ($calcS < 0.01) {
            $request->flash();
            return redirect()->action(
                'PageController@errorPage'
            );
        } else {
            if ($roundUp == true) {
                $splitBetween = $splitter->roundWhole($splitBetween);
            }
        }

        $printResults = $splitter->resultMaker($splitBetween);

        $request->flash();
        return redirect()->action( 'PageController@calculationPage', ['calculation' => $printResults] );
    }

}
