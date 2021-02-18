<?php

declare(strict_types=1);

namespace App\Services\Handlers\User\RegisterPipes;

use App\Models\House;
use App\Models\HouseImage;
use App\Services\DTO\User\RegisterSellerDTO;

/**
 * Class CreateHousesPipe
 * @package App\Services\Handlers\User\RegisterPipes
 */
class CreateHousesPipe
{
    /**
     * @param RegisterSellerDTO $registerSellerDTO
     * @param \Closure $next
     * @return mixed
     */
    public function handle(RegisterSellerDTO $registerSellerDTO, \Closure $next)
    {
        if (! empty($registerSellerDTO->houses)) {
            foreach ($registerSellerDTO->houses as $house) {
                $createdHouse = House::create([
                    'user_id' => $registerSellerDTO->user->id,
                    'description' => $house['description'],
                    'region_id' => $house['region_id'],
                    'area' => $house['area'],
                    'rooms' => $house['rooms'],
                    'address' => $house['address'],
                ]);

                foreach ($house['images'] as $image) {
                    //Todo download image and save it

                    HouseImage::create([
                        'house_id'  => $createdHouse->id,
                        'image_url' => 'testing',
                    ]);
                }
            }
        }

        return $next($registerSellerDTO);
    }
}
