<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RegionResource
 * @package App\Http\Resources
 * @mixin Region
 */
final class RegionResource extends JsonResource
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
            'id'    => $this->id,
            'title' => $this->title,
        ];
    }
}
