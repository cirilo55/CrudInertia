<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportadora extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'limite_creditos',
        'data_analise_credito'
    ];
}
