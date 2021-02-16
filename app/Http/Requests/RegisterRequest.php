<?php

namespace App\Http\Requests;

use App\Services\DTO\User\RegisterDTO;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            //
        ];
    }

    public function getDTO()
    {
        return RegisterDTO::fromArray([
            'name' => $this->get('name'),
            'surname' => $this->get('surname'),
            'city_id' => $this->get('city_id'),
            'type' => $this->get('type'),
            'password' => $this->get('password'),
            'phone' => $this->get('phone'),
        ]);
    }
}
