<?php

namespace App\DataTables;

use App\User;
use App\UsersDataTable;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class UsersDataTables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'admin.users.btn.actions')
            ->addColumn('checkbox', 'admin.users.btn.checkbox')
            ->addColumn('level', 'admin.users.btn.level')
            ->rawColumns(['action', 'checkbox', 'level'])
            ->editColumn('created_at', function(User $user){
                return $user->created_at ? with(new Carbon($user->created_at))->format('m/d/Y') : '';
            })
            ->editColumn('updated_at', function(User $user){
                return $user->updated_at ? with(new Carbon($user->updated_at))->format('d/m/Y') : '';
            })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\UsersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return User::query()->where(function($q) {
            return request()->has('level') ? with($q->where('level', request('level'))) : '';
        });
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
                    ->parameters([
                        'dom' => 'Blfrtip',
                        'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, trans('admin.all_record')]],
                        'language' => dataTableLanguage(),
                        'buttons' => [
                            ['extend' => 'csv', 'className' => 'btn btn-info datatable-btn', 'text' => 'CSV'],
                            ['extend' => 'pdf', 'className' => 'btn btn-warning datatable-btn', 'text' => 'PDF'],
                            ['extend' => 'excel', 'className' => 'btn btn-info datatable-btn', 'text' => 'EXCEL'],
                            ['className' => 'btn btn-danger datatable-btn', 'text' => '<i class="fa fa-trash"></i>&nbsp;<span>'.trans('admin.delete_selected_user').'</span>', 'attr' => ['onclick' => "warningDelAll()"]],
                            ['className' => 'btn btn-success datatable-btn', 'text' => '<i class="fa fa-plus"></i>&nbsp;<span">'.trans('admin.add_user').'</span>', 'action' => "function() { window.open('".userUrl('control/create')."', '_top'); }"],
                            [ 'extend' => 'print', 'attr' => ['class' => 'btn btn-primary datatable-btn'], 'text' => '<i class="fa fa-print"></i>'],
                            ['extend' => 'reload', 'className' => 'btn btn-default datatable-btn', 'text' => '<i class="fa fa-refresh"></i>']
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
                'title' => '<input id="all-admins" type="checkbox" onclick="checkAll()" title="'.trans('admin.select_all_users').'"/>',
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'data' => 'id',
                'name' => 'id',
                'title' => trans('admin.admin_id'),
            
            ],
            [
                'data' => 'name',
                'name' => 'name',
                'title' => trans('admin.name'),
            ],
            [
                'data' => 'email',
                'name' => 'email',
                'title' => trans('admin.email'),
            ],
            [
                'data' => 'level',
                'name' => 'level',
                'title' => trans('admin.level'),
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
                'data' => 'action',
                'name' => 'Action',
                'title' => trans('admin.actions'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'UsersDataTables_' . date('YmdHis');
    }
}
