<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStatistiqueRequest;
use App\Http\Requests\StoreStatistiqueRequest;
use App\Http\Requests\UpdateStatistiqueRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatistiquesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('statistique_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statistiques.index');
    }

    public function create()
    {
        abort_if(Gate::denies('statistique_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statistiques.create');
    }

    public function store(StoreStatistiqueRequest $request)
    {
        $statistique = Statistique::create($request->all());

        return redirect()->route('admin.statistiques.index');
    }

    public function edit(Statistique $statistique)
    {
        abort_if(Gate::denies('statistique_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.statistiques.edit', compact('statistique'));
    }

    public function update(UpdateStatistiqueRequest $request, Statistique $statistique)
    {
        $statistique->update($request->all());

        return redirect()->route('admin.statistiques.index');
    }

    public function show(Statistique $statistique)
    {
        

        return view('admin.statistiques.show', compact('statistique'));
    }

    public function destroy(Statistique $statistique)
    {
        abort_if(Gate::denies('statistique_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statistique->delete();

        return back();
    }

    public function massDestroy(MassDestroyStatistiqueRequest $request)
    {
        Statistique::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
