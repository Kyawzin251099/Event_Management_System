<?php

namespace App\Repositories;

use App\Contracts\CityInterface;
use App\Db\Core\Crud;
use App\Models\City;

class CityRepository implements CityInterface
{
    public function all()
    {
        return City::paginate(5);
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
        $model = app("App\\Models\\{$modelName}");
        return (new Crud($model, $data, $id, true, false))->execute();
    }

    public function delete(string $modelName, int $id)
    {
        $model = app("App\\Models\\{$modelName}");
        return (new Crud($model, null, $id, false, true))->execute();
    }
}
