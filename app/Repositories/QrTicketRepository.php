<?php

namespace App\Repositories;


use App\Contracts\QrTicketInterface;
use App\Db\Core\Crud;
use App\Models\QrTicket;

class QrTicketRepository implements QrTicketInterface
{
    public function all()
    {
        return QrTicket::paginate(5);
    }
    public function findByID(string $modelName, int $id)
    {
        $model = app("App\\Models\\{$modelName}");
        return $model::find($id);
    }

    public function store(string $modelName, array $data)
    {
        return (new Crud(new QrTicket(), $data, null, false, false))->execute();

    }


    public function update(string $modelName, array $data, int $id)
    {
        return (new Crud(new QrTicket(), $data, $id, true, false))->execute();

    }

    public function delete(string $modelName, int $id)
    {
        return (new Crud(new QrTicket(), null, $id, false, true))->execute();

    }

    // public function deleteByAdHocId($adHocId)
    // {
    //     // Delete QrTickets associated with the given AdHoc ID
    //     QrTicket::where('ad_hoc_id', $adHocId)->delete();
    // }
}
