<?php

namespace App\DataTables\Candidate;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CandidateDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Candidate> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $buttons = [
            'show' => [
                'class' => 'show-record',
                'icon' => 'info-circle',
                'target' => route('dashboard.candidates.show', ['candidate' => ':id']),
                'color' => 'primary-600',
            ],
            'edit' => [
                'class' => 'edit-record',
                'icon' => 'edit',
                'target' => route('dashboard.candidates.edit', ['candidate' => ':id']),
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
                    if ($btn['class'] === 'delete-record') {
                        continue;
                    }

                    $actions .= sprintf(
                        '<a href="%s" class="inline-flex items-center justify-center w-7 h-7 bg-%s hover:bg-%s-700 text-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 %s me-1" title="%s">
                            <box-icon name="%s" color="#ffffff"></box-icon>
                        </a>',
                        str_replace(':id', $query->id, $btn['target']),
                        $btn['color'],
                        $btn['color'],
                        $btn['class'],
                        ucfirst(explode('-', $btn['class'])[0]),
                        $btn['icon']
                    );
                }

                $actions .= '<button class="inline-flex items-center justify-center w-7 h-7 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 delete-record me-1 cursor-pointer" data-id="' . $query->id . '">
                    <box-icon name="trash" color="#ffffff"></box-icon>
                </button>';

                return $actions ?: '-';
            })
            ->addColumn('photo_url', function ($query) {
                return $query->photo ?: null;
            })
            ->addColumn('photo', function ($query) {
                if ($query->photo) {
                    return sprintf('<a href="%s" target="_blank"><img src="%s" alt="Photo %s" class="h-12 w-12 object-cover rounded-lg mx-auto" loading="lazy" /></a>', $query->photo, $query->photo, $query->number);
                }

                return '-';
            })
            ->addColumn('resume_url', function ($query) {
                return $query->resume ?: null;
            })
            ->addColumn('resume', function ($query) {
                if ($query->resume) {
                    return sprintf('<a href="%s" target="_blank" class="text-blue-600 underline">View Resume</a>', $query->resume);
                }

                return '-';
            })
            ->addColumn('attachment_url', function ($query) {
                return $query->attachment ?: null;
            })
            ->addColumn('attachment', function ($query) {
                if ($query->attachment) {
                    return sprintf('<a href="%s" target="_blank" class="text-blue-600 underline">View Attachment</a>', $query->attachment);
                }

                return '-';
            })
            ->rawColumns(['action', 'photo', 'resume', 'attachment'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Candidate>
     */
    public function query(Candidate $model): QueryBuilder
    {
        return $model->query()->select('candidates.*')
            ->with('votes', 'vision:id,candidate_id,vision', 'missions:id,candidate_id,point', 'programs:id,candidate_id,point');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('candidate-table')
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
            Column::make('number')
                ->title('Candidate Number')
                ->addClass('text-center'),
            Column::computed('photo')
                ->title('Photo')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width(80),
            Column::computed('photo_url')
                ->title('Photo URL')
                ->hidden(),
            Column::make('head_name')
                ->title('Head Name')
                ->addClass('text-center'),
            Column::make('vice_name')
                ->title('Vice Name')
                ->addClass('text-center'),
            Column::computed('resume')
                ->title('Resume')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
            Column::computed('resume_url')
                ->title('Resume URL')
                ->hidden(),
            Column::computed('attachment')
                ->title('Attachment')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
            Column::computed('attachment_url')
                ->title('Attachment URL')
                ->hidden(),
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
        return 'Candidate_' . date('YmdHis');
    }
}
