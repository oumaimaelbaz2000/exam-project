@extends('layouts.admin')
@section('content')
<div class="content">


           
            <div class="row">
                <div class="col-md-12">
                        
                        <form  method="post" action="{{ route("admin.quizz.store") }}">
                            @csrf
                           
            
                        @if(count($questions) > 0)
                            <div class="panel-body">
                            <?php $i = 1; ?>
                            @foreach($questions as $question)
                                @if ($i > 1) <hr /> 
                                @endif
                                <div class="row">
                                    <div class="col-xs-12 form-group">
                                        <div class="form-group">
                                            <h3 style="margin-left:5%" ><strong>Question {{ $i }}.{{ $question->question }}</strong></h3>
                                            
                                            <ul class="list-group" style="margin-left:5% ; margin-right:5%">
                                                <div class="row ">
                                                    
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input ml-2" type="radio" name="selected_answer" id="option_1" value="1">
                                                                <label class="form-check-label text-dark" for="option_1">
                                                                    {{ $question->option_a }}
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </div>
                                                    <br>
                                                    <div class="row ">
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input ml-2" type="radio" name="selected_answer" id="option_2" value="2">
                                                                <label class="form-check-label text-dark" for="option_2">
                                                                    {{ $question->option_b }}
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </div>
                                                <br>
                                                <div class="row ">
                                                    
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input ml-2" type="radio" name="selected_answer" id="option_3" value="3">
                                                                <label class="form-check-label text-dark" for="option_3">
                                                                    {{ $question->option_c }}
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input ml-2" type="radio" name="selected_answer" id="option_4" value="4">
                                                                <label class="form-check-label text-dark" for="option_4">
                                                                    {{ $question->option_d }}
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </div>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                                
                                
                              @endforeach
                            </div>
                        @endif
                        <button type="submit" id="submit" class="btn btn-primary btn-sm pull-right  " style="margin-right: 5%">Submit</button>
                        </form>
                </div>
            </div>
        </div>
        
@endsection     

@section('scripts')  
@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "hh:mm:ss"
        });
    </script>

@stop
    
<script>


</script>
@endsection
        

@section('styles')
<style>
</style>
@endsection

  
