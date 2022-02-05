@extends('layouts.admin')
@section('content')
<div class="content">
    
        
   
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des certifications
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Certificat">
                            <thead>
                                <tr>
                                    
                               
                                    <th width='90%'>
                                          Title
                                    </th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($certificats as $key => $certificat)
                                    <tr data-entry-id="{{ $certificat->id }}">
                                        
                                        <td>
                                            <a class="" href="{{ route('admin.certificats.show', $certificat->id) }}">
                                                {{ $certificat->title ?? '' }}
                                            </a>
                                          
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 3, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Certificat:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection