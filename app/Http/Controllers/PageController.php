<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MoneyFormat;
use Validator;

class PageController extends Controller
{

    public function calculation(Request $request)
    {
        if (!$request->has('bill')) {
            return view('pages.calculation', [
                'standard' => true,
                'split' => null,
                'bill' => null,
                'tip' => '1',
                'roundUp' => 0
                ]);
        }

        //$request->session()->put('split', $request->input('split'));
        //$request->session()->put('bill', $request->input('bill'));

        $split = $request->get("split"); //How Many People to Split Amongst
        $bill = $request->get("bill"); //Bill from User
        $tip = $request->get("tip"); //How Much Tip
        $roundUp = $request->has("roundUp");

        $validator = Validator::make($request->all(), [
            "bill" => ["required", new MoneyFormat],
            "split" => "integer|min:1|max:100|required",
        ]);

        if ($validator->fails()) {
            return view('pages.calculation', [
                'split' => $split,
                'bill' => $bill,
                'roundUp' => $roundUp,
                'tip' => $tip
                ])
                ->withErrors($validator);
        }

        $splitter = new SplitterController($split, $bill, $tip, $roundUp);

        $billWithTip = $splitter->getBillWithTip();
        $calcS = $splitter->calculatedSplit($billWithTip);

        //Creates an array with people who pay normal and how many pay extra by 1 cent
        //Ex. 9.99/4 = 1 person owes 2.49 and 3 people owe $2.50
        $splitBetween = $splitter->splitWays($billWithTip, $calcS);

        if ($calcS < 0.01) {
            return view('pages.calculation', [
                'standard' => false,
                'calculable' => false,
                'split' => $split,
                'bill' => $bill,
                'roundUp' => $roundUp,
                'tip' => $tip,
                'printResults' => null
            ]);
        } else {
            if ($roundUp == true) {
                $splitBetween = $splitter->roundWhole($splitBetween);
            }
        }

        $printResults = $splitter->resultMaker($splitBetween);

        return view('pages.calculation', [
            'standard' => false,
            'calculable' => true,
            'split' => $split,
            'bill' => $bill,
            'roundUp' => $roundUp,
            'tip' => $tip,
            'printResults' => $printResults
        ]);
    }

}
