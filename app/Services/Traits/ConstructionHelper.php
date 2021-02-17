<?php

declare(strict_types=1);

namespace App\Services\Traits;

/**
 * Trait ConstructionHelper
 * @package App\Services\Traits
 */
trait ConstructionHelper
{
    /**
     * @param string $phone
     * @return string
     */
    public function getNormalPhone(string $phone): string
    {
        return preg_replace( '/[^0-9]/', '', $phone);
    }
}
