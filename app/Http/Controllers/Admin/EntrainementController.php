<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Http\Controllers\Admin\QuestionsCntroller;
use App\Http\Requests\MassDestroyEntrainementRequest;
use App\Http\Requests\StoreEntrainementRequest;
use App\Http\Requests\UpdateEntrainementRequest;
use App\Http\Requests\MassDestroyCertificatRequest;
use App\Http\Requests\StoreCertificatRequest;
use App\Http\Requests\UpdateCertificatRequest;
use App\Models\Certificat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntrainementController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entrainement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $certificats = Certificat::all();

        return view('admin.entrainements.index', compact('certificats'));
    }
        

    

    public function create()
    {
        abort_if(Gate::denies('entrainement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.entrainements.create');
    }

    public function store(StoreEntrainementRequest $request)
    {
        $entrainement = Entrainement::create($request->all());

        return redirect()->route('admin.entrainements.index');
    }

    public function edit(Entrainement $entrainement)
    {
        abort_if(Gate::denies('entrainement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.entrainements.edit', compact('entrainement'));
    }

    public function update(UpdateEntrainementRequest $request, Entrainement $entrainement)
    {
        $entrainement->update($request->all());

        return redirect()->route('admin.entrainements.index');
    }

    public function show(Entrainement $entrainement)
    {
        abort_if(Gate::denies('entrainement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.entrainements.show', compact('entrainement'));
    }

    public function destroy(Entrainement $entrainement)
    {
        abort_if(Gate::denies('entrainement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entrainement->delete();

        return back();
    }

    public function massDestroy(MassDestroyEntrainementRequest $request)
    {
        Entrainement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
