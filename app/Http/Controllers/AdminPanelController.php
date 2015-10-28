<?php

namespace App\Http\Controllers;

use App\IMEI_Recharge;
use App\IMEI_User;
use Faker\Provider\DateTime;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\User;
use yajra\Datatables\Datatables;

class AdminPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users      = User::all()->count();
        $devices    = IMEI_User::all()->count();
        return view('admin.index',compact('users','devices'));
    }

    /**
     * Display the registration page
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function registerUser()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addDeviceToUser(Request $request)
    {
        $rules = [
            'imei'              => 'required|unique:imei_user|size:16',
            'vehicle_number'    => 'required|unique:imei_user',
            'phone_number'      => 'required|unique:imei_user'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
            return redirect('/imei/add/'.$request->user_id)->withErrors($validator)->withInput();

        $imei = new IMEI_User();
        $imei->user_id = $request->user_id;
        $imei->imei = $request->imei;
        $imei->vehicle_number = $request->vehicle_number;
        $imei->phone_number   = $request->phone_number;

        if(Schema::create($imei->imei, function(Blueprint $table){
            $table->increments('id');
            $table->timestamp('created_at');
            $table->string('imei');
            $table->string('lat');
            $table->string('long');
            $table->string('speed');
            $table->string('course');
            $table->string('mcc');
            $table->string('mnc');
            $table->string('lac');
            $table->string('cell_id');
            $table->timestamp('server_time');
        }))
        {}

        if($imei->save()) {
            Session::flash('registerSuccess', $imei);
            return redirect('/users/viewuser/'.$imei->user_id);
        }

    }


    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' =>  'required|size:10|unique:users',
            'address'=> 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
            return redirect('/users/registeruser')->withErrors($validator)->withInput();
        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->password = bcrypt($request->phone);
        $user->address  = $request->address;
        if($user->save()) {
            Session::flash('registerSuccess', $user);
            return redirect('/users/registeruser');
        }

    }

    /**
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function viewUsers()
    {
        return view('users.viewUsers');
    }

    /**
     * @param $id
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function viewUser($id)
    {
        $user = User::findorFail($id);
        $devices = $user->devices()->get();
        return view('users.viewUserInfo',compact('user','devices'));
    }

    /**
     * @param null $id
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function editUser($id = null)
    {
        if($id == null)
            $id = auth()->user()->id;

        $user= User::findOrFail($id);
        $vs = $user->devices()->get();
        return view('users.editUser',compact('user','vs'));
    }


    /**
     * @param $id
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function showIMEI($id)
    {
        $user = User::findOrFail($id);
        return view('gps.addNewGPS',compact('user','devices'));
    }

    /**
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function viewGPS()
    {
        return view('gps.viewgps');
    }


    /**
     * @return mixed
     */
    public function getUsers()
    {
        $users = User::all();
        return Datatables::of($users)
            ->addColumn('action', function ($data) {
                return "<a class='btn btn-success' href='/users/viewuser/$data->id'>View</a>";
            })
            ->editColumn('created_at',function($data){
                return \Carbon\Carbon::createFromTimeStamp(strtotime($data->created_at))->diffForHumans();
            })
            ->removeColumn('type')
            ->removeColumn('updated_at')
            ->removeColumn('address')
            ->removeColumn('id')
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function getDevices()
    {
        $devices = IMEI_User::all();
        return Datatables::of($devices)
            ->addColumn('action', function ($data) {
                return "<a class='btn btn-success' href='/gps/viewgps/$data->id'>View</a>";
            })
            ->addColumn('user',function($data){
                return User::findOrFail($data->user_id)->name;
            })
            ->make(true);
    }

    /**
     * @param $id
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function viewGPSDevice($id)
    {
        $device = IMEI_User::findOrFail($id);
//        dd($device);
        $user = User::findOrFail($device->user_id)->name;
        $recharges = $device->recharges()->get();
//        dd($recharges);
        return view('gps.viewgpsinfo',compact('device','user','recharges'));
    }


    /**
     * POST method to add recharge date and information
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function rechargeGPS(Request $request)
    {
        $recharge = new IMEI_Recharge();
        $recharge->imei_id = $request['imei_id'];
        $recharge->recharge_method  = $request['recharge_method'];
        $recharge->transaction_id = $request['transaction_id'];

        ($recharge ->recharge_date = new \DateTime('now'));
//        dd($recharge);
        if($recharge->save())
        {
            Session::flash('rechargeSuccess','Recharge Information updated');
            return redirect('gps/viewgps/'.$request->imei_id);
        }
    }

}
