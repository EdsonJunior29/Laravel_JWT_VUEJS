<?php

namespace App\Services;

use App\Repositories\Interfaces\MarcaInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class MarcaService
{
    protected $marcaInterface;

    public function __construct(MarcaInterface $marcaInterface)
    {
        $this->marcaInterface = $marcaInterface;
    }

    public function criaMarca(array $dados)
    {
        try {
           $marcaCriada =  $this->marcaInterface->create($dados);
        } catch (\Throwable $th) {
            Log::error('Erro ao criar marca: ' . $th->getMessage());
            throw new Exception($th->getMessage(), $th->getCode());
        }
        return $marcaCriada;
    }
}