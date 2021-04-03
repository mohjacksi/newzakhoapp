<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\Admin\ServiceResource;
use App\Models\Service;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServicesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServiceResource(Service::all());
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->all());

        if ($request->input('icon', false)) {
            $service->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($request->input('photos', false)) {
            $service->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
        }

        return (new ServiceResource($service))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Service $service)
    {
        abort_if(Gate::denies('service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServiceResource($service);
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->all());

        if ($request->input('icon', false)) {
            if (!$service->icon || $request->input('icon') !== $service->icon->file_name) {
                if ($service->icon) {
                    $service->icon->delete();
                }

                $service->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($service->icon) {
            $service->icon->delete();
        }

        if ($request->input('photos', false)) {
            if (!$service->photos || $request->input('photos') !== $service->photos->file_name) {
                if ($service->photos) {
                    $service->photos->delete();
                }

                $service->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
            }
        } elseif ($service->photos) {
            $service->photos->delete();
        }

        return (new ServiceResource($service))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Service $service)
    {
        abort_if(Gate::denies('service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
