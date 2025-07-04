<?php

namespace App\Modules\digitalSign\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use MyUnnes\Base\Libs\BApp;
use MyUnnes\Base\Helpers\Helper as Help;
use MyUnnes\Base\Services\Crud;
use Illuminate\Pagination\Paginator;
use MyUnnes\Base\Controllers\BaseController;
use App\Modules\digitalSign\Models\PortraitMedia;
use App\Modules\digitalSign\Models\PortraitSetting;
use Exception;

class PortraitMediaController extends BaseController
{
    // Model database
    protected $model;
    protected $title = 'Portrait Media'; // Judul Halaman
    protected $subtitle = 'Manajemen data Portrait Media'; // Subtitle Halaman
    protected $breadcrumbs = [];
    protected $add_title = ''; // Title tambahan jika diperlukan ex. terdapat referensi {(User: <code>$nm_user</code>)}
    protected $base_route = 'portrait_media'; // Base route name untuk CRUD {sys_user_role}
    protected $route_params = [];
    protected $dt_order = ['created_at', 'ASC'];
    protected $use_validate = false; // Jika memerlukan validasi data
    protected $form = [];
    protected $data_method = [];
    protected $add_header_left = ''; // menambah object/komponen di sebelah kiri tombol data (1 komponen bareng dengan filter)
    protected $add_header_right = ''; // Untuk menambah object di sebelah tombol tambah data
    protected $use_pagination = true; // Gunakan Pagination
    protected $pagination_limit = 25; // Limit pagination
    protected $boolean_column = []; // Menampilkan Ya/Tidak | Aktif/Tidak Aktif, dst.. untuk boolean value
    protected $boolean_key = 'ya_tidak'; // Key boolean yg digunakan --> config(Base.str_boolean)
    protected $currency_column = [];
    protected $code_column = [];
    protected $queue_column = NULL;
    protected $date_column = [];
    protected $datetime_column = [];
    protected $use_datatable = false;
    protected $default_view = 'digitalSign::portrait_media.index';
    protected $default_form = 'digitalSign::portrait_media.form';
    protected $use_filter = false;
    protected $form_filter = [
        // {Nama Kolom}  => [0 => {filter_method => '=' || 'like' || '<' || '>' dsb}, 1 => { STRING || Object Form Collective dengen format `forward_static_call_array` => [ [Form, formType], [params] ] }]
    ]; #
    protected $filters = [];
    protected $add_action = NULL; # berisi array action [ [0 => route_name, 1 => route_params ['key_route', 'nm_field'], 2 => btn_title, 3 => add_class, 4 => btn_icon] ]
    protected $data = [];
    protected $q = NULL;
    protected $help;
    protected $app;
    protected $table_columns = [
        'nama' => 'Nama',
        'media' => 'Media',
        'media_type' => 'Media Type',
        'durasi' => 'Durasi',
        'urutan' => 'Urutan',
        'is_aktif' => 'Is Aktif',
    ];

    public function __construct()
    {
        $this->model = new PortraitMedia;

        if (sizeof($this->breadcrumbs) == 0) {
            $this->breadcrumbs = [
                'Dashboard' => route(config('myunnes.dashboard_route'))
            ];
        }

        $this->help = (new Help);
        $this->app = (new BApp);

        $this->use_filter = true;
        $this->form_filter = [
            'nama' => [
                0 => 'like',
                1 => [
                    'Nama',
                    [
                        ['Form', 'text'],
                        ['nama', NULL, ['class' => 'form-control', 'id' => 'nama', 'placeholder' => 'Cari nama...']]
                    ]
                ]
            ]
        ];

        $this->form = [
            'nama' => [
                'Nama',
                [
                    ['Form', 'text'],
                    ['nama', NULL, ['class' => 'form-control ', 'id' => 'nama', 'placeholder' => 'ex: isikan data di sini']]
                ]
            ],
            'media' => [
                'Media',
                [
                    ['Form', 'file'],
                    ['media', NULL, ['id' => 'media', 'class' => 'form-control', 'accept' => 'image/*,video/*']]
                ]
            ],

            'durasi' => [
                'Durasi (detik)',
                [
                    ['Form', 'number'],
                    ['durasi', NULL, ['id' => 'durasi', 'class' => 'form-control', 'placeholder' => 'ex: 10']]
                ]
            ],

            // 'media_type' => [
            //     'Media Type',
            //     [
            //         ['Form', 'text'],
            //         ['media_type', NULL, ['class' => 'form-control ', 'id' => 'media_type', 'placeholder' => 'ex: isikan data di sini']]
            //     ]
            // ],
            'urutan' => [
                'Urutan',
                [
                    ['Form', 'number'],
                    ['urutan', NULL, ['class' => 'form-control ', 'id' => 'urutan', 'placeholder' => 'ex: isikan data di sini']]
                ]
            ],
            'is_aktif' => [
                'Tampilkan?',
                [
                    ['Form', 'select'],
                    ['is_aktif', ['1' => 'Ya', '0' => 'Tidak'], null, ['class' => 'form-select', 'id' => 'is_aktif']]
                ]
            ]
        ];

        // Hanya dimasukkan data yang akan digunakan di semua view
        $dt_to_view = ['title', 'subtitle', 'breadcrumbs', 'add_title', 'base_route', 'route_params', 'add_header_right', 'add_header_left', 'boolean_column', 'boolean_key', 'currency_column', 'code_column', 'pagination_limit', 'use_pagination', 'use_datatable', 'add_action', 'app', 'help', 'use_filter', 'form_filter', 'filters', 'queue_column', 'date_column', 'datetime_column'];

        foreach ($dt_to_view as $v) {
            $this->data[$v] = $this->{$v};
        }
    }

