<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Afericao extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = 'afericoes';

    protected $fillable = [
        'user_id',
        'responsavel_id',
        'altura',
        'idade',
        'peso',
        'circunferencia_abdominal',
        'percentual_massa_muscular',
        'gordura_visceral',
        'percentual_gordura',
        'metabolismo',
        'idade_metabolica',
    ];

    protected $casts = [
        'peso' => 'double',
        'circunferencia_abdominal' => 'double',
        'percentual_massa_muscular' => 'double',
        'gordura_visceral' => 'double',
        'percentual_gordura' => 'double',
        'metabolismo' => 'integer',
        'idade_metabolica' => 'integer',
        'altura' => 'double',
        'idade' => 'integer',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function responsavel()
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }
}
