<?php

namespace App\Repositories;

use App\Contracts\PlatformUserInterface;
use App\Db\Core\Crud;
use App\Models\PlatformUser;
use Illuminate\Support\Facades\Config;

class PlatformUserRepository implements PlatformUserInterface
{
  public function all()
  {
    return PlatformUser::paginate(5);
  }

  public function findByID(string $modelName, int $id)
  {
    $model = app("App\\Models\\{$modelName}");
    return $model::find($id);
  }

  public function store(string $modelName, array $data)
  {
    $model = app("App\\Models\\{$modelName}");
    if (get_class($model) !== Config::get('variables.IMAGE_MODEL')) {
      return (new Crud($model, $data, null, false, false))->execute();
    }
    $crud = new Crud($model, $data, null, false, false);
    $crud->setImageDirectory('public/profile/', Config::get('variables.IMAGE'));
    return $crud->execute();
  }

  public function update(string $modelName, array $data, int $id)
  {
    $model = app("App\\Models\\{$modelName}");
    if (get_class($model) !== Config::get('variables.IMAGE_MODEL')) {
      return (new Crud($model, $data, $id, true, false))->execute();
    }
    $crud = new Crud($model, $data, $id, true, false);
    $crud->setImageDirectory('public/profile/', Config::get('variables.IMAGE'));
    return $crud->execute();
  }

  public function delete(string $modelName, int $id)
  {
    $model = app("App\\Models\\{$modelName}");
    return (new Crud($model, null, $id, false, true))->execute();
  }
}
