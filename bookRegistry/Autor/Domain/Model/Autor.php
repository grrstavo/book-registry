<?php

namespace BookRegistry\Autor\Domain\Model;

use BookRegistry\Livro\Domain\Model\Livro;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Autor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Autor';

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
    protected $primaryKey = 'CodAu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'Nome',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return AutorFactory
     */
    protected static function newFactory(): AutorFactory
    {
        return AutorFactory::new();
    }

    /**
     * Get the books associated with this author.
     *
     * This method defines a many-to-many relationship between authors and books
     * through the 'Livro_Autor' pivot table.
     *
     * @return BelongsToMany<Livro>
     */
    public function livros(): BelongsToMany
    {
        return $this->belongsToMany(Livro::class, 'Livro_Autor', 'Autor_CodAu', 'Livro_Codl');
    }
}