    /**
     * Index / tampil data
     *
     * @return view
     */
    public function index()
    {
        // default data
        $data = $this->data;
        // tambahan data yang digunakan di view
        $data['table_columns'] = $this->table_columns;
        $data['use_validate'] = $this->use_validate;
        $data['model'] = $this->model;

        if (!isset($this->q)) {
            $this->q = $this->model->query();
        }
        $data['filters'] = [];
        if ($this->use_filter && sizeof($this->form_filter) > 0) {
            $data['filters'] = session('filter-' . $this->base_route);
            $data['form_filter'] = $this->form_filter;
        }

        // main data
        if (is_array($this->data_method) && sizeof($this->data_method) == 2) {
            $data['data'] = call_user_func_array(array($this->model, $this->data_method[0]), $this->data_method[1]);
        } else {
            if ($this->use_filter) {
                foreach ($this->form_filter as $kF => $f) {
                    if (isset($data['filters'][$kF])) {
                        $ff = $data['filters'][$kF];
                        if ($f[0] == 'like')
                            $ff = '%' . $data['filters'][$kF] . '%';
                        $this->q->where($kF, $f[0], $ff);
                    }
                }
            }

            if (is_string(@$this->dt_order[0])) {
                $q = $this->q->orderBy($this->dt_order[0], $this->dt_order[1]);
            } else {
                $q = $this->q;
                foreach ($this->dt_order as $o) {
                    $q->orderBy($o[0], $o[1]);
                }
            }

            if ($this->use_pagination) {
                if (session('firstPage')) {
                    $current_page = 1;
                } elseif (request()->get('page') && request()->get('page') > 0) {
                    $current_page = request()->get('page');
                } else {
                    $current_page = (int) session('last-page-' . $this->base_route) ?? 1;
                }
                session()->put('last-page-' . $this->base_route, $current_page);
                Paginator::currentPageResolver(function () use ($current_page) {
                    return $current_page;
                });
                $data['data'] = $q->paginate($this->pagination_limit);
            } else {
                $data['data'] = $q->get();
            }
        }
        return view($this->default_view, $data);
    }

    /**
     * Filter data
     *
     * @param Request $req
     * @return redirect
     */
    public function filter(Request $req)
    {
        $dt = [];
        foreach ($this->form_filter as $kf => $vf) {
            if ($req->has($kf) && $req->input($kf) != '') {
                $dt[$kf] = $req->input($kf);
            }
        }
        session()->put('filter-' . $this->base_route, $dt);
        return redirect()->back()->with(['firstPage' => 1]);
    }

    /**
     * Form Create
     *
     * @return view
     */
    public function create()
    {
        // default data
        $data = $this->data;
        // tambahan data yang digunakan di view
        $data['model'] = $this->model;
        $data['form'] = $this->form;
        $data['form_route'] = [$data['base_route'] . '.store', $data['route_params']];
        $data['data'] = [];
        return view($this->default_form, $data);
    }

    /**
     * Create Data
     *
     * @param Request $req
     * @return redirect
     */
    public function store(Request $req)
    {
        if ($req->hasFile('media')) {
            $file = $req->file('media');
            $mime = $file->getMimeType();
            $type = explode('/', $mime)[0]; // image atau video

            $filename = 'media_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/portrait_media', $filename);

            $req->merge([
                'media' => 'portrait_media/' . $filename,
                'media_type' => $type
            ]);

            // Jika media adalah video dan durasi belum diisi
            if ($type === 'video' && !$req->filled('durasi')) {
                $durasi = $this->getVideoDuration('portrait_media/' . $filename);
                $req->merge(['durasi' => $durasi]);
            }

            // Jika bukan video, biarkan durasi bisa diisi manual atau dikosongkan
            if ($type !== 'image' && !$req->filled('durasi')) {
                $req->merge(['durasi' => null]);
            }
        }

