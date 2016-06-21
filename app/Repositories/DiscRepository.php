<?php

namespace App\Repositories;

use App\User;
use App\Disc;

class DiscRepository
{
	public function forUser(User $user)
	{
		return $user->discs()
					->orderBy('year', 'asc')
					->get();
	}
}