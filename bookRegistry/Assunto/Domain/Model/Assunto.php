<?php

namespace BookRegistry\Assunto\Domain\Model;

use BookRegistry\Livro\Domain\Model\Livro;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Assunto extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Assunto';

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
    protected $primaryKey = 'codAs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'Descricao',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return AssuntoFactory
     */
    protected static function newFactory(): AssuntoFactory
    {
        return AssuntoFactory::new();
    }

    /**
     * Get the books associated with this subject.
     *
     * This method defines a many-to-many relationship between subjects and books
     * through the 'Livro_Assunto' pivot table.
     *
     * @return BelongsToMany<Livro>
     */
    public function livros(): BelongsToMany
    {
        return $this->belongsToMany(Livro::class, 'Livro_Assunto', 'Assunto_codAs', 'Livro_Codl');
    }
}
