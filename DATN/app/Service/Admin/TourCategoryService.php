<?php

namespace App\Service\Admin;

use App\Models\ProductCategory;
use App\Service\Common\ImageService;

class TourCategoryService
{
  public function __construct(private ImageService $imageService) {}

  public function store(array $data): ProductCategory
  {
    $active = isset($data['active']) ? 1 : 0;
    $hot = isset($data['hot']) ? 1 : 0;
    $homePage = isset($data['home_page']) ? 1 : 0;
    if ($data['image']) {
      $imageName = $this->imageService->uploadImage($data['image'], 'categoryTour');
    }

    return ProductCategory::create([
      ...$data,
      'image' => $imageName ?? null,
      'active' => $active,
      'hot' => $hot,
      'home_page' => $homePage
    ]);
  }

  public function update(int $id, array $data): bool
  {
    $category = ProductCategory::find($id);
    $active = isset($data['active']) ? 1 : 0;
    $hot = isset($data['hot']) ? 1 : 0;
    $homePage = isset($data['home_page']) ? 1 : 0;

    if ($data['image']) {
      $imageName = $this->imageService->uploadImage($data['image'], 'categoryTour');
      $this->imageService->deleteImage($category->image, 'categoryTour');
    }

    return $category->update([
      ...$data,
      'image' => $imageName ?? $category->image,
      'active' => $active,
      'hot' => $hot,
      'home_page' => $homePage
    ]);
  }

  public function destroy(int $id): bool
  {
    $category = ProductCategory::find($id);
    $this->imageService->deleteImage($category->image, 'categoryTour');
    return $category->delete();
  }
}
