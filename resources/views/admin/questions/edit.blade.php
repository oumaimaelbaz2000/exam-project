@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.question.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.questions.update", [$question->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                            <label class="required" for="question">{{ trans('cruds.question.fields.question') }}</label>
                            <input class="form-control" type="text" name="question" id="question" value="{{ old('question', $question->question) }}" required>
                            @if($errors->has('question'))
                                <span class="help-block" role="alert">{{ $errors->first('question') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.question_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('option_a') ? 'has-error' : '' }}">
                            <label class="required" for="option_a">{{ trans('cruds.question.fields.option_a') }}</label>
                            <input class="form-control" type="text" name="option_a" id="option_a" value="{{ old('option_a', $question->option_a) }}" required>
                            @if($errors->has('option_a'))
                                <span class="help-block" role="alert">{{ $errors->first('option_a') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.option_a_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('option_b') ? 'has-error' : '' }}">
                            <label class="required" for="option_b">{{ trans('cruds.question.fields.option_b') }}</label>
                            <input class="form-control" type="text" name="option_b" id="option_b" value="{{ old('option_b', $question->option_b) }}" required>
                            @if($errors->has('option_b'))
                                <span class="help-block" role="alert">{{ $errors->first('option_b') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.option_b_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('option_c') ? 'has-error' : '' }}">
                            <label for="option_c">{{ trans('cruds.question.fields.option_c') }}</label>
                            <input class="form-control" type="text" name="option_c" id="option_c" value="{{ old('option_c', $question->option_c) }}">
                            @if($errors->has('option_c'))
                                <span class="help-block" role="alert">{{ $errors->first('option_c') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.option_c_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('option_d') ? 'has-error' : '' }}">
                            <label for="option_d">{{ trans('cruds.question.fields.option_d') }}</label>
                            <input class="form-control" type="text" name="option_d" id="option_d" value="{{ old('option_d', $question->option_d) }}">
                            @if($errors->has('option_d'))
                                <span class="help-block" role="alert">{{ $errors->first('option_d') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.option_d_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('question_image') ? 'has-error' : '' }}">
                            <label for="question_image">{{ trans('cruds.question.fields.question_image') }}</label>
                            <div class="needsclick dropzone" id="question_image-dropzone">
                            </div>
                            @if($errors->has('question_image'))
                                <span class="help-block" role="alert">{{ $errors->first('question_image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.question_image_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.question.fields.answer') }}</label>
                            <select class="form-control" name="answer" id="answer">
                                <option value disabled {{ old('answer', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Question::ANSWER_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('answer', $question->answer) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('answer'))
                                <span class="help-block" role="alert">{{ $errors->first('answer') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.answer_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('details') ? 'has-error' : '' }}">
                            <label for="details">{{ trans('cruds.question.fields.details') }}</label>
                            <input class="form-control" type="text" name="details" id="details" value="{{ old('details', $question->details) }}">
                            @if($errors->has('details'))
                                <span class="help-block" role="alert">{{ $errors->first('details') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.details_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('subjects') ? 'has-error' : '' }}">
                            <label class="required" for="subjects_id">{{ trans('cruds.question.fields.subjects') }}</label>
                            <select class="form-control select2" name="subjects_id" id="subjects_id" required>
                                @foreach($subjects as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('subjects_id') ? old('subjects_id') : $question->subjects->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('subjects'))
                                <span class="help-block" role="alert">{{ $errors->first('subjects') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.subjects_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedQuestionImageMap = {}
Dropzone.options.questionImageDropzone = {
    url: '{{ route('admin.questions.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="question_image[]" value="' + response.name + '">')
      uploadedQuestionImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedQuestionImageMap[file.name]
      }
      $('form').find('input[name="question_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($question) && $question->question_image)
      var files = {!! json_encode($question->question_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="question_image[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection