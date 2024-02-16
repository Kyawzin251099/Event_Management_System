<?php

namespace App\Repositories;

use App\Contracts\StreetInterface;
use App\Db\Core\Crud;
use App\Models\Street;

class StreetRepository implements StreetInterface
{
    public function all()
    {
        return Street::paginate(5);
    }

    public function findByID(string $modelName, int $id)
    {
        $model = app("App\\Models\\{$modelName}");
        return $model::find($id);
    }

    public function store(string $modelName, array $data)
    {
        return (new Crud(new Street(), $data, null, false, false))->execute();
    }

    public function update(string $modelName, array $data, int $id)
    {
        return (new Crud(new Street(), $data, $id, true, false))->execute();
    }

    public function delete(string $modelName, int $id)
    {
        $model = app("App\\Models\\{$modelName}");
        return (new Crud($model, null, $id, false, true))->execute();
    }
}
