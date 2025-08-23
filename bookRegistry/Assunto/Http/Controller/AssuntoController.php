<?php

namespace BookRegistry\Assunto\Http\Controller;

use App\Http\Controllers\Controller;
use BookRegistry\Assunto\Application\Service\CreateAssuntoService;
use BookRegistry\Assunto\Application\Service\UpdateAssuntoService;
use BookRegistry\Assunto\Domain\Model\Assunto;
use BookRegistry\Assunto\Http\Request\AssuntoRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use \DomainException;
use \Exception;

class AssuntoController extends Controller
{
    /**
     * @param CreateAssuntoService $assuntoService
     * @param UpdateAssuntoService $updateService
     */
    public function __construct(
        private readonly CreateAssuntoService $createService,
        private readonly UpdateAssuntoService $updateService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $assuntos = Assunto::orderBy('codAs', 'desc')->paginate(10);

        return view('assunto.index', compact('assuntos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('assunto.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function edit(int $id): View|RedirectResponse
    {
        if (!$assunto = Assunto::find($id)) {
            return redirect()->route('assuntos.index')->with('error', 'Assunto não encontrado');
        }

        return view('assunto.edit', compact('assunto'));
    }

    /**
     * @param AssuntoRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AssuntoRequest $request): RedirectResponse
    {
        if (!$request->validated()) {
            return redirect()->route('assuntos.create')
                ->withErrors($request->errors())
                ->withInput();
        }

        $assuntoDto = $request->toDTO();

        DB::beginTransaction();
        try {
            ($this->createService)($assuntoDto);
            DB::commit();
        } catch (DomainException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('assuntos.create')
                ->with('error', $e->getMessage())
                ->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('assuntos.create')
                ->with('error', 'Erro no banco de dadods ao criar assunto')
                ->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('assuntos.create')
                ->with('error', 'Erro ao criar assunto')
                ->withInput();
        }

        return redirect()->route('assuntos.index')->with('success', 'Assunto criado com sucesso');
    }

    /**
     * @param AssuntoRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AssuntoRequest $request): RedirectResponse
    {
        if (!$request->validated()) {
            return redirect()->route('assuntos.edit', ['codAs' => $request->route('codAs')])
                ->withErrors($request->errors())
                ->withInput();
        }

        $assuntoDto = $request->toDTO();

        DB::beginTransaction();
        try {
            ($this->updateService)($assuntoDto);
            DB::commit();
        } catch (DomainException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('assuntos.edit', ['codAs' => $request->route('codAs')])
                ->with('error', $e->getMessage())
                ->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('assuntos.edit', ['codAs' => $request->route('codAs')])
                ->with('error', 'Erro no banco de dadods ao editar assunto')
                ->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('assuntos.edit', ['codAs' => $request->route('codAs')])
                ->with('error', 'Erro ao editar assunto')
                ->withInput();
        }

        return redirect()->route('assuntos.index')->with('success', 'Assunto editado com sucesso');
    }
}
