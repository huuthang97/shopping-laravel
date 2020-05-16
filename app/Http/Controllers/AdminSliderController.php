<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SliderAddRequest;
use App\Traits\StorageImageTrait;
use App\Slider;

class AdminSliderController extends Controller
{
    use StorageImageTrait;
    private $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    public function index() {
        return view('admin.slider.index');
    }
    public function create() {
        return view('admin.slider.add');
    }
    public function store(SliderAddRequest $request) {
        try {
            $dataInsert = [
                'name' => $request->name,
                'description' => $request->des
            ];
            $fileUpload = $this->storageTraitUpload($request, 'photo', 'slider');
            if ( !empty($fileUpload ) ) {
                $dataInsert['image_name'] = $fileUpload['file_name'];
                $dataInsert['image_path'] = $fileUpload['path'];
            }
            $this->slider->create($dataInsert);
            return redirect()->route('sliders.index');
        }
        catch (\Exception $e) {
            dd('Mesage: '. $e->getMessage().' --File:  '.$e->getFile().'  --Line:   '. $e->getLine() );
        }
    }
    public function edit() {

    }
}
