<?php

namespace App\Http\Requests;

use App\Models\CheckIn;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCheckInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $checkIn = CheckIn::where('id', $this->route('checkIn')->id)
            ->first();

        return $this->user()->can('update', $checkIn);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'max:100',
            'interval' => [
                'string',
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
            'birthday' => 'date',
            'notes' => 'string|max:500'
        ];
    }
}
