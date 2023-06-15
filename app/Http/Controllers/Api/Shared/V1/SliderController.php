<?php

namespace App\Http\Controllers\Api\Shared\V1;

use App\Domains\Adds\v1\Services\SliderService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Shared\SliderResource;
use Illuminate\Http\Request;


class SliderController extends ApiController
{
    private SliderService $sliderService;

    public function __construct(
        SliderService $sliderService,
    )
    {
        $this->sliderService = $sliderService;
    }
    public function index(Request $request)
    {
        $page_size = $request->page_size ?? 10;

        $sliders = $this
            ->sliderService
            ->with(['translation'])
            ->search($request)
            ->paginate_simple($page_size);

        $data= SliderResource::collection($sliders)->resource->toArray();
        $data_array=['sliders'=>$data['data']];
        unset($data['data']);
        return $this->successShowPaginationResponse($data_array,$data, 'slider_list');
    }
    public function show($slider_id)
    {
        $slider = $this->sliderService->find('id', $slider_id);
        if (!$slider) {
            return $this->failResourceNotFoundMessage('sliders_item');
        }
        $data = SliderResource::make($slider->load('translation'));
        return $this->successShowDataResponse($data, 'sliders_item');
    }


}
