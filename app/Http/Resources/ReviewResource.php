<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Casts\ReviewDateCast;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ReviewResource
 * @package App\Http\Resources
 * @mixin Review
 */
final class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'text'      => $this->text,
            'star'      => $this->star,
            'date'      => $this->created_at,
            'user_id'   => $this->user_id,
            'name'      => $this->user->surname.' '.$this->user->name,
        ];
    }
}
