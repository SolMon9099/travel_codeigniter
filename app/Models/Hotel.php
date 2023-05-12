<?php

namespace App\Models;

use CodeIgniter\Model;

class Hotel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'hotel';
	protected $primaryKey           = 'hotel_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
	    "photo",
	    "name",
	    "description",
	    "price",
	    "address",
		"created_at",
		"deleted_at"
	];
}
