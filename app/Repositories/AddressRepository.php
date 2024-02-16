<?php

namespace App\Repositories;

use App\Contracts\AddressInterface;
use App\Db\Core\Crud;
use App\Models\Address;

class AddressRepository implements AddressInterface
{
    public function all()
    {
        return Address::paginate(5);
    }

    public function findByID(string $modelName, int $id)
    {
        $model = app("App\\Models\\{$modelName}");
        return $model::find($id);
    }

    public function store(string $modelName, array $data)
    {
        return (new Crud(new Address(), $data, null, false, false))->execute();
    }

    public function update(string $modelName, array $data, int $id)
    {
        return (new Crud(new Address(), $data, $id, true, false))->execute();
    }

    public function delete(string $modelName, int $id)
    {
        return (new Crud(new Address(), null, $id, false, true))->execute();
    }
}
