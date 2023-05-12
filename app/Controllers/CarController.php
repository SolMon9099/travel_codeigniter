<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Car;
use App\Models\Car_Pricing;

class CarController extends BaseController
{
    public function __construct() {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $this->datetime = date("Y-m-d H:i:s");
        $this->date = date("Y-m-d");
        $this->db = \Config\Database::connect();
        
        $this->carModel = new Car();
        $this->carPricingModel = new Car_Pricing();
    }
    
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Car List']),
			'page_title' => view('partials/page-title', ['title' => 'Car List', 'li_1' => 'Dashboard', 'li_2' => 'Car List']),
			'cars' => $this->carModel->orderBy("car_id", "DESC")->findAll(),
		];
		return view('cars/index', $data);
	}

	public function add_form()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Add New Car']),
			'page_title' => view('partials/page-title', ['title' => 'Add New Car', 'li_1' => 'Dashboard', 'li_2' => 'Car List', 'li_3' => 'Add New Car'])
		];

		return view('cars/add-form', $data);
	}

	public function save_add()
	{
	    $created_at = $this->datetime;
	    $img        = $this->request->getFile('photo') ?? null;
	    $photo = "";
	    
        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            
            if ($img->move(ROOTPATH . 'public/uploads/cars', $newName)) {
                $photo = $newName;
            }
        }
	    
		$data = [
		    'photo' => $photo,
		    'name' => $_POST['name'] ?? "",
		    'description' => $_POST['description'] ?? "",
		    'license_plate' => $_POST['license_plate'] ?? "",
		    //'price' => $_POST['price'],
		    'status' => $_POST['status'],
		    'created_at' => $created_at,
		];

		$this->carModel->save($data);
		$car_id = $this->carModel->insertID();
		
		$price = $this->request->getVar('price') ?? [];
		$start_date = $this->request->getVar('start_date') ?? [];
		$end_date = $this->request->getVar('end_date') ?? [];
		
		for ($i = 0; $i < COUNT($price); $i++) {
		    $this->carPricingModel->save([
		        "car_id" => $car_id,
		        "price" => $price[$i] ?? 0,
		        "start_date" => $start_date[$i] ?? 0,
		        "end_date" => $end_date[$i] ?? 0,
		        "created_at" => $created_at,
		    ]);
		}

		return redirect('car')->with('status', 'Car inserted Successfully');
	}

	public function update_form($car_id = null)
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Update Car']),
			'page_title' => view('partials/page-title', ['title' => 'Update Car', 'li_1' => 'Dashboard', 'li_2' => 'Car List', 'li_3' => 'Update Car']),
			'car' => $this->carModel->find($car_id)
		];

		return view('cars/edit-form', $data);
	}

	public function save_update($car_id = null)
	{
	    $img        = $this->request->getFile('photo') ?? null;
	    $photo = "";
	    
        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            
            if ($img->move(ROOTPATH . 'public/uploads/cars', $newName)) {
                $photo = $newName;
            }
        }
	    
		$data = [
		    'name' => $_POST['name'] ?? "",
		    'description' => $_POST['description'] ?? "",
		    'license_plate' => $_POST['license_plate'] ?? "",
		    'price' => $_POST['price'],
		    'status' => $_POST['status'],
		];
		
		if ($photo != "") {
		    $data['photo'] = $photo;
		}
		
		$this->carModel->update($car_id, $data);

		return redirect('car')->with('status', 'Car updated Successfully');
	}

	public function delete_car($car_id = null)
	{
		$this->carModel->delete($car_id);

		return redirect('car')->with('status', 'Car deleted Successfully');
	}
	
	public function delete_car_photo($car_id = null)
	{
		$this->carModel->update($car_id, [
		    'photo' => null
		]);
		
		return redirect()->back()->with('status', 'Car photo deleted Successfully');
	}
}
