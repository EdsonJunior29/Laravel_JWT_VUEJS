<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function create(array $dados): Model;
}