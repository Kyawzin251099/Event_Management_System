<?php

namespace App\Contracts;

interface StreetInterface
{
    /* Contracts or Interface is some kind of restricting standard format */
    /* This is called magic signature */

    public function all();
    public function findByID(string $modelName, int $id);
    public function store(string $modelName, array $data);
    public function update(string $modelName, array $data, int $id);
    public function delete(string $modelName, int $id);
}
