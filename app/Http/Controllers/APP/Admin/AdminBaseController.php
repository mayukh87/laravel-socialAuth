<?php

namespace App\Http\Controllers\APP\Admin;

use App\Http\Controllers\Controller;

class AdminBaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
