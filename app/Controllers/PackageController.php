<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Package;

class PackageController extends BaseController
{
    public function __construct() {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $this->datetime = date("Y-m-d H:i:s");
        $this->date = date("Y-m-d");
        $this->db = \Config\Database::connect();
        
        $this->packageModel = new Package();
    }
    
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Package List']),
			'page_title' => view('partials/page-title', ['title' => 'Package List', 'li_1' => 'Dashboard', 'li_2' => 'Package List']),
			'packages' => $this->packageModel->orderBy("package_id", "DESC")->findAll(),
		];
		return view('packages/index', $data);
	}

	public function add_form()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Add New Package']),
			'page_title' => view('partials/page-title', ['title' => 'Add New Package', 'li_1' => 'Dashboard', 'li_2' => 'Package List', 'li_3' => 'Add New Package'])
		];

		return view('packages/add-form', $data);
	}

	public function save_add()
	{
	    $img        = $this->request->getFile('photo') ?? null;
	    $photo = "";
	    
        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            
            if ($img->move(ROOTPATH . 'public/uploads/packages', $newName)) {
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

		$this->packageModel->save($data);

		return redirect('package')->with('status', 'Package inserted Successfully');
	}

	public function update_form($package_id = null)
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Update Package']),
			'page_title' => view('partials/page-title', ['title' => 'Update Package', 'li_1' => 'Dashboard', 'li_2' => 'Package List', 'li_3' => 'Update Package']),
			'package' => $this->packageModel->find($package_id)
		];

		return view('packages/edit-form', $data);
	}

	public function save_update($package_id = null)
	{
	    $img        = $this->request->getFile('photo') ?? null;
	    $photo = "";
	    
        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            
            if ($img->move(ROOTPATH . 'public/uploads/packages', $newName)) {
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
		
		$this->packageModel->update($package_id, $data);

		return redirect('package')->with('status', 'Package updated Successfully');
	}

	public function delete_package($package_id = null)
	{
		$this->packageModel->delete($package_id);

		return redirect('package')->with('status', 'Package deleted Successfully');
	}
	
	public function delete_package_photo($package_id = null)
	{
		$this->packageModel->update($package_id, [
		    'photo' => null
		]);
		
		return redirect()->back()->with('status', 'Package photo deleted Successfully');
	}
}
