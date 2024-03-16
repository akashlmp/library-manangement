<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\StoreSellerRequest;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index(Request $request)
    {
        $libraryQuery = Book::with('seller', 'category')->where('seller_id', $request->user()->id);

        if (isset($request->search) && $request->search != '') {
            $libraryQuery->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }
        else{
            $libraryQuery->orderByDesc('created_at');
        }
        $library = $libraryQuery->paginate(10);

        $bookCategories = BookCategory::all();

        $data['bookCategories'] = $bookCategories;
        $data['library'] = $library;

        if ($request->ajax()) {
            return response()->json(compact('data'));
        }

        return view("seller.catelog", compact('data'));
    }


    public function create(StoreSellerRequest $request)
    {
        $requestData = $request->validated();

        Book::create([
            'name' => $requestData['book_name'],
            'author' => $requestData['author_name'],
            'category_id' => $requestData['category'],
            'price' => $requestData['price'],
            'seller_id' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Data stored successfully'
        ], 200);
    }
}
