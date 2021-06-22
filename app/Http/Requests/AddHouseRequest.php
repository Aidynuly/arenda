<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Services\DTO\House\AddHouseDTO;
use App\Services\Traits\CustomErrorMessage;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AddHouseRequest
 * @package App\Http\Requests
 */
final class AddHouseRequest extends FormRequest
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
            'description'   => 'required',
            'region_id'     => 'required|exists:regions,id',
            'area'          => 'required',
            'rooms'         => 'required',
            'address'       => 'required',
            'images'        => 'array',
            'images.*'      => 'file',
            'lat'           => 'required',
            'long'          => 'required',
        ];
    }

    /**
     * @return AddHouseDTO
     */
    public function getDTO(): AddHouseDTO
    {
        return AddHouseDTO::fromArray([
            'user'          => $this->get('user'),
            'description'   => $this->get('description'),
            'region_id'     => $this->get('region_id'),
            'area'          => $this->get('area'),
            'rooms'         => $this->get('rooms'),
            'address'       => $this->get('address'),
            'lat'           => $this->get('lat'),
            'long'          => $this->get('long'),
            'images'        => $this->allFiles()['images'] ?? [],
        ]);
    }
}
