<?php

declare(strict_types=1);

namespace App\Services\Handlers\Reviews;

use App\Models\Review;
use App\Services\DTO\ReviewDTO;

/**
 * Class CreateReviewHandler
 * @package App\Services\Handlers\Reviews
 */
class CreateReviewHandler
{
    /**
     * @param ReviewDTO $reviewDTO
     * @return Review
     */
    public function handle(ReviewDTO $reviewDTO): Review
    {
        return Review::create($reviewDTO->toArray());
    }
}
