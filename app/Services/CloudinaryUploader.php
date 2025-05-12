<?php

namespace App\Services;

use Cloudinary\Cloudinary;

class CloudinaryUploader
{
  protected $cloudinary;

  public function __construct(Cloudinary $cloudinary)
  {
    $this->cloudinary = $cloudinary;
  }

  public function upload($file, $folder = null)
  {
    $options = [
      'resource_type' => 'auto',
      'folder'        => $folder,
    ];

    $result = $this->cloudinary->uploadApi()->upload(
      $file->getRealPath(),
      $options
    );

    return $result;
  }
}
