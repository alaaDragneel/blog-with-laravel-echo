<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class UserRolesDataTable extends DataTable
{

    protected $roleName;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
        ->addColumn('checkbox','<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
        ->addColumn('type', function ($model) {
            if ($model->type == 'admin') {
                return '
                    <span class="label label-success">' . trans("main.admin") . '</span>
                ';
            } else {
                return '
                    <span class="label label-warning">' . trans("main.user") . '</span>
                ';
            }
        })
        ->addColumn('show','backend.users.buttons.show')
        ->addColumn('edit','backend.users.buttons.edit')
        ->addColumn('delete','backend.users.buttons.delete')
        ->rawColumns(['checkbox','show','edit', 'delete', 'type'])
        ;
    }


    public function GetRoleName($name) {
        $this->roleName = $name;
        return $this;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = User::query()->select('users.*')->role($this->roleName);;
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $html =  $this->builder()
        ->columns($this->getColumns())
        ->ajax('')
        ->parameters([
            'dom' => 'Blfrtip',
            "lengthMenu" => [[10, 25, 50, -1], [10, 25, 50, trans('main.all_records')]],
            'buttons' => [
                [
                    'text' => '<i class="fa fa-plus"></i> '.trans('main.add'),
                    'className' => 'btn default createBtn'
                ],
                ['extend' => 'print', 'className' => 'btn default', 'text' => '<i class="fa fa-print"></i> '.trans('main.print')],
                ['extend' => 'excel', 'className' => 'btn default', 'text' => '<i class="fa fa-file-excel-o"> </i> '.trans('main.export_excel')],
                ['extend' => 'csv', 'className' => 'btn default', 'text' => '<i class="fa fa-file-excel-o"> </i> '.trans('main.export_csv')],
                ['extend' => 'reload', 'className' => 'btn default', 'text' => '<i class="fa fa fa-refresh"></i> '.trans('main.reload')],
                [
                    'text' => '<i class="fa fa-trash"></i> '.trans('main.delete'),
                    'className'    => 'btn red deleteBtn',
                ],
            ],
            'initComplete' => "function () {
                this.api().columns([1, 2, 3]).every(function () {
                    var column = this;
                    var input = document.createElement(\"input\");
                    $(input).attr( 'style', 'width: 100%');
                    $(input).attr( 'class', 'form-control');
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val()).draw();
                    });
                });
            }",
            'order' => [[1, 'asc']]
        ]);

        return $html;
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
                'name' => 'checkbox',
                'data' => 'checkbox',
                'title' => '<input type="checkbox" class="select-all" onclick="select_all()">',
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => false,
                'width'          => '10px',
                'aaSorting'      => 'none'
            ],
            [
                'name' => "users.name",
                'data'    => 'name',
                'title'   => trans('main.name'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => "users.email",
                'data'    => 'email',
                'title'   => trans('main.email'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => "users.type",
                'data'    => 'type',
                'title'   => trans('main.type'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => 'show',
                'data' => 'show',
                'title' => trans('main.show'),
                'exportable' => false,
                'printable'  => false,
                'searchable' => false,
                'orderable'  => false,
            ],
            [
                'name' => 'edit',
                'data' => 'edit',
                'title' => trans('main.edit'),
                'exportable' => false,
                'printable'  => false,
                'searchable' => false,
                'orderable'  => false,
            ],
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('main.delete'),
                'exportable' => false,
                'printable'  => false,
                'searchable' => false,
                'orderable'  => false,
            ],

        ];
    }

    protected function filename()
    {
        return 'UserRoles_' . date('YmdHis');
    }
}
