<?php

namespace Modules\ShopModule\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopGetAllRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'offset'    => 'nullable|integer|min:0',
            'limit'     => 'nullable|integer|min:5',
            'order_by'  => [
                'nullable',
                Rule::in(['id', 'user_id', 'name'])
            ],
            'order_type' => [
                'nullable',
                Rule::in(['asc', 'desc'])
            ],
        ];
    }
}
