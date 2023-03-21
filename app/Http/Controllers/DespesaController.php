<?php

namespace App\Http\Controllers;

use App\Http\Resources\DespesaResource;
use App\Http\Requests\StoreDespesaRequest;
use App\Http\Requests\UpdateDespesaRequest;
use App\Services\DespesaService;

class DespesaController extends Controller
{

    public $despesaService;

    public function __construct(DespesaService $despesaService) {
        $this->despesaService = $despesaService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(DespesaResource::collection($this->despesaService->getDespesas()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDespesaRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreDespesaRequest $request)
    {
        $despesa = $this->despesaService->storeDespesa($request);

        if ( !empty($despesa['statusCode']) ) {
            return errorResponse($despesa['msg'], $despesa['statusCode']);
        }

        return response()->json(new DespesaResource($despesa), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $despesa = $this->despesaService->show($id);

        if ( !empty($despesa['statusCode']) ) {
            return errorResponse($despesa['msg'], $despesa['statusCode']);
        }

        return response()->json(new DespesaResource($despesa), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDespesaRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateDespesaRequest $request, $id)
    {
        $despesa = $this->despesaService->update($request,$id);

        if ( !empty($despesa['statusCode']) ) {
            return errorResponse($despesa['msg'], $despesa['statusCode']);
        }

        return response()->json(new DespesaResource($despesa), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $despesa = $this->despesaService->destroy($id);

        if ( !empty($despesa['statusCode']) ) {
            return errorResponse($despesa['msg'], $despesa['statusCode']);
        }

        return response()->json('Despesa excluída com Sucesso!', 200);
    }
}
