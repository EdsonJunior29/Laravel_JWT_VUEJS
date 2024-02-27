<?php

namespace App\Services;

use App\Repositories\MarcaRepository;
use Exception;

class MarcaService
{
    protected $marcaRepository;

    public function __construct(MarcaRepository $marcaRepository)
    {
        $this->marcaRepository = $marcaRepository;
    }

    public function criaMarca(array $dados)
    {
        try {
           $marcaCriada =  $this->marcaRepository->createMarca($dados);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode());
        }
        return $marcaCriada;
    }
}