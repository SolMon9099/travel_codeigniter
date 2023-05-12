<?php

namespace App\Models;

use CodeIgniter\Model;

class Car_Pricing extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'car_pricing';
	protected $primaryKey           = 'car_pricing_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
	    "car_id",
	    "start_date",
	    "end_date",
	    "price",
		"created_at",
		"deleted_at"
	];
}
