<?php

declare(strict_types=1);

namespace App\Services\Handlers\User\RegisterPipes;

use App\Models\User;
use App\Services\DTO\User\RegisterSellerDTO;
use App\Services\Traits\ConstructionHelper;
use Illuminate\Support\Str;

/**
 * Class SellerRegisterPipe
 * @package App\Services\Handlers\User\RegisterPipes
 */
class SellerRegisterPipe
{
    use ConstructionHelper;

    /**
     * @param RegisterSellerDTO $sellerDTO
     * @param \Closure $next
     * @return mixed
     */
    public function handle(RegisterSellerDTO $sellerDTO, \Closure $next)
    {
        $user = User::create([
            'surname'   => $sellerDTO->surname,
            'name'      => $sellerDTO->name,
            'type'      => $sellerDTO->type,
            'city_id'   => $sellerDTO->cityId,
            'password'  => $sellerDTO->password,
            'phone'     => $this->getNormalPhone($sellerDTO->phone),
            'token'     => Str::uuid()->toString()
        ])->refresh();

        $sellerDTO->user = $user;

        return $next($sellerDTO);
    }
}
