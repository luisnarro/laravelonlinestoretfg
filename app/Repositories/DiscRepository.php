<?php

namespace App\Repositories;

use App\User;
use App\Disc;
use DB;

class DiscRepository
{
	/*
	public function forUser(User $user)
	{
		return $user->discs()
					->orderBy('year', 'asc')
					->get();
	}
	*/

	public function lastAdded()
	{
		$discs = DB::table('discs')->get();

		return $discs;
	}
}