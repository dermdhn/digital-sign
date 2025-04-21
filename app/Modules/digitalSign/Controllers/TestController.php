<?php
namespace App\Modules\digitalSign\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\digitalSign\Helpers\Test as Help;
use App\Modules\digitalSign\Libs\Test as Lib;
use App\Modules\digitalSign\Models\Test;
use App\Modules\digitalSign\Services\Test as ServicesTest;

class TestController extends Controller
{

    public function index()
    {
        $data = [];
        $data['config'] = config('digitalSign.test.test');
        $data['help'] = (new Help)->test();
        $data['lib'] = (new Lib)->test();
        $data['locale'] = trans('digitalSign::test.test');
        $data['model'] = Test::all();
        $data['services'] = (new ServicesTest)->test();
        return view("digitalSign::index", $data);
    }
}
