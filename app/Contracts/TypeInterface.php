<?php

namespace App\Contracts;

interface TypeInterface
{
    public function all();
    public function store(array $data);
    public function findById(int $id);
    public function update(array $data, int $id);
    public function delete(int $id);
}
