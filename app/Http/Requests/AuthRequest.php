<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Services\DTO\User\RegisterDTO;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AuthRequest
 * @package App\Http\Requests
 */
class AuthRequest extends FormRequest
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
            'phone' => 'required|exists:users,phone',
            'password' => 'required',
        ];
    }
}
