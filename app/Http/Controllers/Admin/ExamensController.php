<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExamanRequest;
use App\Http\Requests\StoreExamanRequest;
use App\Http\Requests\UpdateExamanRequest;
use App\Models\Examan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ExamensController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('examan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Examan::query()->select(sprintf('%s.*', (new Examan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'examan_show';
                $editGate = 'examan_edit';
                $deleteGate = 'examan_delete';
                $crudRoutePart = 'examen';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('duration', function ($row) {
                return $row->duration ? $row->duration : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.examen.index');
    }

    public function create()
    {
        abort_if(Gate::denies('examan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.examen.create');
    }

    public function store(StoreExamanRequest $request)
    {
        $examan = Examan::create($request->all());

        return redirect()->route('admin.examen.index');
    }

    public function edit(Examan $examan)
    {
        abort_if(Gate::denies('examan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.examen.edit', compact('examan'));
    }

    public function update(UpdateExamanRequest $request, Examan $examan)
    {
        $examan->update($request->all());

        return redirect()->route('admin.examen.index');
    }

    public function show(Examan $examan)
    {
        abort_if(Gate::denies('examan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.examen.show', compact('examan'));
    }

    public function destroy(Examan $examan)
    {
        abort_if(Gate::denies('examan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $examan->delete();

        return back();
    }

    public function massDestroy(MassDestroyExamanRequest $request)
    {
        Examan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
