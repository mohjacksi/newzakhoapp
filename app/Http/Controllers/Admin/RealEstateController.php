<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRealEstateRequest;
use App\Http\Requests\StoreRealEstateRequest;
use App\Http\Requests\UpdateRealEstateRequest;
use App\Models\RealEstate;
use App\Models\RealEstateType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RealEstateController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('real_estate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RealEstate::with(['type'])->select(sprintf('%s.*', (new RealEstate)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'real_estate_show';
                $editGate      = 'real_estate_edit';
                $deleteGate    = 'real_estate_delete';
                $crudRoutePart = 'real-estates';

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
            $table->editColumn('title_english', function ($row) {
                return $row->title_english ? $row->title_english : "";
            });
            $table->editColumn('title_arabic', function ($row) {
                return $row->title_arabic ? $row->title_arabic : "";
            });
            $table->editColumn('title_kurdish', function ($row) {
                return $row->title_kurdish ? $row->title_kurdish : "";
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
            });
            $table->addColumn('type_name_english', function ($row) {
                return $row->type ? $row->type->name_english : '';
            });

            $table->editColumn('photos', function ($row) {
                if (!$row->photos) {
                    return '';
                }

                $links = [];

                foreach ($row->photos as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'type', 'photos']);

            return $table->make(true);
        }

        $real_estate_types = RealEstateType::get();

        return view('admin.realEstates.index', compact('real_estate_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('real_estate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = RealEstateType::all()->pluck('name_english', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.realEstates.create', compact('types'));
    }

    public function store(StoreRealEstateRequest $request)
    {
        $realEstate = RealEstate::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $realEstate->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $realEstate->id]);
        }

        return redirect()->route('admin.real-estates.index');
    }

    public function edit(RealEstate $realEstate)
    {
        abort_if(Gate::denies('real_estate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = RealEstateType::all()->pluck('name_english', 'id')->prepend(trans('global.pleaseSelect'), '');

        $realEstate->load('type');

        return view('admin.realEstates.edit', compact('types', 'realEstate'));
    }

    public function update(UpdateRealEstateRequest $request, RealEstate $realEstate)
    {
        $realEstate->update($request->all());

        if (count($realEstate->photos) > 0) {
            foreach ($realEstate->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }

        $media = $realEstate->photos->pluck('file_name')->toArray();

        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $realEstate->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.real-estates.index');
    }

    public function show(RealEstate $realEstate)
    {
        abort_if(Gate::denies('real_estate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstate->load('type');

        return view('admin.realEstates.show', compact('realEstate'));
    }

    public function destroy(RealEstate $realEstate)
    {
        abort_if(Gate::denies('real_estate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realEstate->delete();

        return back();
    }

    public function massDestroy(MassDestroyRealEstateRequest $request)
    {
        RealEstate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('real_estate_create') && Gate::denies('real_estate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new RealEstate();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
