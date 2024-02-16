<?php

namespace App\Contracts;
interface StateInterface
{
    /* Contracts or Interface is some kind of restricting standard format */
    /* This is called magic signature */

    public function all();
    public function store(array $data);
    public function update(array $data, int $id);
    public function delete(int $id);
}
