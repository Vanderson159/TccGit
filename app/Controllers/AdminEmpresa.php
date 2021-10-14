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
        ////////// crud bus //////////////
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
            $db = \Config\Database::connect();
            $db = db_connect();
            $sql = "SELECT empresa.id FROM `empresa` WHERE empresa.login = ?";
            $query = $db->query($sql, [$_SESSION['user']]);
            $results = $query->getResult();
            $_SESSION['idEmpresa'] = $results[0]->id;
            $sql2 = "SELECT empresa.nome FROM `empresa` WHERE empresa.id = ?";
            $query2 = $db->query($sql2, [$results[0]->id]);
            $results2 = $query2->getResult();

            $_SESSION['nomeEmp'] = $results2[0]->nome;
            
            $sql3 = "SELECT * FROM `onibus` WHERE empresa_id = ?";
            $query3 = $db->query($sql3, [$_SESSION['idEmpresa']]);
            $results3 = $query3->getResult();

            $data['msg'] = '';  
            $data['bus'] = $results3;                     
            echo view ('header');
            echo view ('AdminEmpresa/Onibus/tabela', $data); 
            echo view ('footer');
        }

        public function inserir(){
            $db = \Config\Database::connect();
            $db = db_connect();
            $sql = "SELECT  empresa.id FROM empresa WHERE empresa.login = ?";
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

                $check = $this->request->getPost('id');
                $sql4 = "SELECT * FROM `onibus` WHERE onibus.id = ?";
                $query4 = $db->query($sql4, [$check]);
                $results4 = $query4->getResult();

                $onibusModel->set('nome', $this->request->getPost('nome'));
                $onibusModel->set('empresa_id', $results[0]->id);
                $onibusModel->set('linha_id', $this->request->getPost('linha'));

                //gambiarra
                if($results4 != null){
                    $data['msg'] = 'Erro';
                    $data['cod'] = 222;
                }else{
                    if($onibusModel->insert()){
                        $data['msg'] = 'Erro';
                    }else{
                        $data['msg'] = 'Sucesso';
                        $data['cod'] = 111;
                    }
                }
            }
            $sql3 = "SELECT * FROM `onibus` WHERE empresa_id = ?";
            $query3 = $db->query($sql3, [$_SESSION['idEmpresa']]);
            $results3 = $query3->getResult();

            $data['bus'] = $results3; 
            echo view ('header');
            echo view ('AdminEmpresa/Onibus/tabela', $data);
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
            $db = \Config\Database::connect();
            $db = db_connect();
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
                $data['msg'] = 'Sucesso';
                $data['cod'] = 444;
            }else{
                //erro ao excluir
                $data['msg'] = 'Erro';
                $data['cod'] = 333;
            }
            $sql3 = "SELECT * FROM `onibus` WHERE empresa_id = ?";
            $query3 = $db->query($sql3, [$_SESSION['idEmpresa']]);
            $results3 = $query3->getResult();
            $data['bus'] = $results3; 

            echo view ('header');
            echo view ('AdminEmpresa/Onibus/tabela', $data);
            echo view ('footer');
        }
        ////////// crud linha //////////////
        public function tabelaLinha(){
            $db = \Config\Database::connect();
            $db = db_connect();
            $sql = "SELECT empresa.id FROM `empresa` WHERE empresa.login = ?";
            $query = $db->query($sql, [$_SESSION['user']]);
            $results = $query->getResult();
            $_SESSION['idEmpresa'] = $results[0]->id;
            $sql2 = "SELECT empresa.nome FROM `empresa` WHERE empresa.id = ?";
            $query2 = $db->query($sql2, [$results[0]->id]);
            $results2 = $query2->getResult();

            $_SESSION['nomeEmp'] = $results2[0]->nome;
           
            $sql3 = "SELECT * FROM `linha` WHERE empresa_id = ?";
            $query3 = $db->query($sql3, [$_SESSION['idEmpresa']]);
            $results3 = $query3->getResult();

            $data['linha'] = $results3;      
            $data['msg'] = '';
            echo view ('header');
            echo view ('AdminEmpresa/Linha/tabela', $data); 
            echo view ('footer');
        }

        public function cadLinha(){
            $data['titulo'] = 'Inserir Nova Linha';
            $data['acao'] = 'Inserir';
            $data['msg'] = '';
            echo view ('header');
            echo view ('AdminEmpresa/Linha/cadLinha', $data);
            echo view ('footer');
        }

        public function inserirLinha(){
            $db = \Config\Database::connect();
            $db = db_connect();
            $data['msg'] = '';
            $data['linha'] = '';
            $data['titulo'] = 'Inserir Novo Ônibus';
            $data['acao'] = 'Inserir';
            $data['linha'] = null;
            if($this->request->getMethod() === 'post'){

                $check = $this->request->getPost('id');
                $sql4 = "SELECT * FROM `linha` WHERE linha.id = ?";
                $query4 = $db->query($sql4, [$check]);
                $results4 = $query4->getResult();
                //acessou a classe pelo namespace dela
                $linhaModel = new \App\Models\LinhaModel(); //criou um obj model
                //parametros (nomedacoluna, valor)
                $linhaModel->set('id', $this->request->getPost('id'));
                $linhaModel->set('mapa', $this->request->getPost('mapa'));
                $linhaModel->set('tempo', $this->request->getPost('tempo'));
                $linhaModel->set('passagens', $this->request->getPost('passagens'));
                $linhaModel->set('empresa_id', $_SESSION['idEmpresa']);

                if($results4 != null){
                    $data['msg'] = 'Erro';
                    $data['cod'] = 222;
                }else{
                    if($linhaModel->insert()){
                        $data['msg'] = 'Erro';
                    }else{
                        $data['msg'] = 'Sucesso';
                        $data['cod'] = 111;
                    }
                } 
            }
          
            $sql3 = "SELECT * FROM `linha` WHERE empresa_id = ?";
            $query3 = $db->query($sql3, [$_SESSION['idEmpresa']]);
            $results3 = $query3->getResult();

            $data['linha'] = $results3;  

            echo view ('header');
            echo view ('AdminEmpresa/Linha/tabela', $data);
            echo view ('footer');
        }

        public function editarLinha($id = null){//metodo
            $data['titulo'] = 'Editar Linha '. $id;
            $data['acao'] = 'Editar';
            $data['msg'] = '';

            //$db = \Config\Database::connect();
            //$db = db_connect();
           // $sql = "SELECT empresa.id FROM `empresa` WHERE empresa.login = ?";
            //$query = $db->query($sql, [$_SESSION['user']]);
            //$results = $query->getResult();
           // SELECT linha.id FROM `linha` WHERE linha.empresa_id = 1002
            //$sql2 = "SELECT linha.id FROM `linha` WHERE linha.empresa_id = ?";
           // $query2 = $db->query($sql2, [$results[0]->id]);
		    //$results2 = $query2->getResult();
           // $data['linha'] = $results2;

            $linhaModel = new \App\Models\LinhaModel(); //criou um obj model
            
            $linha = $linhaModel->find($id); // busca através deste método

            if($this->request->getMethod() === 'post'){
                //quando o form for submetido
                //vai pegar o valor inserido no forme pelo getPost e vai atribuir ao objeto
               // $onibus->id = $this->request->getPost('id'); 
                $linha->mapa = $this->request->getPost('mapa');
                $linha->tempo = $this->request->getPost('tempo');
                $linha->passagens = $this->request->getPost('passagens');
                
                //if para ver se att
                if($linhaModel->update($id, $linha)){
                    $data['msg'] = 'Sucesso';
                }else{
                    $data['msg'] = 'Erro';
                }
            }
            $data['nomeEmpresa'] =  $_SESSION['nomeEmp'];
            $data['linha'] = $linha; //passa pro data pra poder acessar em outras páginas 
            echo view('header');
            echo view('AdminEmpresa/Linha/cadLinha', $data);
            echo view('footer');
        }

        public function excluirLinha($id = null){
            $db = \Config\Database::connect();
            $db = db_connect();
            if(is_null($id)){
                //definir uma msg via session
                //flashdata tu acessa ela e ela se destroi
                $this->session->setFlashdata('msg', 'Linha não encontrado');
                $retorno = $this->tabelaLinha();
                return $retorno;
            }
            $linhaModel = new \App\Models\LinhaModel();
            
            $check = $id;
            $sql4 = "SELECT * FROM `onibus` WHERE onibus.linha_id = ?";
            $query4 = $db->query($sql4, [$check]);
            $results4 = $query4->getResult();

            if($results4 != null){
                $data['msg'] = 'Erro';
                $data['cod'] = 333;
            }else{
                if($linhaModel->delete($id)){
                    $data['msg'] = 'Sucesso';
                    $data['cod'] = 444;
                }else{
                    $data['msg'] = 'Sucesso';    
                }
            } 

            //tabela lista 
            $sql3 = "SELECT * FROM `linha` WHERE empresa_id = ?";
            $query3 = $db->query($sql3, [$_SESSION['idEmpresa']]);
            $results3 = $query3->getResult();

            $data['linha'] = $results3;  

            echo view ('header');
            echo view ('AdminEmpresa/Linha/tabela', $data); 
            echo view ('footer');
        }

        public function pontosLinha($id = null){
            $db = \Config\Database::connect();
            $db = db_connect();

            $sql = "SELECT empresa.id FROM `empresa` WHERE empresa.login = ?";
            $query = $db->query($sql, [$_SESSION['user']]);
            $results = $query->getResult();
            $_SESSION['idEmpresa'] = $results[0]->id;
            //sql para a tabela
            $sql2 = "SELECT ponto.id, ponto.endereco, ponto.localizacao, ponto.rua_cep, onibus.nome, linha_has_ponto.manha, linha_has_ponto.tarde FROM onibus, ponto, linha, linha_has_ponto WHERE ponto.id = linha_has_ponto.ponto_id AND linha_has_ponto.ponto_id = ponto.id AND linha.id = linha_has_ponto.linha_id AND linha_has_ponto.linha_id = linha.id AND 
            linha.empresa_id = ? AND linha.id = ? AND onibus.linha_id = linha.id";
            $query2 = $db->query($sql2, [$_SESSION['idEmpresa'], $id]);
            $results2 = $query2->getResult();
            $_SESSION['idLinha'] = $id;
            $data['ponto'] = $results2;      
            $data['msg'] = '';
            echo view ('header');
            echo view ('AdminEmpresa/Linha/pontos', $data); 
            echo view ('footer');
        }
        public function pontosLinhaDelete($idPonto = null){
            $db = \Config\Database::connect();
            $db = db_connect();
            if(is_null($idPonto)){
                //definir uma msg via session
                //flashdata tu acessa ela e ela se destroi
                $this->session->setFlashdata('msg', 'Ponto não encontrado');
                $retorno = $this->tabelaLinha();
                return $retorno;
            }

            $sql = "DELETE FROM `linha_has_ponto` WHERE `linha_has_ponto`.`linha_id` = ? AND `linha_has_ponto`.`ponto_id` = ?";
            if($db->query($sql, [$_SESSION['idLinha'], $idPonto])){
                $data['msg'] = 'Sucesso';
                $data['cod'] = 444;
            }else{
                $data['msg'] = 'Erro';
                $data['cod'] = 333;
            }
            //tabela lista 
            $sql2 = "SELECT ponto.id, ponto.endereco, ponto.localizacao, ponto.rua_cep, onibus.nome, linha_has_ponto.manha, linha_has_ponto.tarde FROM onibus, ponto, linha, linha_has_ponto WHERE ponto.id = linha_has_ponto.ponto_id AND linha_has_ponto.ponto_id = ponto.id AND linha.id = linha_has_ponto.linha_id AND linha_has_ponto.linha_id = linha.id AND 
            linha.empresa_id = ? AND linha.id = ? AND onibus.linha_id = linha.id";
            $query2 = $db->query($sql2, [$_SESSION['idEmpresa'], $_SESSION['idLinha']]);
            $results2 = $query2->getResult();
            $data['ponto'] = $results2;


            echo view ('header');
            echo view ('AdminEmpresa/Linha/pontos', $data); 
            echo view ('footer');
        }
        public function pontosLinhaEdit($idPonto = null){
            $db = \Config\Database::connect();
            $db = db_connect();
            $sql = "SELECT * FROM `linha_has_ponto` WHERE linha_has_ponto.linha_id = ? AND linha_has_ponto.ponto_id = ?";
            $query = $db->query($sql, [$_SESSION['idLinha'], $idPonto]);
            $results = $query->getResult();
            $data['pontosLinha'] = $results;
            $_SESSION['ultimaPesquisa'] = $results;
            $_SESSION['idPonto'] = $idPonto;

            $data['msg'] = '';
            $data['acao'] = 'Editar';
            $data['titulo'] = 'Editar';

            echo view ('header');
            echo view ('AdminEmpresa/Ponto/definirHorarios', $data);
            echo view ('footer');

        }
        public function pontosLinhaEditInsert(){
            $db = \Config\Database::connect();
            $db = db_connect();
            //$sql = "SELECT * FROM `linha_has_ponto` WHERE linha_has_ponto.linha_id = ? AND linha_has_ponto.ponto_id = ?";
            //$query = $db->query($sql, [$_SESSION['idLinha'],$_SESSION['idPonto']]);
            //$results = $query->getResult();
            //$_SESSION['idLinha']
            $data['msg'] = '';
            $data['linha'] = '';
            $data['titulo'] = 'Adicione pontos de parada a sua linha:';
            $data['acao'] = 'Editar';
            $data['linha'] = null;
            
           
                if($this->request->getMethod() === 'post'){
                    //acessou a classe pelo namespace dela
                    //parametros (nomedacoluna, valor)
                    //$linhapontoModel->set('ponto_id',  $_SESSION['idPonto']);
                   // $linhapontoModel->set('linha_id',  $_SESSION['idLinha']);
                    $manha = $this->request->getPost('timeManha');
                    $tarde = $this->request->getPost('timeTarde');
                    
                    $sql = "UPDATE linha_has_ponto SET  linha_has_ponto.manha = ?, linha_has_ponto.tarde = ? WHERE linha_has_ponto.linha_id = ? AND linha_has_ponto.ponto_id = ?";
                    //$db->query($sql, [$manha, $tarde, $_SESSION['idLinha'],$_SESSION['idPonto']]);
                    if($db->query($sql, [$manha, $tarde, $_SESSION['idLinha'], $_SESSION['idPonto']])){
                        //$data['msg'] = 'Erro';
                        $data['msg'] = 'Sucesso';
                       // $data['cod'] = 222;
                    }else{
                        $data['msg'] = 'Erro';
                    }
                }
            $data['pontosLinha'] =  $_SESSION['ultimaPesquisa'];
            echo view ('header');
            echo view ('AdminEmpresa/Ponto/definirHorarios', $data);
            echo view ('footer');
        }
        ////////// crud pontos //////////////
        public function tabelaPonto(){
            $db = \Config\Database::connect();
            $db = db_connect();
            $sql = "SELECT empresa.id FROM `empresa` WHERE empresa.login = ?";
            $query = $db->query($sql, [$_SESSION['user']]);
            $results = $query->getResult();
            $_SESSION['idEmpresa'] = $results[0]->id;
            $sql2 = "SELECT empresa.nome FROM `empresa` WHERE empresa.id = ?";
            $query2 = $db->query($sql2, [$results[0]->id]);
            $results2 = $query2->getResult();

            $_SESSION['nomeEmp'] = $results2[0]->nome;

            $sql3 = "SELECT linha.id, onibus.nome FROM linha, empresa, onibus WHERE linha.id = onibus.linha_id and
            onibus.linha_id = linha.id and linha.empresa_id = empresa.id and empresa.id = linha.empresa_id and 
            onibus.empresa_id = empresa.id and empresa.id = onibus.empresa_id and empresa.id = ?";
            $query3 = $db->query($sql3, [$results[0]->id]);
            $results3 = $query3->getResult();
            $data['linha'] = $results3;      
            $data['msg'] = '';

            echo view ('header');
            echo view ('AdminEmpresa/Ponto/tabela', $data); 
            echo view ('footer');
        }
        public function adicionarPonto($id = null){
            $pontoModel = new \App\Models\PontoModel();
            $data['ponto'] = $pontoModel->find();  
            $_SESSION['idLinha'] = $id;                 
            echo view ('header');
            echo view ('AdminEmpresa/Ponto/listaPonto', $data); 
            echo view ('footer');
        }
        public function relacionarPonto($id = null){
            $data['ponto'] = '';
            $data['acao'] = 'Inserir';
            $data['msg'] = '';
            $data['titulo'] = 'Adicione pontos de parada a sua linha:';
            $_SESSION['idPonto'] = $id; 
            $data['pontosLinha'] = null;

            echo view('header');
            echo view('AdminEmpresa/Ponto/definirHorarios', $data);
            echo view('footer');
        }
        public function inserirPonto(){
            $db = \Config\Database::connect();
            $db = db_connect();
            $sql = "SELECT * FROM `linha_has_ponto` WHERE linha_has_ponto.linha_id = ? AND linha_has_ponto.ponto_id = ?";
            $query = $db->query($sql, [$_SESSION['idLinha'],$_SESSION['idPonto']]);
            $results = $query->getResult();
            $data['pontosLinha'] = null;
            $data['msg'] = '';
            $data['linha'] = '';
            $data['titulo'] = 'Adicione pontos de parada a sua linha:';
            $data['acao'] = 'Inserir';
            $data['linha'] = null;
            if($results != null){
                $data['msg'] = 'Erro';
                $data['cod'] = 222;
            }else{
                if($this->request->getMethod() === 'post'){
                    //acessou a classe pelo namespace dela
                    $linhapontoModel = new \App\Models\LinhaPontoModel(); //criou um obj model
                    //parametros (nomedacoluna, valor)
                    $linhapontoModel->set('ponto_id',  $_SESSION['idPonto']);
                    $linhapontoModel->set('linha_id',  $_SESSION['idLinha']);
                    $linhapontoModel->set('manha', $this->request->getPost('timeManha'));
                    $linhapontoModel->set('tarde', $this->request->getPost('timeTarde'));
    
                    if($linhapontoModel->insert()){
                        //$data['msg'] = 'Erro';
                       // $data['cod'] = 222;
                    }else{
                        $data['msg'] = 'Sucesso';
                    }
                }
            }
            
            echo view ('header');
            echo view ('AdminEmpresa/Ponto/definirHorarios', $data);
            echo view ('footer');
        }
    }
?>