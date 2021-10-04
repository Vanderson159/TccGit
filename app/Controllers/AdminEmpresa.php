<?php 

    namespace App\Controllers;
    use CodeIgniter\Controller;
    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;
    use Psr\Log\LoggerInterface;

    class AdminEmpresa extends BaseController{
        public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger){//método do CodeIgniter
		    // Do Not Edit This Line
		    parent::initController($request, $response, $logger);

		    //--------------------------------------------------------------------
		    // Preload any models, libraries, etc, here.
		    //--------------------------------------------------------------------
		    // E.g.: 
            $this->session = \Config\Services::session();
	    }
        

        public function index(){
            //$data['msg'] = $this->session->getFlashdata('msg'); //tentativa de mensagem de erro
            $_SESSION['user'] = null;
            $_SESSION['senha'] = null;

            echo view ('header');
            echo view ('login');
            echo view ('footer'); 
        }
         /////////////////////////////////////////////// onibus
        public function voltarPainelAdmEmpresa(){
            
            if(isset($_SESSION['user'])){
                $login = $_SESSION['user'];
                $senha = $_SESSION['senha'];

                $db = \Config\Database::connect();
                $db = db_connect();

                $queryEmpresa = $db->query('SELECT * FROM empresa WHERE login = "'.$login.'"');
                $queryAdmin = $db->query('SELECT * FROM admin WHERE login = "'.$login.'"');
                $resultsAdmin = $queryAdmin->getResult();
                $resultsEmpresa = $queryEmpresa->getResult();
            
                if($resultsAdmin){
                    if($resultsAdmin[0]->login == $login){
                        if($resultsAdmin[0]->senha == $senha){
                            //$data['msg'] = 'Logado com sucesso';
                            $_SESSION['user'] = $resultsAdmin[0]->login;
                            $_SESSION['senha'] = $resultsAdmin[0]->senha;
                            $_SESSION['userType'] = 'adm';

                            echo view('header');
                            echo view('AdminSite/admin');
                            echo view('footer');
                        }else{
                            //$data['msg'] = 'Falha ao logar'; //tentativa de mensagem de erro
                            $retorno = $this->index();
                            return $retorno;
                        }    
                    }else{
                        //$data['msg'] = 'Falha ao logar';//tentativa de mensagem de erro
                        $retorno = $this->index();
                        return $retorno; 
                    }
                }else{
                    if($resultsEmpresa){
                        if($resultsEmpresa[0]->login == $login){
                            if($resultsEmpresa[0]->senha == $senha){
                                //passando o objeto que foi resultado da busca no bd para a session global
                                $_SESSION['user'] = $resultsEmpresa[0]->login;
                                $_SESSION['senha'] = $resultsEmpresa[0]->senha;
                                $_SESSION['userType'] = 'admEmpresa';

                                echo view('header');
                                echo view('AdminEmpresa/admin');
                                echo view('footer');
                            }else{
                                $retorno = $this->index();
                                return $retorno;
                            }
                        }else{
                            //$data['msg'] = 'Falha ao logar';//tentativa de mensagem de erro
                            $retorno = $this->index();
                            return $retorno;
                        }
                    }else{
                        //$data['msg'] = 'Falha ao logar';//tentativa de mensagem de erro
                        $retorno = $this->index();
                        return $retorno;
                    }
                }
            }else{
                $retorno = $this->index();
                return $retorno;
            } 
        }

        public function cadOnibus(){
            $db = \Config\Database::connect();
            $db = db_connect();
            $sql = "SELECT empresa.id FROM `empresa` WHERE empresa.login = ?";
            $query = $db->query($sql, [$_SESSION['user']]);
            $results = $query->getResult();
           // SELECT linha.id FROM `linha` WHERE linha.empresa_id = 1002
            $sql2 = "SELECT linha.id FROM `linha` WHERE linha.empresa_id = ?";
            $query2 = $db->query($sql2, [$results[0]->id]);
		    $results2 = $query2->getResult();

            $data['linha'] = $results2;
            $data['titulo'] = 'Inserir Novo Ônibus';
            $data['acao'] = 'Inserir';
            $data['msg'] = '';
            echo view ('header');
            echo view ('AdminEmpresa/Onibus/cadOnibus', $data);
            echo view ('footer');
        }

        public function tabelaOnibus(){
            $onibusModel = new \App\Models\OnibusModel();
            $data['bus'] = $onibusModel->find();                      
            echo view ('header');
            echo view ('AdminEmpresa/Onibus/tabela', $data); 
            echo view ('footer');
        }

       public function inserir(){
            $data['msg'] = '';
            $db = \Config\Database::connect();
            $db = db_connect();
            $sql = "SELECT  empresa.id FROM empresa WHERE empresa.login = ?";
            $query = $db->query($sql, [$_SESSION['user']]);
		    $results = $query->getResult();
            $sql = "SELECT empresa.id FROM `empresa` WHERE empresa.login = ?";
            $query = $db->query($sql, [$_SESSION['user']]);
            $results = $query->getResult();
           // SELECT linha.id FROM `linha` WHERE linha.empresa_id = 1002
            $sql2 = "SELECT linha.id FROM `linha` WHERE linha.empresa_id = ?";
            $query2 = $db->query($sql2, [$results[0]->id]);
		    $results2 = $query2->getResult();

            $data['linha'] = $results2;
            $data['titulo'] = 'Inserir Novo Ônibus';
            $data['acao'] = 'Inserir';
            if($this->request->getMethod() === 'post'){
                //acessou a classe pelo namespace dela
                $onibusModel = new \App\Models\onibusModel(); //criou um obj model
                //parametros (nomedacoluna, valor)
                $onibusModel->set('id', $this->request->getPost('id'));
                $onibusModel->set('nome', $this->request->getPost('nome'));
                $onibusModel->set('empresa_id', $results[0]->id);
                $onibusModel->set('linha_id', $this->request->getPost('linha'));

                if($onibusModel->insert()){
                    $data['msg'] = 'Erro';
                }else{
                    $data['msg'] = 'Sucesso';
                }
            }
            echo view ('header');
            echo view ('AdminEmpresa/Onibus/cadOnibus', $data);
            echo view ('footer');
        }

    
        
        public function editarBus($id = null){//metodo
            $data['titulo'] = 'Editar Ônibus '. $id;
            $data['acao'] = 'Editar';
            $data['msg'] = '';

            $db = \Config\Database::connect();
            $db = db_connect();
            $sql = "SELECT empresa.id FROM `empresa` WHERE empresa.login = ?";
            $query = $db->query($sql, [$_SESSION['user']]);
            $results = $query->getResult();
           // SELECT linha.id FROM `linha` WHERE linha.empresa_id = 1002
            $sql2 = "SELECT linha.id FROM `linha` WHERE linha.empresa_id = ?";
            $query2 = $db->query($sql2, [$results[0]->id]);
		    $results2 = $query2->getResult();
            $data['linha'] = $results2;

            $onibusModel = new \App\Models\onibusModel(); //criou um obj model
            
            $onibus = $onibusModel->find($id); // busca através deste método

            if($this->request->getMethod() === 'post'){
                //quando o form for submetido
                //vai pegar o valor inserido no forme pelo getPost e vai atribuir ao objeto
               // $onibus->id = $this->request->getPost('id'); 
                $onibus->nome = $this->request->getPost('nome');
                $onibus->linha_id = $this->request->getPost('linha');
                
                //if para ver se att
                if($onibusModel->update($id, $onibus)){
                    $data['msg'] = 'Sucesso';
                }else{
                    $data['msg'] = 'Erro';
                }
            }

            $data['onibus'] = $onibus; //passa pro data pra poder acessar em outras páginas 
            echo view('header');
            echo view('AdminEmpresa/Onibus/cadOnibus', $data);
            echo view('footer');
        }

        public function excluirOnibus($id = null){
            if(is_null($id)){
                //definir uma msg via session
                //flashdata tu acessa ela e ela se destroi
                $this->session->setFlashdata('msg', 'ônibus não encontrado');
                $retorno = $this->tabelaOnibus();
                return $retorno;
            }
            $busModel = new \App\Models\OnibusModel();
            if($busModel->delete($id)){
                //excluiu com sucesso
                $this->session->setFlashdata('msg', 'ônibus excluido com sucesso');
            }else{
                //erro ao excluir
                $this->session->setFlashdata('msg', 'Erro ao excluir ônibus');
            }
            $retorno = $this->tabelaOnibus();
            return $retorno;
        }
    }
?>