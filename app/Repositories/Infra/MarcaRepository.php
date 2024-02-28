<?php

namespace App\Repositories\Infra;

use App\Models\Marca;
use App\Repositories\Interfaces\MarcaInterface;

class MarcaRepository implements MarcaInterface
{
    protected $marca;

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }

    public function getAll()
    {
        return $this->marca->all();
    }

    public function getById($marca)
    {
        return $marca;
    }

    public function create(array $dados): Marca
    {
        return $this->marca->create($dados);
    }
}