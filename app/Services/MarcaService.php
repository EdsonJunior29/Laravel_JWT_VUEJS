<?php

namespace App\Services;

use App\Models\Marca;
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


    public function buscarTodasAsMarcas()
    {
        try {
            $marcas =  $this->marcaInterface->getAll();
         } catch (\Throwable $th) {
             Log::error('Erro ao criar marca: ' . $th->getMessage());
             throw new Exception($th->getMessage(), $th->getCode());
         }
         return $marcas;
    }

    public function buscarMarcaPorId(Marca $marca)
    {
        try {
            return $this->marcaInterface->getById($marca);
         } catch (\Throwable $th) {
            Log::error('Erro ao criar marca: ' . $th->getMessage());
            throw new Exception($th->getMessage(), $th->getCode());
         }
        
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