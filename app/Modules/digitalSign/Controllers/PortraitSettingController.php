<?php

namespace App\Modules\digitalSign\Controllers;

use App\Modules\digitalSign\Models\PortraitData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use MyUnnes\Base\Controllers\BaseController;
use App\Modules\digitalSign\Models\PortraitSetting;


class PortraitSettingController extends BaseController
{
    protected $model;
    protected $title = 'Portrait Setting';
    protected $base_route = 'portrait_setting';
    protected $default_view = 'digitalSign::portrait_setting.index';

    public function __construct()
    {
        $this->model = new PortraitSetting();

        $this->breadcrumbs = [
            'Dashboard' => route(config('myunnes.dashboard_route')),
            $this->title => '',
        ];
    }

    public function index()
    {
        $templatePath = base_path('app/Modules/digitalSign/Views/digital_sign/template/');

        $templates = [];
        foreach (glob($templatePath . '*.blade.php') as $file) {
            $filename = basename($file, '.blade.php');
            $templates[$filename] = $filename;
        }

        $data = [
            'title'       => $this->title,
            'subtitle'    => $this->subtitle,
            'breadcrumbs' => $this->breadcrumbs,
            'base_route'  => $this->base_route,
            'setting'     => $this->model->first(),
            'template_options' => $templates,
        ];

        return view($this->default_view, $data);
    }

    public function update(Request $req)
    {
        $req->validate([
            'nama_template' => 'required|string|max:255',
        ]);

        $setting = $this->model->first();

        if (!$setting) {
            $setting = new PortraitSetting();
            $setting->id = Str::uuid();
            $setting->created_by = Auth::user()->id_user;
        }

        // create version with hashing of 50 characters that will change every time updated and doesnt same as before
        $setting->version = Str::random(50);
        $setting->nama_template = $req->input('nama_template');
        $setting->updated_by = Auth::user()->id_user;
        $setting->save();

        return redirect()->route($this->base_route . '.read')
            ->with('alert', ['success', __('Base::alert.update_success_txt')]);
    }

    public function preview($template)
    {
        // Mengambil data slide aktif
        $slides = PortraitData::where('is_aktif', true)->get();

        // Mengambil template yang aktif
        // Amankan nama template: hanya huruf, angka, underscore
        if (!preg_match('/^[\w\-]+$/', $template)) {
            abort(404);
        }

        // Periksa apakah file template benar-benar ada
        $templatePath = base_path("app/Modules/digitalSign/Views/digital_sign/template/{$template}.blade.php");
        if (!file_exists($templatePath)) {
            abort(404, 'Template not found');
        }

        // Menentukan nama file Blade berdasarkan template
        $templateName = $template ? $template : 'default';

        return view("digitalSign::digital_sign.template.$templateName", compact('slides'));
    }
}
