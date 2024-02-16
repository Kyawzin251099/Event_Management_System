<?php

namespace App\DB\Core;

class StringField extends Field
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
