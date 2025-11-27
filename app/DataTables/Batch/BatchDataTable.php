<?php

namespace App\DataTables\Batch;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BatchDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Batch> $query Results from query() method.
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
            ->editColumn('description_short', function ($query) {
                return strlen($query->description) > 50
                    ? substr($query->description, 0, 50) . '...'
                    : $query->description;
            })
            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Batch>
     */
    public function query(Batch $model): QueryBuilder
    {
        return $model->query()->select('batches.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('batch-table')
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
            Column::computed('name')
                ->exportable(false)
                ->orderable(true)
                ->printable(false)
                ->addClass('text-center')
                ->hidden(),
            Column::computed('DT_RowIndex')
                ->title('No')
                ->addClass('text-center'),
            Column::make('name')
                ->title('Batch Name')
                ->addClass('text-center'),
            Column::computed('description')
                ->title('Description')
                ->hidden(),
            Column::make('description_short')
                ->exportable(false)
                ->printable(false)
                ->title('Description')
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
        return 'Batch_' . date('YmdHis');
    }
}
