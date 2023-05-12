<?php

namespace App\Models;

use CodeIgniter\Model;

class Package extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'package';
	protected $primaryKey           = 'package_id';
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
		"created_at",
		"deleted_at"
	];
}
