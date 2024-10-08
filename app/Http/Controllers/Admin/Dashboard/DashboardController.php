<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Services\DashboardServices;
use App\Models\ {
    Permissions,
    User,
    RTI,
    VacanciesHeader,
    DepartmentInformation,
    DisasterForcast,
    Gallery,
    Video,
    Event,
    GramSevakTabletDistribution
};
use Validator;

class DashboardController extends Controller {
    /**
     * Topic constructor.
     */
    public function __construct()
    {
        // $this->service = new DashboardServices();
    }

    public function index()
    {
        $return_data = array();
        $dashboard_data = Permissions::where("is_active",'=',true)->get()->toArray();
        // dd($dashboard_data);
        foreach ($dashboard_data as $value) {

            if($value['url'] == 'list-users') {
                $data_dashboard['url'] =  $value['url'];
                $data_dashboard['permission_name'] =  $value['permission_name'];
                $users = User::where('id','<>',1)
                ->select('id')
				->get();
                $data_dashboard['count'] = $users->count();
                array_push($return_data, $data_dashboard);
            }

            if($value['url'] == 'list-gramsevak-tablet-distribution') {
                $data_dashboard['url'] =  $value['url'];
                $data_dashboard['permission_name'] =  $value['permission_name'];
                $beneficiary = GramSevakTabletDistribution::where('gram_sevak_tablet_distribution.is_active','1')
                ->select('gram_sevak_tablet_distribution.id')
				->get();
                $data_dashboard['count'] = $beneficiary->count();
                array_push($return_data, $data_dashboard);
            }

           
        }

        return view('admin.pages.dashboard',compact('return_data'));
    }



}