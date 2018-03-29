<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MoneyFormat;
use Validator;

class PageController extends Controller
{

    public function calculation(Request $request)
    {
        $dC = new DataController($request);

        // Base Case if the User is Logging in for the first Time
        // No Data form has been submitted yet
        if (!$request->has('bill')) {
            return $dC->baseCaseData();
        }

        $validator = Validator::make($request->all(), [
            "bill" => ["required", new MoneyFormat],
            "split" => "integer|min:1|max:100|required",
        ]);

        // If validation fails, present error messages and the
        // the errors.
        if ($validator->fails()) {
            return $dC->validatorFailureData($validator);
        }

        $data = $dC->getDataParameters();
        $splitter = new SplitterController($data[0], $data[1], $data[2], $data[3]);

        $billWithTip = $splitter->getBillWithTip();
        $calcS = $splitter->calculatedSplit($billWithTip);

        //Creates an array with people who pay normal and how many pay extra by 1 cent
        //Ex. 9.99/4 = 1 person owes 2.49 and 3 people owe $2.50
        $splitBetween = $splitter->splitWays($billWithTip, $calcS);

        if ($calcS < 0.01) {
            return $dC->errordata();
        } else {
            if ($data[3] == true) {
                $splitBetween = $splitter->roundWhole($splitBetween);
            }
        }

        $printResults = $splitter->resultMaker($splitBetween);

        return $dC->calculatedData($printResults);
    }
}