        // update portraitdata setting version
        $portraitSetting = PortraitSetting::first();
        if ($portraitSetting) {
            $portraitSetting->version = Str::random(50); // generate
            $portraitSetting->save();
        } else {
            // Jika tidak ada setting, buat baru
            $portraitSetting = new PortraitSetting();
            $portraitSetting->version = Str::random(50);
            $portraitSetting->save();
        }

        $dt = (new Crud)->saveData($req, $this->model, $this->except_save, $this->title, $this->currency_column);

        return redirect(route($this->base_route . '.read', $this->route_params))
            ->with('alert', ['success', trans('Base::alert.create_success_txt')]);
    }

    /**
     * Form Edit Data
     *
     * @param string $id
     * @return view
     */
    public function edit($id)
    {
        // default data
        $data = $this->data;
        // tambahan data yang digunakan di view
        $data['model'] = $this->model;
        $data['form'] = $this->form;
        $data['form_route'] = [$data['base_route'] . '.update', $data['route_params']];
        $data['data'] = $this->model->findOrFail($id);
        return view($this->default_form, $data);
    }

    /**
     * Update Data
     *
     * @param Request $req
     * @return redirect
     */
    public function update(Request $req)
    {
        $data = $this->model->findOrFail($req->id);
        $media_lama = $data->media;
        $media_type = $data->media_type;

        if ($req->hasFile('media')) {
            $file = $req->file('media');
            $mime = $file->getMimeType();
            $type = explode('/', $mime)[0];
            $filename = 'media_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/portrait_media', $filename);

            if ($media_lama && Storage::exists('public/' . $media_lama)) {
                Storage::delete('public/' . $media_lama);
            }

            $req->merge([
                'media' => 'portrait_media/' . $filename,
                'media_type' => $type
            ]);

            if ($type === 'video' && !$req->filled('durasi')) {
                $durasi = $this->getVideoDuration('portrait_media/' . $filename);
                $req->merge(['durasi' => $durasi]);
            }

            if ($type !== 'image' && !$req->filled('durasi')) {
                $req->merge(['durasi' => null]);
            }
        } else {
            $req->merge([
                'media' => $media_lama,
                'media_type' => $media_type
            ]);

            if ($media_type === 'video' && !$req->filled('durasi')) {
                $durasi = $this->getVideoDuration($media_lama);
                $req->merge(['durasi' => $durasi]);
            }

            if ($media_type !== 'image' && !$req->filled('durasi')) {
                $req->merge(['durasi' => null]);
            }
        }

        // update portraitdata setting version
        $portraitSetting = PortraitSetting::first();
        if ($portraitSetting) {
            $portraitSetting->version = Str::random(50); // generate
            $portraitSetting->save();
        } else {
            // Jika tidak ada setting, buat baru
            $portraitSetting = new PortraitSetting();
            $portraitSetting->version = Str::random(50);
            $portraitSetting->save();
        }

        $dt = (new Crud)->saveData($req, $this->model, $this->except_save, $this->title, $this->currency_column);

        return redirect(route($this->base_route . '.read', $this->route_params))
            ->with('alert', ['success', trans('Base::alert.update_success_txt')]);
    }

    /**
     * Delete Data
     *
     * @param string $id
     * @return redirect
     */
    public function delete($id)
    {
        $dt = $this->model->findOrFail($id);

        // Hapus file media jika ada
        if ($dt->media && Storage::exists('public/' . $dt->media)) {
            Storage::delete('public/' . $dt->media);
        }

        // Logging
        $this->app->log(
            'Menghapus data ' . $this->title . '. id=' . $dt->{$this->model->getKeyName()} . '.',
            $dt->getAttributes()
        );

        // Soft delete data
        $dt->deleted_by = Auth::user()->id_user;

        // update portraitdata setting version
        $portraitSetting = PortraitSetting::first();
        if ($portraitSetting) {
            $portraitSetting->version = Str::random(50); // generate
            $portraitSetting->save();
        } else {
            // Jika tidak ada setting, buat baru
            $portraitSetting = new PortraitSetting();
            $portraitSetting->version = Str::random(50);
            $portraitSetting->save();
        }

        $dt->save();
        $dt->delete();

        return redirect()->back()->with('alert', ['success', trans('Base::alert.delete_success_txt')]);
    }


    private function getVideoDuration($path)
    {
        try {
            $fullPath = storage_path('app/public/' . $path);
            $cmd = "ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 \"$fullPath\"";
            $duration = shell_exec($cmd);
            return (int) round((float) $duration);
        } catch (Exception $e) {
            logger()->error('Gagal membaca durasi video: ' . $e->getMessage());
            return null;
        }
    }
}
