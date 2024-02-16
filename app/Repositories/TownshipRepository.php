<?php

namespace App\Repositories;

use App\Contracts\TownshipInterface;
use App\Db\Core\Crud;
use App\Models\Township;

class TownshipRepository implements TownshipInterface
{
    public function all()
    {
        return Township::paginate(5);
    }
    public function findByID(string $modelName, int $id)
    {
        $model = app("App\\Models\\{$modelName}");
        return $model::find($id);
    }

    public function store(string $modelName, array $data)
    {
        return (new Crud(new Township(), $data, null, false, false))->execute();
    }


    public function update(string $modelName, array $data, int $id)
    {
        return (new Crud(new Township(), $data, $id, true, false))->execute();
    }

    public function delete(string $modelName, int $id)
    {
        return (new Crud(new Township(), null, $id, false, true))->execute();
    }
}
