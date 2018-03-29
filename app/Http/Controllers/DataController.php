<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    private $request; //Gets the data from the user
    private $split;
    private $bill;
    private $tip;
    private $roundUp;

    public function __construct($request)
    {
        $this->request = $request;
        $this->split = $request->split; //How Many People to Split Amongst
        $this->bill = $request->bill; //Bill from User
        $this->tip = $request->tip; //How Much Tip
        $this->roundUp = $request->roundUp;
    }

    public function getDataParameters()
    {
        return array($this->split, $this->bill, $this->tip, $this->roundUp);
    }

    public function baseCaseData()  {
        return view('pages.calculation', [
            'standard' => true,
            'calculable' => null,
            'split' => null,
            'bill' => null,
            'tip' => '1',
            'roundUp' => 0
        ]);
    }

    public function validatorFailureData($validator) {
        return view('pages.calculation', [
            'split' => $this->split,
            'bill' => $this->bill,
            'roundUp' => $this->roundUp,
            'tip' => $this->tip
        ])
            ->witherrors($validator);
    }

    public function errorData() {
        return view('pages.calculation', [
            'standard' => false,
            'calculable' => false,
            'split' => $this->split,
            'bill' => $this->bill,
            'tip' => $this->tip,
            'roundUp' => $this->roundUp,
            'printResults' => null
        ]);
    }

    public function calculatedData($printResults) {
        return view('pages.calculation', [
            'standard' => false,
            'calculable' => true,
            'split' => $this->split,
            'bill' => $this->bill,
            'tip' => $this->tip,
            'roundUp' => $this->roundUp,
            'printResults' => $printResults
        ]);
    }
}
