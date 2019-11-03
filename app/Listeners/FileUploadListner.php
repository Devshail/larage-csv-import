<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
use Exception;
use App\Upload;
use App\User;
use DB;

class FileUploadListner implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FileUploaded  $event
     * @return void
     */
    public function handle(FileUploaded $event)
    {
		DB::beginTransaction();
		try{
			$upload = Upload::create([
					'filename'=>$event->filename,
			]);
			$data = array_map('str_getcsv', file($event->filelocation));
			$newData = [];
			for ($i = 1; $i< count($data); $i++) {
				User::create(array(
					'first_name'=>$data[$i][0],
					'last_name'=>$data[$i][1],
					'email'=>$data[$i][2],
					'address'=>$data[$i][3],
					'upload_id'=>$upload->id
				));
				// $newData[$i] = array(
				// 	'first_name'=>$data[$i][0],
				// 	'last_name'=>$data[$i][1],
				// 	'email'=>$data[$i][2],
				// 	'address'=>$data[$i][3],
				// 	'upload_id'=>$upload->id
				// );
			}
			// User::insert($newData);
			DB::commit();
		}catch(\Exception $e){
			DB::rollback();
			unlink($event->filelocation);
			// dd($e->getMessage());
			Log::info($e->getMessage());
		}
		// DB::beginTransaction();
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
			// DB::rollback();
			// unlink(public_path().'/files/' .$input['filename']);
        Log::info($event->filelocation);
    }
}
