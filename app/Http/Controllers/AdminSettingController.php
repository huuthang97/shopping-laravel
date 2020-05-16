<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SettingAddRequest;
use App\Setting;

class AdminSettingController extends Controller
{

    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index() {
        $settings = $this->setting->latest()->paginate(5);
        return view('admin.setting.index', compact('settings'));
    }

    public function create() {
        return view('admin.setting.add');
    }

    public function store(SettingAddRequest $request) {
        try {
            $dataInsert = [
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
                'type' => $request->type,
            ];
            $this->setting->create($dataInsert);
            return redirect()->route('settings.index');
        }
        catch (\Exception $e) {
            dd('Mesage: ' . $e->getMessage() . '  --File: ' . $e->getFile() . '  --Line: ' . $e->getLine());
        }
        
    }

    public function edit(Request $request, $id) {
        $setting = $this->setting->find($id);
        return view('admin.setting.edit', compact('setting'));
        
    }

    public function update(SettingAddRequest $request, $id) {
        try {
            $dataUpdate = [
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
            ];
            $this->setting->find($id)->update($dataUpdate);
            return redirect()->route('settings.index');
        }
        catch (\Exception $e) {
            dd('Mesage: ' . $e->getMessage() . '  --File: ' . $e->getFile() . '  --Line: ' . $e->getLine());
        }
    }

    public function delete($id) {

    }
    
}
