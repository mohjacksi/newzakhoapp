<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRealEstateTypeRequest;
use App\Http\Requests\StoreRealEstateTypeRequest;
use App\Http\Requests\UpdateRealEstateTypeRequest;
use App\Models\RealEstateType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RealEstateTypesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('real_estate_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RealEstateType::query()->select(sprintf('%s.*', (new RealEstateType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'real_estate_type_show';
                $editGate      = 'real_estate_type_edit';
                $deleteGate    = 'real_estate_type_delete';
                $crudRoutePart = 'real-estate-types';

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
            $table->editColumn('name_english', function ($row) {
                return $row->name_english ? $row->name_english : "";
            });
            $table->editColumn('name_arabic', function ($row) {
                return $row->name_arabic ? $row->name_arabic : "";
            });
            $table->editColumn('name_kurdish', function ($row) {
                return $row->name_kurdish ? $row->name_kurdish : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.realEstateTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('real_estate_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.realEstateTypes.create');
    }

    public function store(StoreRealEstateTypeRequest $request)
    {
        $realEstateType = RealEstateType::create($request->all());

        return redirect()->route('admin.real-estate-types.index');
    }

    public function edit(RealEstateType $realEstateType)
    {
        abort_if(Gate::denies('real_estate_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.realEstateTypes.edit', compact('realEstateType'));
    }

    public function update(UpdateRealEstateTypeRequest $request, RealEstateType $realEstateType)
    {
        $realEstateType->update($request->all());

        return redirect()->route('admin.real-estate-types.index');
    }

    public function show(RealEstateType $realEstateType)
    {
        abort_if(Gate::denies('real_estate_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstateType->load('typeRealEstates');

        return view('admin.realEstateTypes.show', compact('realEstateType'));
    }

    public function destroy(RealEstateType $realEstateType)
    {
        abort_if(Gate::denies('real_estate_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstateType->delete();

        return back();
    }

    public function massDestroy(MassDestroyRealEstateTypeRequest $request)
    {
        RealEstateType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
