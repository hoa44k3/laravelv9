<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {

        $config = $this->config();
        return view(
            'backend.dashboard.index',
            compact('config')
        );
    }
    private function config()
    {
        return [
            'js' => [
                'assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js',
                'assets/js/plugin/chart.js/chart.min.js',
                'assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js',
                'assets/js/plugin/chart-circle/circles.min.js',
                'assets/js/plugin/datatables/datatables.min.js',
                'assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js',
                'assets/js/plugin/jsvectormap/jsvectormap.min.js',
                'assets/js/plugin/jsvectormap/world.js',
                'assets/js/plugin/sweetalert/sweetalert.min.js',
                'assets/js/kaiadmin.min.js',
                'assets/js/setting-demo.js',
                'assets/js/demo.js'
            ]

        ];
    }
}

?>