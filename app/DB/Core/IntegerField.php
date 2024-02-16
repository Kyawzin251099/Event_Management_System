<?php

namespace App\DB\Core;

class IntegerField extends Field
{
  public function execute()
  {
    if (!$this->value) {
      return response()->json([
        "message" => "No Data Found"
      ]);
    }
    return $this->value;
  }
}
