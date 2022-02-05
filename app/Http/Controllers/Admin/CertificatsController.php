<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCertificatRequest;
use App\Http\Requests\StoreCertificatRequest;
use App\Http\Requests\UpdateCertificatRequest;
use App\Models\Certificat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CertificatsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('certificat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificats = Certificat::all();

        return view('admin.certificats.index', compact('certificats'));
    }

    public function create()
    {
        abort_if(Gate::denies('certificat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.certificats.create');
    }

    public function store(StoreCertificatRequest $request)
    {
        $certificat = Certificat::create($request->all());

        return redirect()->route('admin.certificats.index');
    }

    public function edit(Certificat $certificat)
    {
        abort_if(Gate::denies('certificat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.certificats.edit', compact('certificat'));
    }

    public function update(UpdateCertificatRequest $request, Certificat $certificat)
    {
        $certificat->update($request->all());

        return redirect()->route('admin.certificats.index');
    }

    public function show(Certificat $certificat)
    {
        abort_if(Gate::denies('certificat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificat->load('certificatsSubjects');

        return view('admin.certificats.show', compact('certificat'));
    }

    public function destroy(Certificat $certificat)
    {
        abort_if(Gate::denies('certificat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificat->delete();

        return back();
    }

    public function massDestroy(MassDestroyCertificatRequest $request)
    {
        Certificat::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
