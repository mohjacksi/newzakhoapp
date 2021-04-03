<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRealEstateRequest;
use App\Http\Requests\UpdateRealEstateRequest;
use App\Http\Resources\Admin\RealEstateResource;
use App\Models\RealEstate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RealEstateApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('real_estate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RealEstateResource(RealEstate::with(['type'])->get());
    }

    public function store(StoreRealEstateRequest $request)
    {
        $realEstate = RealEstate::create($request->all());

        if ($request->input('photos', false)) {
            $realEstate->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
        }

        return (new RealEstateResource($realEstate))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RealEstate $realEstate)
    {
        abort_if(Gate::denies('real_estate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RealEstateResource($realEstate->load(['type']));
    }

    public function update(UpdateRealEstateRequest $request, RealEstate $realEstate)
    {
        $realEstate->update($request->all());

        if ($request->input('photos', false)) {
            if (!$realEstate->photos || $request->input('photos') !== $realEstate->photos->file_name) {
                if ($realEstate->photos) {
                    $realEstate->photos->delete();
                }

                $realEstate->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
            }
        } elseif ($realEstate->photos) {
            $realEstate->photos->delete();
        }

        return (new RealEstateResource($realEstate))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RealEstate $realEstate)
    {
        abort_if(Gate::denies('real_estate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstate->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
