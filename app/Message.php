<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable=[
		'from', 'to', 'assunto', 'corpo', 'user_id', 'estado'

	];
}
