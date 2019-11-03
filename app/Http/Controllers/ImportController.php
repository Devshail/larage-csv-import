<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;
use App\User;
use DB;
// use App\Events\Event;
use App\Events\FileUploaded;
use Log;

class ImportController extends Controller
{
	// retuen form for import csv file
    public function csvImport()
	{
		return view('csv-form');
	}
	public function saveAndUploadCSV(Request $request)
	{
		$this->validate($request,[
            'file' => 'required|max:2048',
		]);
		$file = $request->file('file');
		$input['filename'] = time().'_'.$file->getClientOriginalName();
		$destinationPath = public_path('/files/');
		// DB::beginTransaction();
		try{
			$file->move($destinationPath,$input['filename']);
			Log::info('=== Hello  ========');
			event(new FileUploaded($destinationPath.$input['filename'],$input['filename']));
			// $upload = Upload::create([
			// 	'filename'=>$input['filename'],
			// ]);
			// $data = array_map('str_getcsv', file($destinationPath.$input['filename']));
			// $newData = [];
			// for ($i = 1; $i< count($data); $i++) {
			// 	$newData[$i] = array(
			// 		'first_name'=>$data[$i][0],
			// 		'last_name'=>$data[$i][1],
			// 		'email'=>$data[$i][2],
			// 		'address'=>$data[$i][3],
			// 		'upload_id'=>$upload->id
			// 	);
			// }
			// User::insert($newData);
			// DB::commit();
			return redirect()->back()->with('success','File Imported');
		}catch(\Exception $e) {
			// DB::rollback();
			// unlink(public_path().'/files/' .$input['filename']);
			// dd($e);
			return back()->withError('Could not upload file');
		}
	}
}
