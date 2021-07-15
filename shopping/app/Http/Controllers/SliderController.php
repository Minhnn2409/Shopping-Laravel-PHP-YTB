<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    use StoreImageTrait;

    public $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {
        $sliders = $this->slider->paginate(5);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function add()
    {
        return view('admin.sliders.add');
    }

    public function create(SliderRequest $request)
    {
        try {
            DB::beginTransaction();
            $sliderCreated = [
                'name' => $request->name,
                'description' => $request->description
            ];

            $sliderImageUpload = $this->StoreTraitUpload($request, 'image_path', 'slider');
            if (!empty($sliderImageUpload)) {
                $sliderCreated['image_name'] = $sliderImageUpload['file_name'];
                $sliderCreated['image_path'] = $sliderImageUpload['file_path'];
            }
            $this->slider->create($sliderCreated);
            DB::commit();
            return redirect()->route('slider.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '--Line: ' . $exception->getLine());
        }

    }

    public function edit($id)
    {
        $slider = $this->slider->find($id);
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update($id, SliderRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description
            ];
            $dataUpdateUpload = $this->StoreTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataUpdateUpload)) {
                $dataUpdate['image_name'] = $dataUpdateUpload['file_name'];
                $dataUpdate['image_path'] = $dataUpdateUpload['file_path'];
            }
            $this->slider->find($id)->update($dataUpdate);
            DB::commit();
            return redirect()->route('slider.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '--Line: ' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->slider->find($id)->delete();
            DB::commit();
            return redirect()->route('slider.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '--Line: ' . $exception->getLine());
        }
    }
}
