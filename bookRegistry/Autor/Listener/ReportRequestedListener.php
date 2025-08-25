<?php

namespace BookRegistry\Autor\Listener;

use BookRegistry\Autor\Application\Service\CreateAutorReportService;
use BookRegistry\Autor\Event\ReportRequested;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ReportRequestedListener implements ShouldQueue
{
    /**
     * Create a new instance of the listener.
     *
     * @param CreateAutorReportService $service
     */
    public function __construct(
        private CreateAutorReportService $service
    ) {
    }

    /**
     * Handle the event.
     *
     * @param ReportRequested $event
     */
    public function handle(object $event): void
    {
        try {
            ($this->service)();
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function subscribe(): array
    {
        return [
            ReportRequested::class => 'handle',
        ];
    }
}
