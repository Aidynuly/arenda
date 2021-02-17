<?php

declare(strict_types=1);

namespace App\Services\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Trait CustomErrorMessage
 * @package App\Traits
 */
trait CustomErrorMessage
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error_code' => 422,
            'status'     => 'error',
            'message'    => $validator->errors()->first(),
            'data'       => null
        ], 422));
    }
}
