<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Hotel;
use App\Models\Hotel_Pricing;

class HotelController extends BaseController
{
    public function __construct() {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $this->datetime = date("Y-m-d H:i:s");
        $this->date = date("Y-m-d");
        $this->db = \Config\Database::connect();
        
        $this->hotelModel = new Hotel();
        $this->hotelPricingModel = new Hotel_Pricing();
    }
    
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Hotel List']),
			'page_title' => view('partials/page-title', ['title' => 'Hotel List', 'li_1' => 'Dashboard', 'li_2' => 'Hotel List']),
			'hotels' => $this->hotelModel->orderBy("hotel_id", "DESC")->findAll(),
		];
		return view('hotels/index', $data);
	}

	public function add_form()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Add New Hotel']),
			'page_title' => view('partials/page-title', ['title' => 'Add New Hotel', 'li_1' => 'Dashboard', 'li_2' => 'Hotel List', 'li_3' => 'Add New Hotel'])
		];

		return view('hotels/add-form', $data);
	}

	public function save_add()
	{
	    $created_at = $this->datetime;
	    $img        = $this->request->getFile('photo') ?? null;
	    $photo = "";
	    
        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            
            if ($img->move(ROOTPATH . 'public/uploads/hotels', $newName)) {
                $photo = $newName;
            }
        }
	    
		$data = [
		    'photo' => $photo,
		    'name' => $_POST['name'] ?? "",
		    'description' => $_POST['description'] ?? "",
		    //'price' => $_POST['price'],
		    'address' => $_POST['address'] ?? "",
		    'created_at' => $this->datetime,
		];

		$this->hotelModel->save($data);
		$hotel_id = $this->hotelModel->insertID();
		
		$price = $this->request->getVar('price') ?? [];
		$start_date = $this->request->getVar('start_date') ?? [];
		$end_date = $this->request->getVar('end_date') ?? [];
		
		for ($i = 0; $i < COUNT($price); $i++) {
		    $this->hotelPricingModel->save([
		        "hotel_id" => $hotel_id,
		        "price" => $price[$i] ?? 0,
		        "start_date" => $start_date[$i] ?? 0,
		        "end_date" => $end_date[$i] ?? 0,
		        "created_at" => $created_at,
		    ]);
		}

		return redirect('hotel')->with('status', 'Hotel inserted Successfully');
	}

	public function update_form($hotel_id = null)
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Update Hotel']),
			'page_title' => view('partials/page-title', ['title' => 'Update Hotel', 'li_1' => 'Dashboard', 'li_2' => 'Hotel List', 'li_3' => 'Update Hotel']),
			'hotel' => $this->hotelModel->find($hotel_id)
		];

		return view('hotels/edit-form', $data);
	}

	public function save_update($hotel_id = null)
	{
	    $img        = $this->request->getFile('photo') ?? null;
	    $photo = "";
	    
        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            
            if ($img->move(ROOTPATH . 'public/uploads/hotels', $newName)) {
                $photo = $newName;
            }
        }
	    
		$data = [
		    'name' => $_POST['name'] ?? "",
		    'description' => $_POST['description'] ?? "",
		    'price' => $_POST['price'],
		    'address' => $_POST['address'] ?? "",
		];
		
		if ($photo != "") {
		    $data['photo'] = $photo;
		}
		
		$this->hotelModel->update($hotel_id, $data);

		return redirect('hotel')->with('status', 'Hotel updated Successfully');
	}

	public function delete_hotel($hotel_id = null)
	{
		$this->hotelModel->delete($hotel_id);

		return redirect('hotel')->with('status', 'Hotel deleted Successfully');
	}
	
	public function delete_hotel_photo($hotel_id = null)
	{
		$this->hotelModel->update($hotel_id, [
		    'photo' => null
		]);
		
		return redirect()->back()->with('status', 'Hotel photo deleted Successfully');
	}
}
