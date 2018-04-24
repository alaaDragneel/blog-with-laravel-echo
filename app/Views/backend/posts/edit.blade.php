@extends('backend.theme.layout.app')

@section('styles')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/medium/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/medium/css/medium-editor.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/medium/css/themes/default.css') }}" id="medium-editor-theme">

    <link href="{{ asset('backend/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{route('posts.index')}}" data-toggle="tooltip" title="{{trans('main.show-all')}}   {{trans('main.posts')}}"> <i class="fa fa-list"></i> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{ route('posts.update', [$edit->id]) }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PATCH')
                        <div class="form-body">

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('main.title') }} <span class="required"></span> </label>
                                <div class="col-md-6">
                                    <input type="text" name="title" value="{{ $edit->title }}" class="form-control" placeholder="{{ trans('main.title') }}" required>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong class="help-block">{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label class="control-label col-md-2">{{ trans('main.image') }}</label>
                                <div class="col-md-6">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            <img src="{{ShowImage($edit->image)}}" alt="" />
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

                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('main.body') }} <span class="required"></span> </label>
                                <div class="col-md-6">
                                    <textarea name="body" class="medium  medium-editor-textarea" required>{{ $edit->body }}</textarea>
                                    @if ($errors->has('body'))
                                        <span class="help-block">
                                            <strong class="help-block">{{ $errors->first('body') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('main.slug') }} <span class="required"></span> </label>
                                <div class="col-md-6">
                                    <input type="text" name="slug" value="{{ $edit->slug }}" class="form-control" placeholder="{{ trans('main.slug') }}" required>
                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                            <strong class="help-block">{{ $errors->first('slug') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('later_publish') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">{{ trans('main.later_publish') }} <span class="required"></span> </label>
                                <div class="col-md-6">
                                    <select class="form-control" id="later_publish" name="later_publish">
                                        <option value=""></option>
                                        <option value="yes" {{ $edit->later_publish == 'yes' ? ' selected' : '' }}>{{trans('main.yes')}}</option>
                                        <option value="no" {{ $edit->later_publish == 'no' ? ' selected' : '' }}>{{trans('main.no')}}</option>
                                    </select>
                                    @if ($errors->has('later_publish'))
                                        <span class="help-block">
                                            <strong class="help-block">{{ $errors->first('later_publish') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group hidden" id="later_publish_date_time"></div>

                            @if (userCan('Change Posts Status'))
                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label">{{ trans('main.status') }} <span class="required"></span> </label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="status" name="status">
                                            <option value=""></option>
                                            <option value="approved" {{ $edit->status == 'approved' ? ' selected' : '' }}>{{trans('main.approved')}}</option>
                                            <option value="rejected" {{ $edit->status == 'rejected' ? ' selected' : '' }}>{{trans('main.rejected')}}</option>
                                            <option value="pending" {{ $edit->status == 'pending' ? ' selected' : '' }}>{{trans('main.pending')}}</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="help-block">
                                                <strong class="help-block">{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif
                                        <hr>
                                    </div>
                                </div>
                            @endif


                            <div class='form-group'>
                                <label class="col-md-2 control-label">{{ trans('main.tags') }}</label>
                                <div class="col-md-10">
                                    @foreach ($tags->chunk(4) as $tagCh)
                                        <div class="row">
                                            @foreach ($tagCh as $tag)
                                                <div class="col-md-3">
                                                    <span style="margin-right: 3px">
                                                        <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{ in_array($tag->id, $edit->tags->pluck('id')->toArray()) ? ' checked' : '' }}>
                                                        {{ Form::label($tag->name, ucfirst($tag->name)) }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn green">{{ trans('main.edit') }} {{ trans('main.post') }}</button>
                                    <a href="{{ route('posts.index') }}" class="btn default">{{ trans('main.cancel') }}</a>
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
    <script src="{{ asset('backend/medium/js/medium-editor.js') }}"></script>

    <script src="{{ asset('backend/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
        var editor = new MediumEditor('.medium', {
            toolbar: {
                buttons: ['bold', 'italic', 'underline', 'strikethrough', 'quote', 'anchor', 'image', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', 'superscript', 'subscript', 'orderedlist', 'unorderedlist', 'pre', 'outdent', 'indent', 'h2', 'h3'],
            },
            buttonLabels: 'fontawesome'
        });

        $('#later_publish').on('change', function() {
            var val = $(this).val();
            if (val == 'yes') {
                $('#later_publish_date_time').removeClass('hidden').html(`
                    <label class="control-label col-md-2">{{ trans('main.publish_date') }}</label>
                    <div class="col-md-2">
                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                            <input type="text" value="{{ $edit->publish_date }}" class="form-control" name="publish_date" readonly>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </div>
                    <label class="control-label col-md-2">{{ trans('main.publish_time') }}</label>
                    <div class="col-md-2">
                        <div class="input-group">
                            <input type="text" name="publish_time" value="{{ $edit->publish_time }}" class="form-control timepicker timepicker-24">
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-clock-o"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                `);

                $('#status').val('pending').attr('readonly', true);

                $('.date-picker').datepicker({
                    orientation: "left",
                    autoclose: true
                });
                $('.timepicker-24').timepicker({
                    autoclose: true,
                    minuteStep: 5,
                    showSeconds: false,
                    showMeridian: false
                });
            } else {
                $('#later_publish_date_time').addClass('hidden').html("");
                $('#status').val('pending').attr('readonly', false);
            }
        });
        $('#later_publish').trigger('change')
    </script>
@endsection
