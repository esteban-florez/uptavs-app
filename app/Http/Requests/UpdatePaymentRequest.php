<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'ref' => [
                'required_if:type,'.payTypes()->take(2)->join(','),
                'numeric', 'integer', 'digits_between:4,10',
            ],
            'amount' => ['required', 'numeric'],
            'type' => ['required', 'in:'.payTypes()->join(',')],
        ];
    }
}
