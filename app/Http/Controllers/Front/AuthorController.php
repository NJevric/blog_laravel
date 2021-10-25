<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

class AuthorController extends OsnovniController
{
    //
    public function index()
    {
       
        return view('author', $this->data);
    }
}
