<?php

declare(strict_types=1);

namespace App\Services\Handlers\Offers;

use App\Models\Offer;
use App\Models\User;

/**
 * Class GetOffersByUserHandler
 * @package App\Services\Handlers\Offers
 */
class GetOffersByUserHandler
{
    /**
     * @param User $user
     * @return Offer[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function handle(User $user)
    {
        $offers = Offer::whereUserId($user->id)->get();

        return $offers;
    }
}
