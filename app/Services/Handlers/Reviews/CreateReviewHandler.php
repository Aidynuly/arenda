<?php

declare(strict_types=1);

namespace App\Services\Handlers\Reviews;

use App\Exceptions\AlreadyHasReviewException;
use App\Models\Review;
use App\Models\User;
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
     * @throws AlreadyHasReviewException
     */
    public function handle(ReviewDTO $reviewDTO): Review
    {
        $this->validate($reviewDTO->user, (int)$reviewDTO->houseId);
        return Review::create($reviewDTO->toArray());
    }

    /**
     * @param User $user
     * @param int $houseId
     * @throws AlreadyHasReviewException
     */
    private function validate(User $user, int $houseId): void
    {
        $alreadyHasReview = Review::whereUserId($user->id)
            ->whereHouseId($houseId)
            ->exists();

        if ($alreadyHasReview) {
            throw new AlreadyHasReviewException('Вы уже оставили отзыв');
        }
    }
}
