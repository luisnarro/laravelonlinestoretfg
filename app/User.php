<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'twitter_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function addNew($input)
    {
        $check = static::where('email',$input['email'])->first();

        if(is_null($check)){
            return static::create($input);
        }else{

            DB::table('users')->where('email', $input['email'])->update(['twitter_id' => $input['twitter_id']]);
        }

        return $check;
    }

    /*
    public function discs()
    {
        return $this->hasMany(Disc::class);
    }
    */
}