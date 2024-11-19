<?php

namespace App\Service\Common;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
  public function uploadImage(?UploadedFile $image, string $nameTable): string
  {
    try {
      $imageName = time() . '.' . $image->getClientOriginalExtension();
      $path = $image->storeAs('public/' . $nameTable, $imageName);
      return $imageName;
    } catch (\Exception $e) {
      Log::error($e);
      throw $e;
    }
  }


  public function deleteImage(string $imageName, string $nameTable): void
  {
    try {
      Storage::delete(config('image.storage_path_' . $nameTable) . '/' . $imageName);
    } catch (\Exception $e) {
      Log::error($e);
      throw $e;
    }
  }
}
