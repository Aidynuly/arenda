<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Services\Traits\CustomErrorMessage;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class VerifyCodeRequest
 * @package App\Http\Requests
 */
class VerifyCodeRequest extends FormRequest
{
    use CustomErrorMessage;

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
            'code'  => 'required',
            'phone' => 'required',
        ];
    }
}
