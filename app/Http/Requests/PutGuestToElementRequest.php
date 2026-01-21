<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PutGuestToElementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ← TO JEST KLUCZOWE
    }

    public function rules(): array
    {
        return [
            'element_id' => ['required', 'integer'],
        ];
    }
}