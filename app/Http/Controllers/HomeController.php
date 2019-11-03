<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
	public function dataTable()
	{
		// $data = User::all();
		return view('welcome');
	}
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
	}
	public function getData(Request $request)
	{
		if($request->wantsJson()){
			$reqparam = $request->all();
			$count = User::count();
			$reqparam['length'] = ($reqparam['length'] > 0)?$reqparam['length']:$count;
			$usermodel = new User();
			$filtercount = $usermodel
			->FirstName($reqparam['columns'][0]['search']['value'])
			->LastName($reqparam['columns'][1]['search']['value'])
			->Email($reqparam['columns'][2]['search']['value'])
			->Address($reqparam['columns'][3]['search']['value'])
			->Order($reqparam['order'][0]['column'],$reqparam['order'][0]['dir'])
			->get(['first_name','last_name','email','address'])->toArray();
			$data = $usermodel
			->FirstName($reqparam['columns'][0]['search']['value'])
			->LastName($reqparam['columns'][1]['search']['value'])
			->Email($reqparam['columns'][2]['search']['value'])
			->Address($reqparam['columns'][3]['search']['value'])
			->Order($reqparam['order'][0]['column'],$reqparam['order'][0]['dir'])
			->offset($reqparam['start'])
			->limit($reqparam['length'])
			->get(['first_name','last_name','email','address'])->toArray();
			return response()->json([
				'data'=>$data,
				"recordsTotal"=> $count,
				"recordsFiltered"=> count($filtercount),
			]);
		}
	}
}
