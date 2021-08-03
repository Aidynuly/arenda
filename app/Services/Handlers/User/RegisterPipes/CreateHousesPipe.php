<?php

declare(strict_types=1);

namespace App\Services\Handlers\User\RegisterPipes;

use App\Models\Comfort;
use App\Models\Comforts;
use App\Models\House;
use App\Models\HouseImage;
use App\Services\DTO\User\RegisterSellerDTO;
use App\Services\Traits\ImageUploadTrait;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Log;

/**
 * Class CreateHousesPipe
 * @package App\Services\Handlers\User\RegisterPipes
 */
class CreateHousesPipe
{
    use ImageUploadTrait;

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
                    'user_id'       => $registerSellerDTO->user->id,
                    'description'   => $house['description'],
                    'region_id'     => $house['region_id'],
                    'area'          => $house['area'],
                    'rooms'         => $house['rooms'],
                    'address'       => $house['address'],
                    'lat'           => $house['lat'],
                    'long'          => $house['long'],
                ]);
                if (array_key_exists('images', $house)) {
                    foreach ($house['images'] as $image) {
                        HouseImage::create([
                            'house_id'  => $createdHouse->id,
                            'image_url' => $this->uploadImage($image),
                        ]);
                    }
                }
                if (array_key_exists('comforts', $house)) {
                    $this->createComforts($house['comforts'], $createdHouse->id);
                }
            }
        }

        return $next($registerSellerDTO);
    }


    private function createComforts(array $data, int $houseId): void
    {
        foreach ($data as $item) {
            Comforts::create([
                'house_id' => $houseId,
                'comfort_types_id' => $item
            ]);
        }
    }
}
