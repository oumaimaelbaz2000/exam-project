@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
            
                
                    
                        
                        <table class="table table-bordered table-striped">
                                    <th>
                                         certification:
                                    </th>
                                    <td>
                                        {{ $certificat->title }}
                                    </td>
                        </table>
            </div>

            <div class="panel panel-default">
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#certificats_subjects" aria-controls="certificats_subjects" role="tab" data-toggle="tab">
                            {{ trans('cruds.subject.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane"  id="certificats_subjects">
                        @includeIf('admin.certificats.relationships.certificatsSubjects', ['subjects' => $certificat->certificatsSubjects])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection