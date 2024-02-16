<?php

namespace App\DB\Core;

use App\Db\Core\Crud;
use Illuminate\Support\Facades\Config;

class ImageField extends Field
{
  public $tableName, $imageDirectory;

  public function __construct()
  {
    $this->tableName = Crud::$tableName;
    $this->imageDirectory = Crud::$imageDirectory;
  }

  public function execute()
  {
    if (!$this->value) {
      return response()->json([
        "message" => "No Data Found"
      ]);
    }

    if ($this->tableName === Config::get('variables.IMAGE')) {
      $uploadedFile = $this->value;
      $imageName = round(microtime(true) * 1000)  . '.' . $uploadedFile->extension();
      $finalImagePath = $this->imageDirectory . $imageName;
      Crud::storeImage($uploadedFile, $this->imageDirectory, $imageName);
      return $this->value = $finalImagePath;
    }
  }
}
