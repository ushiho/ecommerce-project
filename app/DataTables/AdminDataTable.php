<?php

namespace App\DataTables;

use App\Admin;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('actions', 'admin.admins.btn.actions')
            ->addColumn('checkbox', 'admin.admins.btn.checkbox')
            ->rawColumns([
                'actions',
                'checkbox',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Admin::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->addAction(['width' => '80px'])
                    ->parameters([
                        'dom'        => 'Blfrtip',
                        'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, trans('admin.all_record')]],
                        'buttons'    => [
                            ['extend' => 'csv', 'className' => 'btn btn-info btn-s datatable-btn', 'text' => 'CSV'],
                            ['extend' => 'pdf', 'className' => 'btn btn-warning btn-s datatable-btn', 'text' => 'PDF'],
                            ['extend' => 'excel', 'className' => 'btn btn-info btn-s datatable-btn', 'text' => 'EXCEL'],
                            ['attr' => ['id' => 'btn-del', 'onclick' => 'warningDelAll()'], 'className' => 'btn btn-danger btn-s datatable-btn', 'text' => '<span title="'.trans('admin.delete_all_title').'"><i class="fa fa-trash"></i>&nbsp;'.trans('admin.delete_all_title').'</span>'],
                            ['className' => 'btn btn-success btn-s datatable-btn', 'text' => '<i class="fa fa-plus"></i>&nbsp;<span title="'.trans('admin.add_admin').'">'.trans('admin.add_admin').'</span>',
                            'action' => "function() { window.open('".aurl('control/create')."', '_top');}"],
                            ['extend' => 'print', 'className' => 'btn btn-primary btn-s datatable-btn', 'text' => '<i class="fa fa-print"></i>'],
                            ['extend' => 'reload', 'className' => 'btn btn-default btn-s datatable-btn', 'text' => '<i class="fa fa-refresh"></i>'],
                        ],
                        'initComplete' => " function () {
                            this.api().columns([2, 3,]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                        'language' => dataTableLanguage(),
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'data' => 'checkbox',
                'name' => 'checkbox',
                'title' => '<input id="all-admins" type="checkbox" title="'.trans('admin.select_all').'" onclick="checkAll('.admin()->user()->id.')">',
                'exportable' => false,
                'orderable' => false,
                'printable' => false,
                'searchable' => false,
                
            ],
            [
                'data' => 'id',
                'name' => 'ID',
                'title' => trans('admin.admin_id'),
            ],
            [
                'data' => 'name',
                'name' => 'Name',
                'title' => trans('admin.name'),
            ],
            [
                'data' => 'email',
                'name' => 'Email',
                'title' => trans('admin.email'),
            ],
            [
                'data' => 'created_at',
                'name' => 'Created at',
                'title' => trans('admin.created_at'),
            ],
            [
                'data' => 'updated_at',
                'name' => 'Updated at',
                'title' => trans('admin.updated_at'),
            ],
            [
                'data' => 'actions',
                'name' => 'Actions',
                'title' => trans('admin.actions'),
                'exportable' => false,
                'orderable' => false,
                'printable' => false,
                'searchable' => false,
            ],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin_' . date('YmdHis');
    }
}
