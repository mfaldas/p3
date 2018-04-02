<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MoneyFormat;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    /*
     * Showing Form
     */
    public function index(Request $request)
    {
        $results = $request->session()->get('results');
        $calcError = $request->session()->get('calcError');
        $bill = $request->session()->get('bill');
        $split = $request->session()->get('split');
        $tip = $request->session()->get('tip');
        $roundUp = $request->session()->get('roundUp');

        return view('pages.index')->with([
            'results' => $results,
            'calcError' => $calcError,
            'split' => $split,
            'bill' => $bill,
            'tip' => $tip,
            'roundUp' => $roundUp

        ]);
    }

    /*
     * Processing Form
     */

    public function calculation(Request $request)
    {
        //Validate the data
        $this->validate($request, [
            'bill' => ['required', new MoneyFormat],
            'split' => 'integer|min:1|max:100|required',
        ]);

        //If the validation fails, the user automatically sent back to '/'

        //Run the Calculation
        $splitter = new SplitterController(
            $request->split,
            $request->bill,
            $request->tip,
            $request->roundUp
        );

        $calcError = false;
        $billWithTip = $splitter->getBillWithTip();
        $calcS = $splitter->calculatedSplit($billWithTip);

        //Creates an array with people who pay normal and how many pay extra by 1 cent
        //Ex. 9.99/4 = 1 person owes 2.49 and 3 people owe $2.50
        $splitBetween = $splitter->splitWays($billWithTip, $calcS);

        if ($calcS < 0.01) {
            $calcError = true;
        } else {
            if ($request->roundUp == true) {
                $splitBetween = $splitter->roundWhole($splitBetween);
            }
        }

        $results = $splitter->resultMaker($splitBetween);

        $request->session()->put('bill', $request->bill);
        $request->session()->put('split', $request->split);
        $request->session()->put('tip', $request->tip);
        $request->session()->put('roundUp', $request->roundUp);

        // redirect back to the page and include the results
        return redirect('/')->with([
            'results' => $results,
            'calcError' => $calcError,
        ]);
    }

}
