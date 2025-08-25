<?php

namespace BookRegistry\Livro\Http\Controller;

use App\Http\Controllers\Controller;
use BookRegistry\Assunto\Domain\Model\Assunto;
use BookRegistry\Autor\Domain\Model\Autor;
use BookRegistry\Livro\Application\Service\CreateLivroService;
use BookRegistry\Livro\Application\Service\DeleteLivroService;
use BookRegistry\Livro\Application\Service\UpdateLivroService;
use BookRegistry\Livro\Domain\Model\Livro;
use BookRegistry\Livro\Http\Request\LivroRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use DomainException;
use Exception;

class LivroController extends Controller
{
    /**
     * @param CreateLivroService $livroService
     * @param UpdateLivroService $updateService
     */
    public function __construct(
        private readonly CreateLivroService $createService,
        private readonly UpdateLivroService $updateService,
        private readonly DeleteLivroService $deleteService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $livros = Livro::orderBy('Codl', 'desc')->paginate(10);

        return view('livro.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $autores = Autor::all();
        $assuntos = Assunto::all();

        return view('livro.create', compact('autores', 'assuntos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function edit(int $id): View|RedirectResponse
    {
        if (!$livro = Livro::find($id)) {
            return redirect()->route('livros.index')->with('error', 'Livro não encontrado');
        }

        $autores = Autor::all();
        $assuntos = Assunto::all();

        return view('livro.edit', compact('livro', 'autores', 'assuntos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        if (!$livro = Livro::find($id)) {
            return redirect()->route('livros.index')->with('error', 'Livro não encontrado');
        }

        DB::beginTransaction();
        try {
            ($this->deleteService)($id);
            DB::commit();
        } catch (DomainException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('livros.index')->with('error', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('livros.index')->with('error', 'Erro no banco de dados ao excluir livro');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('livros.index')->with('error', 'Erro ao excluir livro');
        }

        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso');
    }

    /**
     * @param LivroRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LivroRequest $request): RedirectResponse
    {
        if (!$request->validated()) {
            return redirect()->route('livros.create')
                ->withErrors($request->errors())
                ->withInput();
        }

        $livroDto = $request->toDTO();

        DB::beginTransaction();
        try {
            ($this->createService)($livroDto);
            DB::commit();
        } catch (DomainException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('livros.create')
                ->with('error', $e->getMessage())
                ->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('livros.create')
                ->with('error', 'Erro no banco de dados ao criar livro')
                ->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('livros.create')
                ->with('error', 'Erro ao criar livro')
                ->withInput();
        }

        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso');
    }

    /**
     * @param LivroRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LivroRequest $request): RedirectResponse
    {
        if (!$request->validated()) {
            return redirect()->route('livros.edit', ['codl' => $request->route('codl')])
                ->withErrors($request->errors())
                ->withInput();
        }

        $livroDto = $request->toDTO();

        DB::beginTransaction();
        try {
            ($this->updateService)($livroDto);
            DB::commit();
        } catch (DomainException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('livros.edit', ['codl' => $request->route('codl')])
                ->with('error', $e->getMessage())
                ->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('livros.edit', ['codl' => $request->route('codl')])
                ->with('error', 'Erro no banco de dados ao editar livro')
                ->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('livros.edit', ['codl' => $request->route('codl')])
                ->with('error', 'Erro ao editar livro')
                ->withInput();
        }

        return redirect()->route('livros.index')->with('success', 'Livro editado com sucesso');
    }
}
