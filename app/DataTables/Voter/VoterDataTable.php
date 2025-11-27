<?php

namespace App\DataTables\Voter;

use App\Models\Voter;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VoterDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Voter> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $buttons = [
            'show' => [
                'class' => 'show-record',
                'icon' => 'info-circle',
                'target' => '#show-record',
                'color' => 'primary-600',
            ],
            'edit' => [
                'class' => 'edit-record',
                'icon' => 'edit',
                'target' => '#edit-record',
                'color' => 'primary-600',
            ],
            'send-notification' => [
                'class' => 'send-notification-btn',
                'icon' => 'envelope',
                'target' => null,
                'color' => 'green-600',
            ],
            'delete' => [
                'class' => 'delete-record',
                'icon' => 'trash',
                'target' => null,
                'color' => 'red-600',
            ],
        ];

        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) use ($buttons) {
                $actions = '';

                foreach ($buttons as $btn) {
                    $actions .= sprintf(
                        '<button class="inline-flex items-center justify-center w-7 h-7 bg-%s hover:bg-%s text-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 %s me-1 cursor-pointer" data-id="%s" data-target="%s">
                            <box-icon name="%s" color="#ffffff"></box-icon>
                        </a>',
                        $btn['color'],
                        str_replace('600', '700', $btn['color']),
                        $btn['class'],
                        $query->id,
                        str_replace(':id', $query->id, $btn['target'] ?? ''),
                        $btn['icon']
                    );
                }

                return $actions ?: '-';
            })
            ->addColumn('voted_at_display', function ($query) {
                return $query->has_voted ? $query->voted_at->format('Y-m-d H:i:s') : 'Belum Memilih';
            })
            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Voter>
     */
    public function query(Voter $model): QueryBuilder
    {
        return $model->query()->select('voters.*')
            ->with('batch:id,name');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('voter-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->lengthChange(true)
            ->pageLength(10)
            ->autoWidth(false)
            ->responsive(true)
            ->selectStyleSingle()
            ->layout([
                'top1Start' => "buttons",
                'bottomStart' => "info",
                'bottomEnd' => "paging",
            ])
            ->buttons([
                Button::make('csv'),
                Button::make('excel'),
                Button::make('print'),
                Button::make('reset'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('updated_at')
                ->exportable(false)
                ->orderable(true)
                ->printable(false)
                ->addClass('text-center')
                ->hidden(),
            Column::computed('DT_RowIndex')
                ->title('No')
                ->addClass('text-center'),
            Column::make('name')
                ->title('Name')
                ->addClass('text-center'),
            Column::make('email')
                ->title('Email')
                ->addClass('text-center'),
            Column::make('batch.name')
                ->title('Batch')
                ->addClass('text-center'),
            Column::make('has_voted')
                ->title('Has Voted')
                ->hidden(),
            Column::make('voted_at')
                ->title('Voted At')
                ->hidden(),
            Column::make('voted_at_display')
                ->title('Voted At')
                ->addClass('text-center'),
            Column::computed('action')
                ->title('Action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Voter_' . date('YmdHis');
    }
}
