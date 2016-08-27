<?php

namespace App\Http\Controllers\APP\Admin;

use App\Http\Controllers\APP\Admin\AdminBaseController;

class HomeController extends AdminBaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('admin.home');
    }
}
