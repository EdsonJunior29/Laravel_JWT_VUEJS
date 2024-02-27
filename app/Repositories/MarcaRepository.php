<?php

namespace App\Repositories;

use App\Models\Marca;

class MarcaRepository
{
    public function createMarca(array $dados): Marca
    {
        return Marca::create($dados);
    }
}