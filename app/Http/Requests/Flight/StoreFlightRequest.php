<?php

namespace App\Http\Requests\Flight;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFlightRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = auth()->user();

        return [
            'origin'      => 'required|exists:airports,id',
            'destination' => 'required|exists:airports,id|different:origin',
            'airplane_id' => 'required|exists:airplanes,id',
            'sender'      => 'required|exists:airlines,id',
            'receiver'    => 'required|exists:airlines,id|different:sender'
        ];
    }
}
