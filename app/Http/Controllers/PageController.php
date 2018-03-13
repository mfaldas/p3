<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\ErrorController;

class PageController extends Controller
{
    public function welcomePage() {
        return view('layouts.welcome');
    }

    public function errorPage() {
        $e = new ErrorController();
        return $e->error();
    }

    public function calculatedPage() {
        $c = new CalculateController();
        return $c->calculate();
    }
}
