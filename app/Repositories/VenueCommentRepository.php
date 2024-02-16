<?php

namespace App\Repositories;

use App\Contracts\VenueCommentInterface;
use App\Db\Core\Crud;
use App\Models\VenueComment;

class VenueCommentRepository implements VenueCommentInterface
{
    public function all()
    {
        return VenueComment::with('venue')->paginate(5);
    }

    public function findByID(string $modelName, int $id)
    {
        $model = app("App\Models\\{$modelName}");
        return $model::find($id);
    }

    public function store(string $modelName, array $data)
    {
        return (new Crud(new VenueComment(), $data, null, false, false))->execute();
    }

    public function update($modelName, array $data, int $id)
    {
        return (new Crud(new VenueComment(), $data, $id, true, false))->execute();
    }

    public function delete(string $modelName, int $id)
    {
        return (new Crud(new VenueComment(), null, $id, false, true))->execute();
    }
}
