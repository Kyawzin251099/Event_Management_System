<?php

namespace App\Repositories;

use App\Models\User;
use App\Db\Core\Crud;
use App\Models\State;
use App\Contracts\StateInterface;

class StateRepository implements StateInterface
{
    public function all()
    {
        return State::paginate(10);
    }

    public function store(array $data)
    {
        return (new Crud(new State(), $data, null, false, false))->execute();
    }

    public function update(array $data, int $id)
    {
        return (new Crud(new State(), $data, $id, true, false))->execute();
    }

    public function delete(int $id)
    {
        return (new Crud(new State(), null, $id, false, true))->execute();
    }

    // public function delete(int $id)
    // {
    //     return (new Crud(
    //         new User(),
    //         null,
    //         $id,
    //         false,
    //         false,
    //         false,
    //         true
    //     ))->execute();
    // }
}
