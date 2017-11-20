<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\User;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('backend.users');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(User::query())->make(true);
    }
}
