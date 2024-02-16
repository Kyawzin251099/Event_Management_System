<?php

namespace App\Traits;

trait HelperTrait
{
  public function hasChanges($newData, $existingData, $fields)
  {
    //$carry = false, false || true = true
    return array_reduce($fields, function ($carry, $field) use ($newData, $existingData) {
      return $carry || ($newData[$field] != $existingData[$field]);
    }, false);
  }
}
