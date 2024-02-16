<?php

namespace App\Repositories;

use App\Contracts\TypeInterface;
use App\Db\Core\Crud;
use App\Models\Type;

class TypeRepository implements TypeInterface
{
    public function all()
    {
        return Type::paginate(5);
    }

    public function store(array $data)
    {
        return (new Crud(new Type(), $data, null, false, false))->execute();
    }

    public function findById(int $id)
    {
        return (new Crud(new Type(),null,$id,false,false))->execute();
    }

    public function update(array $data, int $id,)
    {
        return (new Crud(new Type(), $data, $id, true, false))->execute();
    }

    public function delete(int $id)
    {
        return (new Crud(new Type(), null, $id, false, true))->execute();
    }
}
