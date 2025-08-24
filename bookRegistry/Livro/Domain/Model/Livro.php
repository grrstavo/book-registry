<?php

namespace BookRegistry\Livro\Domain\Model;

use BookRegistry\Assunto\Domain\Model\Assunto;
use BookRegistry\Autor\Domain\Model\Autor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Livro extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Livro';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'Codl';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'Titulo',
        'Editora',
        'Edicao',
        'AnoPublicacao',
        'Valor'
    ];

    /**
     * Get the value of the book as a float.
     *
     * @return float
     */
    public function getValorToFloat(): float
    {
        return $this->Valor / 100;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return LivroFactory
     */
    protected static function newFactory(): LivroFactory
    {
        return LivroFactory::new();
    }

    /**
     * Get the subjects associated with this book.
     *
     * This method defines a many-to-many relationship between books and subjects
     * through the 'Livro_Assunto' pivot table.
     *
     * @return BelongsToMany<Assunto>
     */
    public function assuntos(): BelongsToMany
    {
        return $this->belongsToMany(Assunto::class, 'Livro_Assunto', 'Livro_Codl', 'Assunto_codAs');
    }

    /**
     * Get the authors associated with this book.
     *
     * This method defines a many-to-many relationship between books and authors
     * through the 'Livro_Livro' pivot table.
     *
     * @return BelongsToMany<Livro>
     */
    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'Livro_Autor', 'Livro_Codl', 'Autor_CodAu');
    }
}
