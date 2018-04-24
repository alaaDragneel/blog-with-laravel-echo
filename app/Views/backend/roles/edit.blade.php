@extends('backend.theme.layout.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-blue">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{route('roles.index')}}" data-toggle="tooltip" title="{{trans('main.show-all')}}   {{trans('main.roles')}}"> <i class="fa fa-list"></i> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    {!! Form::model($role, ['route' => array('roles.update', $role->id), 'method' => 'PUT','class'=>'form-horizontal']) !!}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">{{trans('main.role_name')}}</label>
                                <div class="col-md-9">
                                    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>trans('main.role_name')]) !!}
                                </div>
                            </div>
                            <div class='form-group'>
                                <label class="col-md-3 control-label">{{ trans('main.assign_permissions') }}</label>
                                <div class="col-md-9">
                                    @foreach ($permissions->chunk(4) as $permissionChunck)
                                        <div class="row">
                                            @foreach ($permissionChunck as $permission)
                                                <div class="col-md-3">
                                                    {{ Form::checkbox('permissions[]',  $permission->id ) }}
                                                    {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">{{ trans('main.edit') }} {{ trans('main.role') }}</button>
                                    <a href="{{ route('roles.index') }}" class="btn default">{{ trans('main.cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
