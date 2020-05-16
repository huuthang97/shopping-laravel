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
        return view('admin.setting.index');
    }

    public function create() {
        return view('admin.setting.add');
    }

    public function store(SettingAddRequest $request) {
        $dataInsert = [
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type' => $request->type,
        ];
        $this->setting->create($dataInsert);
        return redirect()->route('settings.index');
    }

    public function edit($id) {

    }

    public function update($id) {

    }

    public function delete($id) {

    }
    
}
