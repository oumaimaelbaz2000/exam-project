@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        Titre de la matière:
                                    </th>
                                    <td>
                                        {{ $subject->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Certification:
                                    </th>
                                    <td>
                                        {{ $subject->certificats->title ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
            @can('question_edit')
            <div class="panel panel-default">
                
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#subjects_questions" aria-controls="subjects_questions" role="tab" data-toggle="tab">
                            {{ trans('cruds.question.title') }}
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="subjects_questions">
                        
                        @includeIf('admin.subjects.relationships.subjectsQuestions', ['questions' => $subject->subjectsQuestions])
                
                    </div>
                </div>
            </div>
            @endcan
            @can('student_permission')
            <div class="panel panel-default">
                
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#subjects_questions" aria-controls="subjects_questions" role="tab" data-toggle="tab">
                            {{ trans('cruds.question.title') }}
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="subjects_questions">
                        
                        @includeIf('admin.quizz.index', ['questions' => $subject->subjectsQuestions])
                
                    </div>
                </div>
            </div>
            @endcan
            
        </div>
    </div>
</div>
@endsection