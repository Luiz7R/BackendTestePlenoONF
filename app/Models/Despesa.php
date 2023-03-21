<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Despesa extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'descricao',
        'id_usuario',
        'data_despesa',
        'valor',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDataDespesaAttribute()
    {
        return formatarData($this->attributes['data_despesa']);
    }

    public function getValorAttribute()
    {
        return formatarValor($this->attributes['valor']);
    }
}
