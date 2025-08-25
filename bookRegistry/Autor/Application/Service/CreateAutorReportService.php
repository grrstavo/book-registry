<?php

namespace BookRegistry\Autor\Application\Service;

use BookRegistry\Autor\Domain\Model\AutorReport;
use Jimmyjs\ReportGenerator\ReportMedia\PdfReport;

class CreateAutorReportService
{
    /**
     * Handle the creation of a new Autor report.
     *
     * @return void
     */
    public function __invoke(): void
    {
        $reports = AutorReport::query();

        $columns = [
            'Id' => 'autor_id',
            'Nome' => 'autor_nome',
            'Total Assuntos' => 'total_assuntos',
            'Total Livros' => 'total_livros',
            'Total Valor' => 'total_valor',
            'Média Valor' => 'media_valor'
        ];

        $meta = [
            'Gerado em' => now()->format('d/m/Y H:i:s'),
        ];

        $report = new PdfReport();

        $report->of('Relatório de Autores', $meta, $reports, $columns)
            ->editColumn('Total Valor',
                [
                    'displayAs' => function ($result) {
                        return 'R$ ' . number_format($result->total_valor / 100, 2, ',', '.');
                    },
                    'class' => 'wider-100'
                ]
            )
            ->editColumn('Média Valor',
                [
                    'displayAs' => function ($result) {
                        return 'R$ ' . number_format($result->media_valor / 100, 2, ',', '.');
                    },
                    'class' => 'wider-100'
                ]
            )
            ->store('reports/autor_report.pdf');
    }
}
