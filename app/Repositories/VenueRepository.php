<?php

namespace App\Repositories;

use App\Contracts\VenueInterface;
use App\Db\Core\Crud;
use App\Db\Core\OldCrud;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Venue;
use App\Models\VenueImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class VenueRepository implements VenueInterface
{
    public function all()
    {
        return Venue::paginate(5);
    }

    public function findByID(string $modelName, int $id): Model
    {
        $model = app("App\\Models\\{$modelName}");
        return $model::find($id);
    }

    public function venueDetails(string $modelName)
    {
        $model = app("App\\Models\\{$modelName}");
        return $model::with(['platformUser', 'venueImage', 'venueComment', 'booking.event.adHoc'])
            ->withAvg('venueRating', 'rating_id')->orderBy('venue_rating_avg_rating_id');
    }

    public function store(string $modelName, array $data)
    {
        $model = app("App\\Models\\{$modelName}");
        if (get_class($model) !== Config::get('variables.IMAGE_MODEL')) {
            return (new Crud($model, $data, null, false, false))->execute();
        }
        $crud = new Crud($model, $data, null, false, false);
        $crud->setImageDirectory('public/venue/', Config::get('variables.IMAGE'));
        return $crud->execute();
    }

    public function update(string $modelName, array $data, int $id)
    {
        $model = app("App\\Models\\{$modelName}");
        if (get_class($model) !== Config::get('variables.IMAGE_MODEL')) {
            return (new Crud($model, $data, $id, true, false))->execute();
        }
        $curd = new Crud($model, $data, $id, true, false);
        $curd->setImageDirectory('public/venue/', Config::get('variables.IMAGE'));
        return $curd->execute();
    }

    public function delete(string $modelName, int $id)
    {
        $model = app("App\\Models\\{$modelName}");
        return (new Crud($model, null, $id, false, true))->execute();
    }
}
