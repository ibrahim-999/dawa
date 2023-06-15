<?php

namespace App\Http\Controllers\Web\Admin\v1;

use App\Domains\Adds\v1\Services\SliderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Adds\SliderStoreRequest;
use App\Http\Requests\Adds\SliderUpdateRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SliderController extends Controller
{

    private SliderService $sliderService;


    public function __construct(
        SliderService       $sliderService,

    )
    {
        $this->sliderService = $sliderService;

        $this->middleware('permission:create_sliders', ['only' => ['create', 'store']]);
        $this->middleware('permission:show_sliders', ['only' => ['show']]);
        $this->middleware('permission:update_sliders', ['only' =>  ['edit', 'update']]);
        $this->middleware('permission:index_sliders', ['only' => ['index']]);
        $this->middleware('permission:delete_sliders', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->per_page ?? 10;
        $sliders = $this->sliderService->with(['translation']);
        $sliders = $sliders->search($request)
            ->sort('id','DESC')
            ->paginate($itemsPerPage);
        return view('admin/v1/slider/index', compact('sliders'));
    }

    public function create()
    {
        return view('admin/v1/slider/create');
    }

    public function store(SliderStoreRequest $request)
    {
        $slider = $this->sliderService->add($request);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $slider->addMediaFromRequest('image')->toMediaCollection('image');
        }

        if ($slider) {
            return Redirect::route('sliders.index')->with('success', __('messages.slider_created_successfully'));
        } else {
            return Redirect::back();
        }

    }

    public function show(Slider $slider)
    {
        return view('admin/v1/slider/show', compact('slider'));
    }

    public function destroy(Slider $slider)
    {
        $deleted = $this->sliderService->delete($slider);
        if ($deleted) {
            return Redirect::route('sliders.index')->with('success', __('messages.slider_deleted_successfully'));
        } else {
            return Redirect::back();
        }
        return Redirect::route('sliders.index')->with('success', __('messages.brand_deleted_successfully'));
    }

    public function edit(Slider $slider)
    {
        return view('admin/v1/slider/edit', compact('slider'));
    }

    public function update(Slider $slider, SliderUpdateRequest $request)
    {
        $updated = $this->sliderService->setBuilder($slider)->update($request);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $slider->addMediaFromRequest('image')->toMediaCollection('image');
        }
        if ($updated) {
            return Redirect::route('sliders.index')->with('success', __('messages.slider_updated_successfully'));
        } else {
            return Redirect::back();
        }
    }

}
