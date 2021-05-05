<?php

declare(strict_types=1);

namespace App\Services\Handlers\House;

use App\Models\House;
use App\Models\HouseImage;
use App\Services\DTO\House\AddHouseDTO;
use App\Services\Traits\ImageUploadTrait;

/**
 * Class AddHouseHandler
 * @package App\Services\Handlers\House
 */
class AddHouseHandler
{
    use ImageUploadTrait;

    /**
     * @param AddHouseDTO $houseDTO
     */
    public function handle(AddHouseDTO $houseDTO): void
    {
        $house = House::create($houseDTO->toArray());

        foreach ($houseDTO->images as $image) {
            HouseImage::create([
                'house_id' => $house->id,
                'image_url' => $this->uploadImage($image),
            ]);
        }
    }
}
