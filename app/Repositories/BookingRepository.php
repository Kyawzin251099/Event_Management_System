<?php

namespace App\Repositories;

use App\Contracts\BookingInterface;
use App\Db\Core\Crud;
use App\Models\Booking;
use App\Models\Venue;
use Illuminate\Support\Facades\Config;

class BookingRepository implements BookingInterface
{
    public function findByID(string $modelName, int $id)
    {
        $model = app("App\\Models\\{$modelName}");
        return $model::find($id);
    }

    public function store(string $modelName, array $data)
    {
        $model = app("App\\Models\\{$modelName}");
        return (new Crud($model, $data, null, false, false))->execute();
    }

    public function update(string $modelName, array $data, int $id)
    {
        return (new Crud(new Booking(), $data, $id, true, false))->execute();
    }

    public function delete(string $modelName, int $id)
    {
        return (new Crud(new Booking(), null, $id, false, true))->execute();
    }
}
