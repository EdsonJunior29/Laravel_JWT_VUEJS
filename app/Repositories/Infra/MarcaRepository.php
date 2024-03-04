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

    public function getById(int $id)
    {
        return $this->marca->find($id);
    }

    public function create(array $dados): Marca
    {
        return $this->marca->create($dados);
    }

    public function updateById(array $dados, int $marcaId)
    {
        $marca = $this->getById($marcaId);

        $marca->nome = $dados['nome'];
        $marca->imagem = $dados['imagem'];
        
        $marca->update();
    }

    public function deleteById(int $modelId)
    {
        $marca = $this->getById($modelId);

        $marca->delete();
    }
}