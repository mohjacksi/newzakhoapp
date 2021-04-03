<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRealEstateTypeRequest;
use App\Http\Requests\UpdateRealEstateTypeRequest;
use App\Http\Resources\Admin\RealEstateTypeResource;
use App\Models\RealEstateType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RealEstateTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('real_estate_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RealEstateTypeResource(RealEstateType::all());
    }

    public function store(StoreRealEstateTypeRequest $request)
    {
        $realEstateType = RealEstateType::create($request->all());

        return (new RealEstateTypeResource($realEstateType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RealEstateType $realEstateType)
    {
        abort_if(Gate::denies('real_estate_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RealEstateTypeResource($realEstateType);
    }

    public function update(UpdateRealEstateTypeRequest $request, RealEstateType $realEstateType)
    {
        $realEstateType->update($request->all());

        return (new RealEstateTypeResource($realEstateType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RealEstateType $realEstateType)
    {
        abort_if(Gate::denies('real_estate_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstateType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
