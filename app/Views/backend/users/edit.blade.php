@extends('backend.theme.layout.app')

@section('styles')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-blue">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{route('users.index')}}" data-toggle="tooltip" title="{{trans('main.show-all')}}   {{trans('main.users')}}"> <i class="fa fa-list"></i> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{ route('users.update', [$edit->id]) }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PATCH')
                        <div class="form-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('main.name') }} <span class="required"></span> </label>
                                <div class="col-md-6">
                                    <input type="text" name="name" value="{{ $edit->name }}" class="form-control" placeholder="{{ trans('main.name') }}" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong class="help-block">{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('main.email') }} <span class="required"></span> </label>
                                <div class="col-md-6">
                                    <input type="email" name="email" value="{{ $edit->email }}" class="form-control" placeholder="{{ trans('main.email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong class="help-block">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label class="control-label col-md-2">{{ trans('main.image') }}</label>
                                <div class="col-md-6">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            <img src="{{ ShowImage($edit->image) }}" alt="" />
                                        </div>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new"> {{ trans('main.select_image') }} </span>
                                                <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                                                <input type="file" name="image">
                                            </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                                        </div>
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong class="help-block">{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('main.type') }} <span class="required"></span> </label>
                                <div class="col-md-6">
                                    <select class="form-control" name="type" required>
                                        <option value=""></option>
                                        <option value="user" {{ $edit->type == 'user' ? ' selected' : '' }}>{{trans('main.user')}}</option>
                                        <option value="admin" {{ $edit->type == 'admin' ? ' selected' : '' }}>{{trans('main.admin')}}</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong class="help-block">{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('main.password') }} </label>
                                <div class="col-md-6">
                                    <input type="password" name="password" class="form-control" placeholder="{{ trans('main.password') }}">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong class="help-block">{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('main.password_confirmation') }} </label>
                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('main.password_confirmation') }}">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong class="help-block">{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class="col-md-2 control-label">{{ trans('main.assign_rolles') }}</label>
                                <div class="col-md-10">
                                    @foreach ($roles as $role)
                                        <span style="margin-right: 3px">
                                            <input type="checkbox" name="roles[]" value="{{$role->id}}" {{ in_array($role->id, $edit->roles->pluck('id')->toArray()) ? ' checked' : '' }} />
                                            {{ Form::label($role->name, ucfirst($role->name)) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>


                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn green">{{ trans('main.edit') }} {{ trans('main.user') }}</button>
                                    <a href="{{ route('users.index') }}" class="btn default">{{ trans('main.cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
@endsection
