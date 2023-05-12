<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Souvenir;

class SouvenirController extends BaseController
{
    public function __construct() {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $this->datetime = date("Y-m-d H:i:s");
        $this->date = date("Y-m-d");
        $this->db = \Config\Database::connect();
        
        $this->souvenirModel = new Souvenir();
    }
    
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Souvenir List']),
			'page_title' => view('partials/page-title', ['title' => 'Souvenir List', 'li_1' => 'Dashboard', 'li_2' => 'Souvenir List']),
			'souvenirs' => $this->souvenirModel->orderBy("souvenir_id", "DESC")->findAll(),
		];
		return view('souvenirs/index', $data);
	}

	public function add_form()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Add New Souvenir']),
			'page_title' => view('partials/page-title', ['title' => 'Add New Souvenir', 'li_1' => 'Dashboard', 'li_2' => 'Souvenir List', 'li_3' => 'Add New Souvenir'])
		];

		return view('souvenirs/add-form', $data);
	}

	public function save_add()
	{
	    $img        = $this->request->getFile('photo') ?? null;
	    $photo = "";
	    
        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            
            if ($img->move(ROOTPATH . 'public/uploads/souvenirs', $newName)) {
                $photo = $newName;
            }
        }
	    
		$data = [
		    'photo' => $photo,
		    'name' => $_POST['name'] ?? "",
		    'description' => $_POST['description'] ?? "",
		    'price' => $_POST['price'],
		    'created_at' => $this->datetime,
		];

		$this->souvenirModel->save($data);

		return redirect('souvenir')->with('status', 'Souvenir inserted Successfully');
	}

	public function update_form($souvenir_id = null)
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Update Souvenir']),
			'page_title' => view('partials/page-title', ['title' => 'Update Souvenir', 'li_1' => 'Dashboard', 'li_2' => 'Souvenir List', 'li_3' => 'Update Souvenir']),
			'souvenir' => $this->souvenirModel->find($souvenir_id)
		];

		return view('souvenirs/edit-form', $data);
	}

	public function save_update($souvenir_id = null)
	{
	    $img        = $this->request->getFile('photo') ?? null;
	    $photo = "";
	    
        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            
            if ($img->move(ROOTPATH . 'public/uploads/souvenirs', $newName)) {
                $photo = $newName;
            }
        }
	    
		$data = [
		    'name' => $_POST['name'] ?? "",
		    'description' => $_POST['description'] ?? "",
		    'price' => $_POST['price'],
		];
		
		if ($photo != "") {
		    $data['photo'] = $photo;
		}
		
		$this->souvenirModel->update($souvenir_id, $data);

		return redirect('souvenir')->with('status', 'Souvenir updated Successfully');
	}

	public function delete_souvenir($souvenir_id = null)
	{
		$this->souvenirModel->delete($souvenir_id);

		return redirect('souvenir')->with('status', 'Souvenir deleted Successfully');
	}
	
	public function delete_souvenir_photo($souvenir_id = null)
	{
		$this->souvenirModel->update($souvenir_id, [
		    'photo' => null
		]);
		
		return redirect()->back()->with('status', 'Souvenir photo deleted Successfully');
	}
}
