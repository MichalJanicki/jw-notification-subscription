<?php

namespace App\Http\Requests;

use App\DTOs\PersonDTO;
use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:3', 'max:20'],
            'last_name' => ['required', 'string', 'min:3', 'max:60'],
            'email' => ['required', 'email', 'min:6', 'max:100'],
            'phone' => ['required', 'string', 'size:12'],
            'sms_subscription' => ['boolean'],
            'email_subscription' => ['boolean'],
        ];
    }

    public function getDto(): PersonDTO
    {
        return new PersonDTO(
            $this->input('first_name'),
            $this->input('last_name'),
            $this->input('email'),
            $this->input('phone'),
            $this->input('sms_subscription', false),
            $this->input('email_subscription', false)
        );
    }
}
