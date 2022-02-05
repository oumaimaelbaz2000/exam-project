<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExamanRequest;
use App\Http\Requests\UpdateExamanRequest;
use App\Http\Resources\Admin\ExamanResource;
use App\Models\Examan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExamensApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('examan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExamanResource(Examan::all());
    }

    public function store(StoreExamanRequest $request)
    {
        $examan = Examan::create($request->all());

        return (new ExamanResource($examan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Examan $examan)
    {
        abort_if(Gate::denies('examan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExamanResource($examan);
    }

    public function update(UpdateExamanRequest $request, Examan $examan)
    {
        $examan->update($request->all());

        return (new ExamanResource($examan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Examan $examan)
    {
        abort_if(Gate::denies('examan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $examan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
