<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function create(array $dados): Model;

    public function getAll();

    public function getById(Model $model);
}