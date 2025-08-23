<?php

namespace BookRegistry\Assunto\Http\Controller;

use App\Http\Controllers\Controller;
use BookRegistry\Assunto\Application\Service\CreateAssuntoService;
use BookRegistry\Assunto\Domain\Model\Assunto;
use BookRegistry\Assunto\Http\Request\AssuntoRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AssuntoController extends Controller
{
    /**
     * @param AssuntoService $assuntoService
     */
    public function __construct(
        private readonly CreateAssuntoService $assuntoService
    ) {
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
            app()->make(CreateAssuntoService::class)($assuntoDto);
            DB::commit();
        } catch (\DomainException $e) {
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
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('assuntos.create')
                ->with('error', 'Erro ao criar assunto')
                ->withInput();
        }

        return redirect()->route('assuntos.index')->with('success', 'Assunto criado com sucesso');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $assuntos = Assunto::orderBy('codAs', 'desc')->paginate(10);

        return view('assunto.index', compact('assuntos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('assunto.create');
    }
}
