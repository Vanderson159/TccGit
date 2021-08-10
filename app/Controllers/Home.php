<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index(){
		$ruaModel = new \App\Models\RuaModel(); //criou um obj model
        $rua = $ruaModel->find();
        $data['rua_cep'] = $rua;
		$data['rua'] = $rua;

		echo view('header.php');
		echo view('site.php', $data);
		echo view('footer.php');
	}
}
