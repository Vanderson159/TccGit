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
/*
	public function filtro(){
		$db = \Config\Database::connect();
        $db = db_connect();
		//get do form
		$destino = $this->request->getPost('rua_cep');
		$query = $db->query('CREATE VIEW vwOnibus AS SELECT DISTINCT onibus.nome FROM linha_has_ponto, linha, ponto, onibus WHERE linha.id = linha_has_ponto.linha_id and ponto.id = linha_has_ponto.ponto_id and onibus.linha_id = linha.id and ponto.endereco = '.$destino.';');
		$results = $query->getResult();
		$data['result'] = $results; //passa pro data pra poder acessar em outras páginas 
		echo view('header.php');
		echo view('result.php');
		echo view('footer.php');
	}
	*/
}
