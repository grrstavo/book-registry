<?php

namespace BookRegistry\Assunto\Http\Controller;

use App\Http\Controllers\Controller;
use BookRegistry\Assunto\Application\Service\CreateAssuntoService;
use BookRegistry\Assunto\Http\Request\AssuntoRequest;
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
     */
    public function store(AssuntoRequest $request)
    {
        if (!$request->validated()) {
            return redirect()->route('assunto.create')
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

            return redirect()->route('assunto.create')
                ->with('error', $e->getMessage())
                ->withInput();
        } catch (\Illuminate\Database\QueryException $qe) {
            DB::rollBack();
            Log::error($qe->getMessage(), $qe->getTrace());

            return redirect()->route('assunto.create')
                ->with('error', 'Erro inesperado no banco de dadods ao criar assunto')
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route('assunto.create')
                ->with('error', 'Erro inesperado ao criar assunto')
                ->withInput();
        }

        return redirect()->route('assunto.index')->with('success', 'Assunto criado com sucesso');
    }
}
