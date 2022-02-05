<div class="content">
    @can('question_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.questions.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.question.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-subjectsQuestions">
                            <thead>
                                <tr>
                                    
                                    
                                    <th>
                                        {{ trans('cruds.question.fields.question') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.question.fields.option_a') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.question.fields.option_b') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.question.fields.option_c') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.question.fields.option_d') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.question.fields.question_image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.question.fields.answer') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.question.fields.details') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.question.fields.subjects') }}
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($questions as $key => $question)
                                    <tr data-entry-id="{{ $question->id }}">
                                        
                                        <td>
                                            {{ $question->question ?? '' }}
                                        </td>
                                        <td>
                                            {{ $question->option_a ?? '' }}
                                        </td>
                                        <td>
                                            {{ $question->option_b ?? '' }}
                                        </td>
                                        <td>
                                            {{ $question->option_c ?? '' }}
                                        </td>
                                        <td>
                                            {{ $question->option_d ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($question->question_image as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $media->getUrl('thumb') }}">
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ App\Models\Question::ANSWER_SELECT[$question->answer] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $question->details ?? '' }}
                                        </td>
                                        <td>
                                            {{ $question->subjects->title ?? '' }}
                                        </td>
                                        <td>
                                            @can('question_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.questions.show', $question->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('question_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.questions.edit', $question->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('question_delete')
                                                <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('question_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.questions.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-subjectsQuestions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection