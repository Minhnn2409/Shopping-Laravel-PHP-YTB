<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Traits\DeleteTrait;

class SettingController extends Controller
{
    use DeleteTrait;
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        $settings = $this->setting->paginate(5);
        return view('admin.setting.index', compact('settings'));
    }

    public function add()
    {
        return view('admin.setting.add');
    }

    public function create(SettingRequest $request)
    {
        $this->setting->create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type' => $request->type
        ]);
        return redirect()->route('setting.index');
    }

    public function edit($id)
    {
        $setting = $this->setting->find($id);
        return view('admin.setting.edit', compact('setting'));
    }

    public function update($id, SettingRequest $request)
    {
        $this->setting->find($id)->update([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value
        ]);
        return redirect()->route('setting.index');
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($this->setting, $id);
    }
}
