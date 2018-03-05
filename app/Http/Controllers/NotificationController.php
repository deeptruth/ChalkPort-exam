<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        return view('notification');
    }

    /**
     * @param Request $request
     */
    public function notify(Request $request)
    {

    }
}