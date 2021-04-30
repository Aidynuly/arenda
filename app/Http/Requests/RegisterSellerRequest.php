<?php

namespace App\Http\Requests;

use App\Services\DTO\User\RegisterSellerDTO;
use App\Services\Traits\CustomErrorMessage;
use Illuminate\Foundation\Http\FormRequest;

class RegisterSellerRequest extends FormRequest
{
    use CustomErrorMessage;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required',
            'phone'                 => 'required|unique:users,phone',
            'city_id'               => 'required|exists:cities,id',
            'type'                  => 'required|in:user,seller',
            'password'              => 'required',
            'surname'               => 'required',
            'houses'                => 'array|required',
            'houses.region_id'      => 'exists:regions,id',
            'houses.area'           => 'min:1',
            'houses.rooms'          => 'numeric',
            'houses.address'        => 'min:1',
            'houses.description'    => 'min:1',
            'houses.images'         => 'array',
            'houses.images.*'       => 'file',
        ];
    }

    public function getDTO(): RegisterSellerDTO
    {
        return RegisterSellerDTO::fromArray([
            'name'      => $this->get('name'),
            'surname'   => $this->get('surname'),
            'city_id'   => $this->get('city_id'),
            'type'      => $this->get('type'),
            'password'  => $this->get('password'),
            'phone'     => $this->get('phone'),
            'houses'    => $this->get('houses'),
        ]);
    }
}
