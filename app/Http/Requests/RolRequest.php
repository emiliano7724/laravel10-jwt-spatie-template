<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'guard_name' => ['required'],
        ];
    }
}
