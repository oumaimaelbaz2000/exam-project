<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Quizz;
use App\Models\QuizzAnswer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResultsRequest;
use App\Http\Requests\UpdateResultsRequest;
use App\Http\Controllers\Controller;

class ResultsController extends Controller
{
    

    /**
     * Display a listing of Result.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Quizz::all()->load('user');

        if (!Auth::user()->isAdmin()) {
            $results = $results->where('user_id', '=', Auth::id());
        }

        return view('results.index', compact('results'));
    }

    /**
     * Display Result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quizz = Quizz::find($id);
        //->load('users');

        if ($quizz) {
            $results = QuizzAnswer::where('quizz_id', $id)
                ->with('question')
                ->with('question.options')
                ->get()
            ;
        }

        return view('results.show', compact('quizz'));
    }
}
