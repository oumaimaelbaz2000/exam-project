@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.examan.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.examen.update", [$examan->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.examan.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $examan->title) }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.examan.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('duration') ? 'has-error' : '' }}">
                            <label class="required" for="duration">{{ trans('cruds.examan.fields.duration') }}</label>
                            <input class="form-control timepicker" type="text" name="duration" id="duration" value="{{ old('duration', $examan->duration) }}" required>
                            @if($errors->has('duration'))
                                <span class="help-block" role="alert">{{ $errors->first('duration') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.examan.fields.duration_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection