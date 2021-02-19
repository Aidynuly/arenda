<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Services\DTO\OfferStatusDTO;
use App\Services\Traits\CustomErrorMessage;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateOfferStatusRequest
 * @package App\Http\Requests
 */
class CreateOfferStatusRequest extends FormRequest
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
            'offer_id' => 'required|exists:offers,id',
            'house_id' => 'required|exists:houses,id',
            'price'    => 'required',
        ];
    }

    /**
     * @return OfferStatusDTO
     */
    public function getDTO(): OfferStatusDTO
    {
        return OfferStatusDTO::fromArray([
            'user'      => $this->get('user'),
            'price'     => $this->get('price'),
            'house_id'  => $this->get('house_id'),
            'offer_id'  => $this->get('offer_id'),
        ]);
    }
}
