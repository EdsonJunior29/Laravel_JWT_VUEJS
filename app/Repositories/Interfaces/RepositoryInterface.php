<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function create(array $dados): Model;

    public function getAll();

    public function getById(int $modelId);

    public function updateById(array $dados, int $modelId);

    public function deleteById(int $modelId);
}