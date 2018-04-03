<?php

/**
 * PageController.php
 * Shows and Process the form.
 * Uses logic code integrated from Project 2 to Project 3.
 * Created By: Marc-Eli Faldas
 * Last Modified: 4/2/2018
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MoneyFormat;

class PageController extends Controller
{
    /*
     * Shows Form
     * @param $request: The request from the view
     * @return view('pages.index'): The view with input and errors/results
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
     * Process Form
     * Also puts data into the session so if the user were
     * to do a reload of the page, they can see the input they made.
     * @param $request: The request from the view
     * @return redirect('/'): The view with accompanying errors/results
     */
    public function calculation(Request $request)
    {
        //If there are validation error, puts the current results into
        //the session prior to validation so the user can see their input
        //as well as reload the page.
        $request->session()->put('bill', $request->bill);
        $request->session()->put('split', $request->split);
        $request->session()->put('tip', $request->tip);
        $request->session()->put('roundUp', $request->roundUp);

        //Validate the data
        $this->validate($request, [
            'bill' => ['required', new MoneyFormat],
            'split' => 'integer|min:1|max:100|required',
        ]);

        //If the validation fails, the user is automatically sent back to '/'
        //User can see all data since using old method.

        //Note:  If user puts in valid data and reloads the page, they can see
        //       it still because of putting the data into the session
        //       immediately.

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

        // Redirect back to the page and include the results
        return redirect('/')->with([
            'results' => $results,
            'calcError' => $calcError,
        ]);
    }
}
