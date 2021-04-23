<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Http\Resources
 * @mixin User
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'token'     => $this->token,
            'name'      => $this->name,
            'surname'   => $this->surname,
            'phone'     => $this->phone,
            'type'      => $this->type,
            'city'      => new CityResource($this->city),
        ];
    }
}
