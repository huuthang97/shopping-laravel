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
        $sliders = $this->slider->latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
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

    public function edit($id) {
        $slider = $this->slider->find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderAddRequest $request, $id) {
        try {
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->des
            ];
            $fileUpload = $this->storageTraitUpload($request, 'photo', 'slider');
            if ( !empty($fileUpload ) ) {
                $dataUpdate['image_name'] = $fileUpload['file_name'];
                $dataUpdate['image_path'] = $fileUpload['path'];
            }
            $this->slider->find($id)->update($dataUpdate);
            return redirect()->route('sliders.index');
        }
        catch (\Exception $e) {
            dd('Mesage: '. $e->getMessage().' --File:  '.$e->getFile().'  --Line:   '. $e->getLine() );
        }
    }

    public function delete($id) {
        try {
            if ( $this->slider->find($id)->delete() ) {
                return response()->json([
                    'code' => 200,
                    'mesage' => 'success'
                ], 200);
            }
        }
        catch (\Exception $e) {
            dd('Mesage: '. $e->getMessage().' --File:  '.$e->getFile().'  --Line:   '. $e->getLine() );
        }
    }
    
}
