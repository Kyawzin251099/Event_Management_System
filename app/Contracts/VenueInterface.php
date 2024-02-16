<?php

namespace App\Contracts;

interface VenueInterface
{
    /* Contracts or Interface is some kind of restricting standard format */
    /* This is called magic signature */

    public function all();
    public function findByID(string $modelName, int $id);
    public function venueDetails(string $modelName);
    public function store(string $modleName, array $data);
    public function update(string $modleName, array $data, int $id);
    public function delete(string $modleName, int $id);
}
