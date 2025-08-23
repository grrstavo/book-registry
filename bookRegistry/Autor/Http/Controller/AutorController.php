<?php

namespace BookRegistry\Autor\Http\Controller;

use App\Http\Controllers\Controller;
use BookRegistry\Autor\Application\Service\CreateAutorService;
use BookRegistry\Autor\Application\Service\UpdateAutorService;
use BookRegistry\Autor\Domain\Model\Autor;
use BookRegistry\Autor\Http\Request\AutorRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use \DomainException;
use \Exception;

class AutorController extends Controller
{
    /**
     * @param CreateAutorService $autorService
     * @param UpdateAutorService $updateService
     */
    public function __construct(
        private readonly CreateAutorService $createService,
        private readonly UpdateAutorService $updateService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $autores = Autor::orderBy('CodAu', 'desc')->paginate(10);

        return view('autor.index', compact('autores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('autor.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function edit(int $id): View|RedirectResponse
    {
        if (!$autor = Autor::find($id)) {
            return redirect()->route('autores.index')->with('error', 'Autor não encontrado');
        }

        return view('autor.edit', compact('autor'));
    }

    /**
     * @param AutorRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AutorRequest $request): RedirectResponse
    {
        if (!$request->validated()) {
            return redirect()->route('autores.create')
                ->withErrors($request->errors())
                ->withInput();
        }

        $autorDto = $request->toDTO();

        DB::beginTransaction();
        try {
            ($this->createService)($autorDto);
            DB::commit();
        } catch (DomainException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('autores.create')
                ->with('error', $e->getMessage())
                ->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('autores.create')
                ->with('error', 'Erro no banco de dadods ao criar autor')
                ->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('autores.create')
                ->with('error', 'Erro ao criar autor')
                ->withInput();
        }

        return redirect()->route('autores.index')->with('success', 'Autor criado com sucesso');
    }

    /**
     * @param AutorRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AutorRequest $request): RedirectResponse
    {
        if (!$request->validated()) {
            return redirect()->route('autores.edit', ['CodAu' => $request->route('CodAu')])
                ->withErrors($request->errors())
                ->withInput();
        }

        $autorDto = $request->toDTO();

        DB::beginTransaction();
        try {
            ($this->updateService)($autorDto);
            DB::commit();
        } catch (DomainException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('autores.edit', ['CodAu' => $request->route('CodAu')])
                ->with('error', $e->getMessage())
                ->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('autores.edit', ['CodAu' => $request->route('CodAu')])
                ->with('error', 'Erro no banco de dadods ao editar autor')
                ->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('autores.edit', ['CodAu' => $request->route('CodAu')])
                ->with('error', 'Erro ao editar autor')
                ->withInput();
        }

        return redirect()->route('autores.index')->with('success', 'Autor editado com sucesso');
    }
}
