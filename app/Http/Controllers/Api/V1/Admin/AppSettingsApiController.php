<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppSettingRequest;
use App\Http\Requests\UpdateAppSettingRequest;
use App\Http\Resources\Admin\AppSettingResource;
use App\Models\AppSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppSettingsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('app_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppSettingResource(AppSetting::all());
    }

    public function store(StoreAppSettingRequest $request)
    {
        $appSetting = AppSetting::create($request->all());

        return (new AppSettingResource($appSetting))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AppSetting $appSetting)
    {
        abort_if(Gate::denies('app_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppSettingResource($appSetting);
    }

    public function update(UpdateAppSettingRequest $request, AppSetting $appSetting)
    {
        $appSetting->update($request->all());

        return (new AppSettingResource($appSetting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AppSetting $appSetting)
    {
        abort_if(Gate::denies('app_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appSetting->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
