<?php

namespace App\Repositories;

use App\Models\User;
use App\Db\Core\Crud;
use App\Models\Event;
use App\Contracts\EventInterface;
use Illuminate\Support\Facades\Config;

class EventRepository implements EventInterface
{
    public function all()
    {
        return Event::paginate(10);
    }

    public function findByID(string $modelName, int $id)
    {
        $model = app("App\Models\\{$modelName}");
        return $model::find($id);
    }

    public function store(string $modelName, array $data)
    {
        $model = app("App\Models\\{$modelName}");
        if (get_class($model) !== Config::get('variables.IMAGE_MODEL')) {
            return (new Crud($model, $data, null, false, false))->execute();
        }
        $crud = new Crud($model, $data, null, false, false);
        $crud->setImageDirectory('public/event/', Config::get('variables.IMAGE'));
        return $crud->execute();
    }

    public function update($modelName, array $data, int $id)
    {
        return (new Crud(new Event(), $data, $id, true, false))->execute();
    }

    public function delete(string $modelName, int $id)
    {
        $model = app("App\Models\\{$modelName}");
        return (new Crud($model, null, $id, false, true))->execute();
    }
}
