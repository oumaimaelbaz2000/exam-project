<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Http\Controllers\Admin\QuestionsController;

use App\Models\Certificat;

use App\Models\Subject;
use App\Models\Quizz;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class QuizzController extends Controller
{       public function index(Subject $subject){

}  
public function store(Request $request)
{
    $result = 0;

    $quizz = Quizz::create([
       'user_id' => Auth::id(),
        'result'  => $result,
    ]);

    foreach ($request->input('questions', []) as $key => $question) {
        $status = 0;

        if ($request->input('answers.'.$question) != null
            && QuestionsOption::find($request->input('answers.'.$question))->correct
        ) {
            $status = 1;
            $result++;
        }
    QuizzAnswer::create([
            'user_id'     => Auth::id(),
            'quizz_id'     => $quizz->id,
        
            'question_id' => $question,
            'option_id'   => $request->input('answers.'.$question),
            'correct'     => $status,
        ]);
    }

    $quizz->update(['result' => $result]);

    return redirect()->route('admin.results.show', [$quizz->id]);
}
    

    
}
