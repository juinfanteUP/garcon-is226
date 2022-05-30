<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemUser extends Model
{
    protected $table = 'SystemUser';
	protected $primaryKey = 'id';
	public $timestamps = false;
}
