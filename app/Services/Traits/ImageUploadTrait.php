<?php

declare(strict_types=1);

namespace App\Services\Traits;

use Illuminate\Http\UploadedFile;

/**
 * Trait ImageUploadTrait
 * @package App\Services\Traits
 */
trait ImageUploadTrait
{
    /**
     * @param UploadedFile $image
     * @return String
     */
    public function uploadImage(UploadedFile  $image): String
    {
        $fileName = time().'.'.$image->extension();
        $image->move(public_path('uploads'), $fileName);

        return $fileName;
    }
}
