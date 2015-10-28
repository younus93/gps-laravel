<?php

namespace App\Http\Controllers;

use App\VehicleTableData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\IMEI_User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class FleetMasterController extends Controller
{

    protected $user;
    
    public function __construct()
    {
        $this->middleware('auth',['except'  => ['plot']]);
        $this->user = Auth::user();
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = $this->user->devices()->get();
        $details = new Collection();
        $client = new Client();
        foreach($devices as $i)
        {
            $latest_coordinates = DB::table($i['imei'])
                                            ->orderBy('id','desc')
                                            ->first();
            $response = $client->get(
                'http://nominatim.openstreetmap.org/reverse?'.
                'format=json'.
                '&lat='.$latest_coordinates->lat.
                '&lon='.$latest_coordinates->long.
                '&zoom=18'.
                '&addressdetails=0'
            );

            $location = (json_decode($response->getBody()->getContents())->display_name);

            $speed = $i['speed'];
            if($speed == null)
                $speed = 0;
            $details->push([
                'vehicleNumber'      =>  $i['vehicle_number'],
                'location'           =>  $location,
                'speed'              =>  $speed,
                'lat'                =>  $latest_coordinates->lat,
                'long'               =>  $latest_coordinates->long,
                'time'               =>  $latest_coordinates->server_time,
            ]);
        }
        return view('FleetMaster.index',compact('details'));
    }

    public function plot($vehicleNumber, $lat, $long, $speed, $location)
    {
        return view('FleetMaster.plot',compact('vehicleNumber','lat','long','speed','location'));
    }
 }
