<?php

namespace App\Repositories;

use App\Models\Despesa;
use Illuminate\Support\Facades\Auth;

class DespesaRepository
{
    public $model;

    public function __construct() {
        $this->model = new Despesa();
    }

    public function getDespesas() {
        return Auth::user()->despesas;
    }

    public function getDespesa($id) {
        return $this->model->find($id);
    }

    public function storeDespesa($payload) {
        return $this->model->create($payload);
    }

    public function find($id) {
        return $this->model->find($id);
    }

    public function update(Despesa $despesa,$payload) {
        $despesa->fill($payload);
        $despesa->save();

        return $despesa;
    }

    public function destroy(Despesa $despesa) {
        return $despesa->delete();
    }
}