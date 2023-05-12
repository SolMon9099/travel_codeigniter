<?php

namespace App\Models;

use CodeIgniter\Model;

class Hotel_Pricing extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'hotel_pricing';
	protected $primaryKey           = 'hotel_pricing_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
	    "hotel_id",
	    "start_date",
	    "end_date",
	    "price",
		"created_at",
		"deleted_at"
	];
}
