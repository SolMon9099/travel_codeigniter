<?php

namespace App\Models;

use CodeIgniter\Model;

class Staff extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'staff';
	protected $primaryKey           = 'staff_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
	    "name",
	    "phone",
	    "username",
		"password",
		"role",
		"created_at",
		"deleted_at"
	];
}
