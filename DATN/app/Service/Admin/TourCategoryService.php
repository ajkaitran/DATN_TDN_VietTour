<?php

namespace App\Service\Admin;

use App\Models\ProductCategory;
use App\Service\Common\UploadImageService;

class TourCategoryService
{
  public function __construct(private UploadImageService $uploadImageService) {}

  public function store(array $data): ProductCategory
  {
    $data['active'] = $data['active'] ? 1 : 0;
    $data['hot'] = $data['hot'] ? 1 : 0;
    if ($data['image']) {
      $data['image'] = $this->uploadImageService->upload($data['image'], 'images/tourCategory');
    }

    return ProductCategory::create($data);
  }
}
