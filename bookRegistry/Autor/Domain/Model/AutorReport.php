<?php

namespace BookRegistry\Autor\Domain\Model;

use Illuminate\Database\Eloquent\Model;

class AutorReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vw_relatorio_autor';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
