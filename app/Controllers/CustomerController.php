<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Customer;

class CustomerController extends BaseController
{
    public function __construct() {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $this->datetime = date("Y-m-d H:i:s");
        $this->date = date("Y-m-d");
        $this->db = \Config\Database::connect();
        
        $this->customerModel = new Customer();
    }
    
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Customer List']),
			'page_title' => view('partials/page-title', ['title' => 'Customer List', 'li_1' => 'Dashboard', 'li_2' => 'Customer List']),
			'customers' => $this->customerModel->orderBy("customer_id", "DESC")->findAll(),
		];
		return view('customers/index', $data);
	}

	public function add_form()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Add New Customer']),
			'page_title' => view('partials/page-title', ['title' => 'Add New Customer', 'li_1' => 'Dashboard', 'li_2' => 'Customer List', 'li_3' => 'Add New Customer'])
		];

		return view('customers/add-form', $data);
	}

	public function save_add()
	{
		$data = [
		    'email' => $_POST['email'] ?? "",
		    'password' => $_POST['password'] ?? "",
		    'name' => $_POST['name'] ?? "",
		    'phone' => $_POST['phone'] ?? "",
		    'created_at' => $this->datetime,
		];

		$this->customerModel->save($data);

		return redirect('customer')->with('status', 'Customer inserted Successfully');
	}

	public function update_form($customer_id = null)
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Update Customer']),
			'page_title' => view('partials/page-title', ['title' => 'Update Customer', 'li_1' => 'Dashboard', 'li_2' => 'Customer List', 'li_3' => 'Update Customer']),
			'customer' => $this->customerModel->find($customer_id)
		];

		return view('customers/edit-form', $data);
	}

	public function save_update($customer_id = null)
	{
		$data = [
		    'email' => $_POST['email'] ?? "",
		    'password' => $_POST['password'] ?? "",
		    'name' => $_POST['name'],
		    'phone' => $_POST['phone'] ?? "",
		];
		$this->customerModel->update($customer_id, $data);

		return redirect('customer')->with('status', 'Customer updated Successfully');
	}

	public function delete_customer($customer_id = null)
	{
		$this->customerModel->delete($customer_id);

		return redirect('customer')->with('status', 'Customer deleted Successfully');
	}
}
