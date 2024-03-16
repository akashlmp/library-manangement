<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $libraryQuery = Book::with('seller', 'category');
        if (isset($request->search) && $request->search != '') {
            $libraryQuery->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        } else {
            $libraryQuery->orderByDesc('created_at');
        }
        $library = $libraryQuery->paginate(10);
        $data['library'] = $library;

        if ($request->ajax()) {
            return response()->json(compact('data'));
        }
        return view("library.main", compact('data'));
    }
}
