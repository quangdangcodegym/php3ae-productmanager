<?php

namespace App\Repositories;

interface IRepository
{
    public function getAll();

    public function findById($id);

    public function create($data);

    public function update($data, $object);

    public function destroy($object);
}
