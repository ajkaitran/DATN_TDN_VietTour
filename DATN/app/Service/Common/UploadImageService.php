<?php

namespace App\Service\Common;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadImageService
{
  public function upload($image, string $nameTable): string
  {
    try {
      $image = str_replace('data:image/png;base64,', '', $image);
      $image = str_replace(' ', '+', $image);
      $image = base64_decode($image);
      $imageName = uniqid() . '.png';
      Storage::disk('public')->put($nameTable . '/' . $imageName, $image);
      return $nameTable . '/' . $imageName;
    } catch (\Exception $e) {
      Log::error($e);
      throw $e;
    }
  }
}
