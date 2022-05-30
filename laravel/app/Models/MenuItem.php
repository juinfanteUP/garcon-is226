<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'MenuItem';
	protected $primaryKey = 'id';
	public $timestamps = false;
}
