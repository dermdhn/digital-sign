<?php

namespace App\Modules\digitalSign\Controllers;

use MyUnnes\Base\Controllers\BaseController;
use App\Modules\digitalSign\Models\PortraitMedia;


class PortraitMediaController extends BaseController
{
    protected $title = 'Portrait Media';
    protected $subtitle = 'Manajemen data Portrait Media';
    protected $base_route = 'portrait_media';
    protected $dt_order = ['created_at', 'ASC'];
    protected $add_header_left = '';
    protected $add_header_right = '';
    protected $use_pagination = true;
    protected $pagination_limit = 25;
    protected $boolean_column = [];
    protected $boolean_key = '';
    protected $currency_column = [];
    protected $code_column = [];
    protected $use_datatable = false;
    protected $add_action = [];
    protected $use_filter = false;
    protected $form_filter = [];
    protected $data = [];

    public function __construct()
    {
        $this->add_header_right = '';
        $this->table_columns = [
			'nama' => 'Nama',
			'media' => 'Media',
			'media_type' => 'Media Type',
			'durasi' => 'Durasi',
			'is_aktif' => 'Is Aktif',
			'urutan' => 'Urutan',
			
        ];

        parent::__construct();
        $this->model = new PortraitMedia;

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
						['Form', 'text'],
						['media', NULL, ['class' => 'form-control ', 'id' => 'media', 'placeholder' => 'ex: isikan data di sini']]
					]
				],
				'media_type' => [
					'Media Type',
					[
						['Form', 'text'],
						['media_type', NULL, ['class' => 'form-control ', 'id' => 'media_type', 'placeholder' => 'ex: isikan data di sini']]
					]
				],
				'durasi' => [
					'Durasi',
					[
						['Form', 'number'],
						['durasi', NULL, ['class' => 'form-control ', 'id' => 'durasi', 'placeholder' => 'ex: isikan data di sini']]
					]
				],
				'is_aktif' => [
					'Is Aktif',
					[
						['Form', 'text'],
						['is_aktif', NULL, ['class' => 'form-control ', 'id' => 'is_aktif', 'placeholder' => 'ex: isikan data di sini']]
					]
				],
				'urutan' => [
					'Urutan',
					[
						['Form', 'number'],
						['urutan', NULL, ['class' => 'form-control ', 'id' => 'urutan', 'placeholder' => 'ex: isikan data di sini']]
					]
				],
				
        ];

        $this->form_filter = [];
    }
}
