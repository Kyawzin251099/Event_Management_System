<?php

namespace App\DB\Core;

use Carbon\Carbon;

class DateTimeField extends Field
{
  public function execute()
  {
    if (!$this->value) {
      return response()->json([
        "message" => "No Data Found"
      ]);
    }
    return Carbon::parse($this->value)->toDateTimeString();
  }
}
