<?php

namespace App\DataTables;

use App\Models\Post;
use Yajra\DataTables\Services\DataTable;

class PostsDataTable extends DataTable
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
        ->addColumn('checkbox','<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
        ->addColumn('show','backend.posts.buttons.show')
        ->addColumn('edit','backend.posts.buttons.edit')
        ->addColumn('delete','backend.posts.buttons.delete')
        ->rawColumns(['checkbox','show','edit', 'delete', 'type'])
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = Post::query()->with('user')->select('posts.*');
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
            // 'scrollX' => true,
            'initComplete' => "function () {
                this.api().columns([1,2,3,4,5,6]).every(function () {
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
                'name' => "posts.title",
                'data'    => 'title',
                'title'   => trans('main.title'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => "user.name",
                'data'    => 'user.name',
                'title'   => trans('main.user'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => "posts.slug",
                'data'    => 'slug',
                'title'   => trans('main.slug'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => "posts.later_publish",
                'data'    => 'later_publish',
                'title'   => trans('main.later_publish'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => "posts.status",
                'data'    => 'status',
                'title'   => trans('main.status'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => "posts.created_at",
                'data'    => 'created_at',
                'title'   => trans('main.created_at'),
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
        return 'Posts_' . date('YmdHis');
    }
}
