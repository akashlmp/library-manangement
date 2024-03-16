<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        $library = [

            [
                'product' => 'test1',
            ],
            [
                'product' => 'test2',
            ],
            [
                'product' => 'test3',
            ],

        ];
        return view("library.main", compact('library'));
    }
}
