<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index(){
		$db = \Config\Database::connect();
        $db = db_connect();
		//$ruaModel = new \App\Models\RuaModel(); //criou um obj model
        // $rua = $ruaModel->find();
		$query = $db->query('SELECT * FROM `ruasavenidas` ORDER by nome ASC;');
		$rua = $query->getResult();
        $data['rua_cep'] = $rua;
		$data['rua'] = $rua;
		echo view('header.php');
		echo view('site.php', $data);
		echo view('footer.php');
	}

	public function escolha($id = null, $cep = null){
		if(is_null($id)){
			$retorno = $this->filtro();
			return $retorno;
		}else{
			$data['id'] = $id;
			$data['cep'] =  $cep;
			echo view('header.php');
			echo view('escolha.php', $data);
			echo view('footer.php');
			
		}
	}

	public function filtro($escolha = null){
		$db = \Config\Database::connect();
        $db = db_connect();
		//get do form
		if(is_null($escolha)){
			$destino = $this->request->getPost('rua_cep');
			$query = $db->query('SELECT DISTINCT onibus.nome, ponto.rua_cep, onibus.id FROM linha_has_ponto, linha, ponto, onibus WHERE linha.id = linha_has_ponto.linha_id and ponto.id = linha_has_ponto.ponto_id and onibus.linha_id = linha.id and ponto.rua_cep = '.$destino.';');
			$results = $query->getResult();
			$data['destino'] = $destino;
			$data['result'] = $results; //passa pro data pra poder acessar em outras páginas 
		}else{
			$destino = $this->request->getPost('rua_cep');
			$query = $db->query('SELECT DISTINCT onibus.nome, ponto.rua_cep, onibus.id FROM linha_has_ponto, linha, ponto, onibus WHERE linha.id = linha_has_ponto.linha_id and ponto.id = linha_has_ponto.ponto_id and onibus.linha_id = linha.id and ponto.rua_cep = '.$escolha.';');
			$results = $query->getResult();
			$data['destino'] = $escolha;
			$data['result'] = $results; //passa pro data pra poder acessar em outras páginas 
		}
		
		echo view('header.php');
		echo view('result.php', $data);
		echo view('footer.php');
	}



	public function onibusFiltro($id = null){
		session_start();
		//quando tiver o model ônibus vai ficar fácil fazer isso!
		if(is_null($id)){
			//redirecionar a aplicação para o categoria index    view das listas
			//definir uma msg via session
			//flashdata tu acessa ela e ela se destroi
			$this->session->setFlashdata('msg', 'ônibus não encontrado');
			$retorno = $this->filtro();
			return $retorno;
		}

		$db = \Config\Database::connect();
        $db = db_connect();
		//get do form
		$query = $db->query('SELECT onibus.nome FROM onibus WHERE onibus.id = '.$id.';');
		$pontos = $db->query('SELECT DISTINCT onibus.nome, ponto.rua_cep, ponto.endereco, ponto.id, ponto.localizacao FROM linha_has_ponto, linha, ponto, onibus WHERE linha.id = linha_has_ponto.linha_id and ponto.id = linha_has_ponto.ponto_id and onibus.linha_id = linha.id and onibus.id = '.$id.';');		
		$results = $query->getResult();
		$ponto = $pontos->getResult();
		$data['result'] = $results; //passa pro data pra poder acessar em outras páginas 
		$data['ponto'] = $ponto;
		$data['idBus'] = $id;
		echo view('header.php');
		echo view('onibusFiltro.php', $data);
		echo view('footer.php');
	}
	
	//SELECT DISTINCT onibus.nome, ponto.rua_cep, ponto.endereco FROM linha_has_ponto, linha, ponto, onibus WHERE linha.id = linha_has_ponto.linha_id and ponto.id = linha_has_ponto.ponto_id and onibus.linha_id = linha.id and onibus.id = 3003;

	public function onibusHorario($id = null, $idBus = null){
		if(is_null($id)){
			//redirecionar a aplicação para o categoria index    view das listas
			//definir uma msg via session
			//flashdata tu acessa ela e ela se destroi
			$this->session->setFlashdata('msg', 'id do ponto não encontrado');
			$retorno = $this->index();
			return $retorno;
		}
		$db = \Config\Database::connect();
        $db = db_connect();
		$sql = "SELECT DISTINCT onibus.nome,linha.tempo, ponto.rua_cep, ponto.endereco, ponto.id, linha_has_ponto.manha, linha_has_ponto.tarde FROM linha_has_ponto, linha, ponto, onibus WHERE linha.id = linha_has_ponto.linha_id and ponto.id = linha_has_ponto.ponto_id and onibus.linha_id = linha.id and onibus.id = ? and ponto.id = ?";
		$query = $db->query($sql, [$idBus, $id]);
		$results = $query->getResult();
		$data['result'] = $results; //passa pro data pra poder acessar em outras páginas
		echo view('header.php');
		echo view('onibusHorario.php', $data);
		echo view('footer.php');
	}

	public function mapaRota( $idBus = null){
		if(is_null($idBus)){
			//redirecionar a aplicação para o categoria index    view das listas
			//definir uma msg via session
			//flashdata tu acessa ela e ela se destroi
			$this->session->setFlashdata('msg', 'id do ônibus não encontrado');
			$retorno = $this->escolha();
			return $retorno;
		}
		$db = \Config\Database::connect();
        $db = db_connect();
		$sql = "SELECT DISTINCT onibus.nome ,linha.mapa FROM linha_has_ponto, linha, ponto, onibus WHERE linha.id = linha_has_ponto.linha_id and ponto.id = linha_has_ponto.ponto_id and onibus.linha_id = linha.id and onibus.id = ?";
		$query = $db->query($sql, [$idBus]);
		$results = $query->getResult();
		$data['result'] = $results; //passa pro data pra poder acessar em outras páginas
		echo view('header.php');
		echo view('mapaRota.php', $data);
		echo view('footer.php');
	}
}
