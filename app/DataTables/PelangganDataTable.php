<?php

namespace App\DataTables;

use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PelangganDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', 'pelanggan.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pelanggan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pelanggan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0, 'asc')
                    ->responsive()
                    ->autoWidth(false)
                    ->parameters(['scrollX' => true])
                    ->selectStyleSingle()
                    ->addTableClass('align-middle table table-row-dashed gy-4')
                    ->buttons([
                        Button::make('excel')->exportOptions(['columns' => [0,1,2,3]]),
                        Button::make('csv')->exportOptions(['columns' => [0,1,2,3]]),
                        Button::make('pdf')->exportOptions(['columns' => [0,1,2,3]]),
                        Button::make('print')->exportOptions(['columns' => [0,1,2,3]]),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title(__('No'))->data('DT_RowIndex')->addClass('text-center')->width(10),
            Column::make('namaPelanggan')->title('Nama Pelanggan'),
            Column::make('noTelp')->title('Nomor Telepon'),
            Column::make('alamat')->title('Alamat'),
            Column::computed('action')->title('Aksi')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pelanggan_' . date('YmdHis');
    }
}
