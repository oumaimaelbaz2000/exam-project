@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.subject.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.subjects.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.subject.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subject.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('certificats') ? 'has-error' : '' }}">
                            <label for="certificats_id">{{ trans('cruds.subject.fields.certificats') }}</label>
                            <select class="form-control select2" name="certificats_id" id="certificats_id">
                                @foreach($certificats as $id => $entry)
                                    <option value="{{ $id }}" {{ old('certificats_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('certificats'))
                                <span class="help-block" role="alert">{{ $errors->first('certificats') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subject.fields.certificats_helper') }}</span>
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