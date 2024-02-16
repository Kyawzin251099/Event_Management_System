<?php

namespace App\Db\Core;

use App\Models\Image;
use Carbon\Carbon;
use illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class Crud
{
    public function __construct(
        private Model $model,
        private ?array $data,
        private ?int $id,
        private $editMode,
        private $deleteMode,
    ) {
        // dd($data);
        $this->model = $model;
        $this->data = $data;
        $this->id = $id;
        $this->editMode = $editMode;
        $this->deleteMode = $deleteMode;
        $this->tableName = $model->getTable();
    }

    private string $imageDirectory = 'images';
    private string $tableName = '';
    private ?Model $record = null;

    public function setImageDirectory(string $directoryPath, string $tablename)
    {
        $this->imageDirectory = $directoryPath;
        $this->tableName = $tablename;
    }

    public function getData(string $model, string $id)
    {
        $modelInstance = new $model;
        return $modelInstance->findOrFail($id);
    }


    public function execute(): mixed
    {
        //dd($this->data);
        try {
            if ($this->id != null) {
                if (get_class($this->model) == Config::get('variables.IMAGE_MODEL')) {
                    $this->record = $this->model->where('link_id', $this->id)->first();
                } else {
                    $this->record = $this->model->findOrFail($this->id);
                }
            }

            if ($this->deleteMode) {
                if (get_class($this->model) == Config::get('variables.IMAGE_MODEL')) {
                    if ($this->record) {
                        $old_image = $this->record->upload_url;
                        $this->deleteImage($old_image);
                    }
                }

                if (!$this->record->delete()) {
                    return response()->json(['error' => 'Updating error!'], Response::HTTP_NO_CONTENT);
                }
                return $this->record;
            }

            if ($this->data) { //link_id=>1, genre=>2, upload_url[]=> one.jpg
                foreach ($this->data as $column => $value) {

                    $savableField = $this->model->saveableFields()[$column];
                    // dd($savableField);

                    switch ($savableField) {
                        case 'datetime':
                            if (!empty($value)) {
                                $date_value = Carbon::parse($value)->toDateTimeString();
                                if ($this->editMode) {
                                    $this->record->{$column} = $date_value;
                                } else {
                                    $this->model->{$column} = $date_value;
                                }
                            }
                            break;
                        case 'image':
                            if ($this->model->getTable() === $this->tableName && !empty($value)) {
                                // dd($value);Carbon::now()->timestamp
                                $imageName = round(microtime(true) * 1000)  . '.' . $value->extension();
                                $finalImagePath = $this->imageDirectory . $imageName;
                                if ($this->editMode) {
                                    $old_image = $this->record->{$column};
                                    $this->deleteImage($old_image);
                                    $this->storeImage($value, $this->imageDirectory, $imageName);
                                    $this->record->{$column} = $finalImagePath;
                                } else {
                                    $this->storeImage($value, $this->imageDirectory, $imageName);
                                    $this->model->{$column} = $finalImagePath;
                                }
                            }
                            break;
                        default:
                            if ($this->editMode) {
                                $this->record->{$column} = $value;
                            } else {
                                $this->model->{$column} = $value;
                            }
                    }
                }
            }
            if ($this->editMode) {
                if (!$this->record->save()) {
                    return response()->json(null, Response::HTTP_NO_CONTENT);
                }
                return $this->record;
            }

            if (!$this->model->save()) {
                return response()->json(null, Response::HTTP_NO_CONTENT);
            }
            return $this->model;
        } catch (QueryException $e) {
            //abort(404);
            return response($e->getMessage());
        }
    }

    public function deleteImage($old_image)
    {
        Storage::delete($old_image);
    }

    public function storeImage($value, $imageDirectory, $imageName)
    {
        $value->storeAs($imageDirectory, $imageName);
    }
}
