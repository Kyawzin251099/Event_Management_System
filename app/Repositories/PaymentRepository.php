<?php

namespace App\Repositories;

use App\Contracts\PaymentInterface;
use App\Db\Core\Crud;
use App\Models\Venue;
use App\Models\Ward;

class PaymentRepository implements PaymentInterface
{
    public function all()
    {
        return Ward::paginate(5);
    }

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
        return (new Crud(new Ward(), $data, $id, true, false))->execute();
    }

    public function delete(string $modelName, int $id)
    {
        return (new Crud(new Ward(), null, $id, false, true))->execute();
    }
}
