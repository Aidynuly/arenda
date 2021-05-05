<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\HouseImage;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HouseImageResource
 * @package App\Http\Resources
 * @mixin HouseImage
 */
final class HouseImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'image_url' => url('uploads/' . $this->image_url),
        ];
    }
}
