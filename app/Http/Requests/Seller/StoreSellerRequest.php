<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Request;

class StoreSellerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    public function __construct()
    {

    }

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'book_name' => 'required|string',
            'author_name' => 'required|string',
            'category' => 'required|numeric',
            'price' => 'required|numeric|gt:0',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
