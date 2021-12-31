<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCheckInRequest extends FormRequest
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
            'name' => 'required|max:100',
            'user_id' => 'required|exists:App\Models\User,id',
            'interval' => [
                'string',
                'required',
                Rule::in(
                    [
                        'weekly',
                        'bi-weekly',
                        'monthly',
                        'semi-annually',
                        'annually'
                    ]
                )
            ],
            'birthday' => 'nullable|date',
            'notes' => 'nullable|string|max:500'
        ];
    }
}
