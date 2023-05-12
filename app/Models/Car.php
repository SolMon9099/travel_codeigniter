<?php

namespace App\Models;

use CodeIgniter\Model;

class Car extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'car';
	protected $primaryKey           = 'car_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
	    "photo",
	    "name",
	    "description",
	    "license_plate",
	    "price",
	    "status",
		"created_at",
		"deleted_at"
	];
}
