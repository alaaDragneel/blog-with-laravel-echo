<?php
namespace App\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Services\DataTable;


class PermissionsDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('edit','backend.permissions.buttons.edit')
            ->addColumn('delete','backend.permissions.buttons.delete')
            ->rawColumns(['edit', 'delete']);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Permission::query()->select('permissions.*');
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
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
             // 'scrollX' => true,
             'initComplete' => "function () {
                 this.api().columns([0]).every(function () {
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
                'name' => "permissions.name",
                'data'    => 'name',
                'title'   => trans('main.permissions'),
                'searchable' => true,
                'orderable'  => true,
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

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'documentsDataTable_' . time();
    }
}
