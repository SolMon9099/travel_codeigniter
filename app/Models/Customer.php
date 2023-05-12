<?php

namespace App\Models;

use CodeIgniter\Model;

class Customer extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'customer';
	protected $primaryKey           = 'customer_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
	    "name",
	    "phone",
	    "email",
		"password",
		"created_at",
		"deleted_at"
	];
}
