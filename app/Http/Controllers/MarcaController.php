<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Services\MarcaService;
use Exception;

class MarcaController extends Controller
{
    protected $marcaService;

    public function __construct(MarcaService $marcaService)
    {
        $this->marcaService = $marcaService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $marcas = $this->marcaService->buscarTodasAsMarcas();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
        return response()->json( $marcas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMarcaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarcaRequest $request)
    {
        try {
            $marca = $this->marcaService->criaMarca($request->validated());
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $marcaDados = $this->marcaService->buscarMarcaPorId($id);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
       
        return response()->json($marcaDados, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMarcaRequest  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarcaRequest $request, int $id)
    {
       try {
            $this->marcaService->atualizaMarca($request->validated(), $id);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
        return response()->json('update successfully', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        //
    }
}
