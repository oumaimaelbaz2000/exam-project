<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyQuestionRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\Subject;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class QuestionsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        //abort_if(Gate::denies('question_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Question::with(['subjects'])->select(sprintf('%s.*', (new Question())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'question_show';
                $editGate = 'question_edit';
                $deleteGate = 'question_delete';
                $crudRoutePart = 'questions';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('question', function ($row) {
                return $row->question ? $row->question : '';
            });
            $table->editColumn('option_a', function ($row) {
                return $row->option_a ? $row->option_a : '';
            });
            $table->editColumn('option_b', function ($row) {
                return $row->option_b ? $row->option_b : '';
            });
            $table->editColumn('option_c', function ($row) {
                return $row->option_c ? $row->option_c : '';
            });
            $table->editColumn('option_d', function ($row) {
                return $row->option_d ? $row->option_d : '';
            });
            $table->editColumn('question_image', function ($row) {
                if (!$row->question_image) {
                    return '';
                }
                $links = [];
                foreach ($row->question_image as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('answer', function ($row) {
                return $row->answer ? Question::ANSWER_SELECT[$row->answer] : '';
            });
            $table->editColumn('details', function ($row) {
                return $row->details ? $row->details : '';
            });
            $table->addColumn('subjects_title', function ($row) {
                return $row->subjects ? $row->subjects->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'question_image', 'subjects']);

            return $table->make(true);
        }

        return view('admin.questions.index');
    }

    public function create()
    {
        //abort_if(Gate::denies('question_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = Subject::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.questions.create', compact('subjects'));
    }

    public function store(StoreQuestionRequest $request)
    {
        $question = Question::create($request->all());

        foreach ($request->input('question_image', []) as $file) {
            $question->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('question_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $question->id]);
        }

        return redirect()->route('admin.questions.index');
    }

    public function edit(Question $question)
    {
        //abort_if(Gate::denies('question_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = Subject::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $question->load('subjects');

        return view('admin.questions.edit', compact('question', 'subjects'));
    }

    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update($request->all());

        if (count($question->question_image) > 0) {
            foreach ($question->question_image as $media) {
                if (!in_array($media->file_name, $request->input('question_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $question->question_image->pluck('file_name')->toArray();
        foreach ($request->input('question_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $question->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('question_image');
            }
        }

        return redirect()->route('admin.questions.index');
    }

    public function show(Question $question)
    {
        //abort_if(Gate::denies('question_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question->load('subjects');

        return view('admin.questions.show', compact('question'));
    }

    public function destroy(Question $question)
    {
        //abort_if(Gate::denies('question_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question->delete();

        return back();
    }

    public function massDestroy(MassDestroyQuestionRequest $request)
    {
        Question::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        //abort_if(Gate::denies('question_create') && Gate::denies('question_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Question();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
