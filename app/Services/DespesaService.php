<?php

namespace App\Services;

use App\Http\Requests\StoreDespesaRequest;
use App\Http\Requests\UpdateDespesaRequest;
use App\Notifications\DespesaCadastrada;
use App\Repositories\DespesaRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class DespesaService {

    use AuthorizesRequests;

    public $despesaRepository;

    public function __construct(DespesaRepository $despesaRepository) {
        $this->despesaRepository = $despesaRepository;
    }

    public function getDespesas() {
        
        return $this->despesaRepository->getDespesas();
    }
    public function storeDespesa(StoreDespesaRequest $request) {
        $user = Auth::user();
        $payload = $request->validated();
        $payload['id_usuario'] = $user->id;

        if ( $payload['data_despesa'] > Carbon::now()->format('Y-m-d') ) {
            return ['msg' => 'Não é possivel registrar uma despesa futura', 'statusCode' => 400];
        }
        $despesa = $this->despesaRepository->storeDespesa($payload);

        Notification::send($user,new DespesaCadastrada($despesa));

        return $despesa;
    }

    public function show(int $id) {
        
        $despesa = $this->despesaRepository->find($id);

        if ( !$despesa ) {
            return ['msg'=> 'Despesa não encontrada, verifique se a informação está correta', 'statusCode' => 404];
        }

        $this->authorize('get', $despesa);
        return $despesa;
    }

    public function update(UpdateDespesaRequest $request, $id) {
        $payload = $request->validated();

        $despesa = $this->despesaRepository->find($id);

        if ( !$despesa ) {
            return ['msg'=> 'Despesa não encontrada, verifique se a informação está correta', 'statusCode' => 404];
        }

        $this->authorize('update', $despesa);

        return $this->despesaRepository->update($despesa,$payload);

    }

    public function destroy($id) {
        $despesa = $this->despesaRepository->find($id);

        if ( !$despesa ) {
            return ['msg'=> 'Despesa não encontrada, verifique se a informação está correta', 'statusCode' => 404];
        }
        $this->authorize('delete', $despesa);

        return $this->despesaRepository->destroy($despesa);
    }
}