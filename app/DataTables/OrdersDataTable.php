<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable(): \Yajra\DataTables\DataTableAbstract
    {
        return datatables($this->query())
            ->editColumn('id', function ($row) {

                return $row->id;
            })
            ->editColumn('partners', function ($row) {
                return $row->partner->name;
            })
            ->editColumn('status', function ($row) {
                return OrderStatus($row->status);
            })
            ->addColumn('summ', function ($row) {
                return SummOrder($row);
            })
            ->addColumn('list', 'order.list')
            ->addColumn('action', 'order.action')
            ->rawColumns(['status', 'action', 'summ', 'partners','list'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        $order = Order::with('product')->orderBy('delivery_dt');

        return $this->applyScopes($order);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->setTableId('orders-table')
            ->processing(true)
            ->serverSide(true)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('frtip')
            ->info(true)
            ->responsive(true)
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('№ Заказа')->name('id'),
            Column::make('partners')->title('Партнер')->addClass('text-left')->name('partners'),
            Column::make('summ')->title('Сумма заказа')->addClass('text-center')->name('summ'),
            Column::make('list')->title('Список')->addClass('text-center')->name('list'),
            Column::make('status')->title('Статус')->addClass('text-center')->name('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Orders_' . date('YmdHis');
    }
}
