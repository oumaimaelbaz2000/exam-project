@extends('layouts.admin')
@section('content')
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
                <div class="panel-heading">
                    {{ trans('cruds.question.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Question">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.question.fields.id') }}
                                </th>
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
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('question_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.questions.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.questions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'question', name: 'question' },
{ data: 'option_a', name: 'option_a' },
{ data: 'option_b', name: 'option_b' },
{ data: 'option_c', name: 'option_c' },
{ data: 'option_d', name: 'option_d' },
{ data: 'question_image', name: 'question_image', sortable: false, searchable: false },
{ data: 'answer', name: 'answer' },
{ data: 'details', name: 'details' },
{ data: 'subjects_title', name: 'subjects.title' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Question').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection