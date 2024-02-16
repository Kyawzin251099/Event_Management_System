<?php

namespace App\Repositories;

use App\Contracts\AdHocInterface;
use App\Db\Core\Crud;
use App\Models\AdHoc;

class AdHocRepository implements AdHocInterface
{
    public function all()
    {
        return AdHoc::paginate(5);
    }

    public function findByID(string $modelName, int $id)
    {
        $model = app("App\Models\\{$modelName}");
        return $model::find($id);
    }

    public function store(string $modelName, array $data)
    {
        return (new Crud(new AdHoc(), $data, null, false, false))->execute();
    }

    public function update($modelName, array $data, int $id)
    {
        return (new Crud(new AdHoc(), $data, $id, true, false))->execute();
    }

    public function delete(string $modelName, int $id)
    {
        return (new Crud(new AdHoc(), null, $id, false, true))->execute();
    }
}
