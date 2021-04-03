<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppSettingRequest;
use App\Http\Requests\StoreAppSettingRequest;
use App\Http\Requests\UpdateAppSettingRequest;
use App\Models\AppSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppSettingsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('app_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AppSetting::query()->select(sprintf('%s.*', (new AppSetting)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'app_setting_show';
                $editGate      = 'app_setting_edit';
                $deleteGate    = 'app_setting_delete';
                $crudRoutePart = 'app-settings';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('key', function ($row) {
                return $row->key ? $row->key : "";
            });
            $table->editColumn('value_english', function ($row) {
                return $row->value_english ? $row->value_english : "";
            });
            $table->editColumn('value_arabic', function ($row) {
                return $row->value_arabic ? $row->value_arabic : "";
            });
            $table->editColumn('value_kurdish', function ($row) {
                return $row->value_kurdish ? $row->value_kurdish : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.appSettings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('app_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appSettings.create');
    }

    public function store(StoreAppSettingRequest $request)
    {
        $appSetting = AppSetting::create($request->all());

        return redirect()->route('admin.app-settings.index');
    }

    public function edit(AppSetting $appSetting)
    {
        abort_if(Gate::denies('app_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appSettings.edit', compact('appSetting'));
    }

    public function update(UpdateAppSettingRequest $request, AppSetting $appSetting)
    {
        $appSetting->update($request->all());

        return redirect()->route('admin.app-settings.index');
    }

    public function show(AppSetting $appSetting)
    {
        abort_if(Gate::denies('app_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appSettings.show', compact('appSetting'));
    }

    public function destroy(AppSetting $appSetting)
    {
        abort_if(Gate::denies('app_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppSettingRequest $request)
    {
        AppSetting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
