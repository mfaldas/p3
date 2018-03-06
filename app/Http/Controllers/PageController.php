<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CalculateController;

class PageController extends Controller
{
    public function welcomePage() {
        return 'This will be the welcome page for The Bill Splitter.';
    }

    public function errorPage() {
        return 'There is an error with the calculation.  Will show the error.';
    }

    public function calculatedPage() {
        $c = new CalculateController();
        return $c->calculate();
    }
}
