<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'first_name',
		'last_name',
		'address',
		'email',
		'upload_id'
	];
	public function scopeFirstName($query,$param)
    {
        if ($param) {
           return $query->where('first_name','LIKE','%'.$param.'%');
        }
        return $query;
	}
	public function scopeLastName($query,$param)
    {
        if ($param) {
           return $query->where('last_name',$param);
        }
        return $query;
	}
	public function scopeEmail($query,$param)
    {
        if ($param) {
           return $query->where('email',$param);
        }
        return $query;
	}
	public function scopeAddress($query,$param)
    {
        if ($param) {
           return $query->where('address',$param);
        }
        return $query;
	}
	// ->orderBy('name', 'desc')
	public function scopeOrder($query,$colunm, $dir)
	{
		switch ($colunm) {
			case 0:
				$query->orderBy('first_name', $dir);
			break;
			case 1:
				$query->orderBy('last_name', $dir);
			break;
			case 2:
				$query->orderBy('email', $dir);
			break;
			case 3:
				$query->orderBy('address', $dir);
			break;
			default:
				$query->orderBy('address', 'asc');
			break;
		}
	}
}
