<?php 
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;
    use Psr\Log\LoggerInterface;

    class Admin extends BaseController{
        
        function __construct() {
        
        }
        
        public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger){//método do CodeIgniter
		    // Do Not Edit This Line
		    parent::initController($request, $response, $logger);

		    //--------------------------------------------------------------------
		    // Preload any models, libraries, etc, here.
		    //--------------------------------------------------------------------
		    // E.g.: 
            $this->session = \Config\Services::session();
	    }
        public function tabela(){
             $adminModel = new \App\Models\AdminModel();
             $data['msg'] = '';                      

             $data['adm'] = $adminModel->find();                      
             echo view ('header');
             echo view ('AdminSite/tabela', $data); 
             echo view ('footer');
        }
        public function index(){
            //$data['msg'] = $this->session->getFlashdata('msg'); //tentativa de mensagem de erro
            $_SESSION['user'] = null;
            $_SESSION['senha'] = null;
            echo view ('header');
            echo view ('login');
            echo view ('footer'); 
        }
        public function inserir(){
            $db = \Config\Database::connect();
            $db = db_connect();
            $data['titulo'] = 'Inserir Novo ADM';
            $data['acao'] = 'Inserir';
            if($this->request->getMethod() === 'post'){
                //acessou a classe pelo namespace dela
                $admin_model = new \App\Models\AdminModel(); //criou um obj model
                //parametros (nomedacoluna, valor)
                $senha = md5($this->request->getPost('senha'));
                $admin_model->set('id', $this->request->getPost('id'));
                $admin_model->set('login', $this->request->getPost('login'));
                $admin_model->set('senha', $senha);

                //gambiarra
            
                    if($admin_model->insert()){
                        $data['msg'] = 'Sucesso';
                        $data['cod'] = 111;
                    }else{
                        $data['msg'] = 'Erro';
                        $data['cod'] = 222;
                    }
                
            }
            $data['adm'] = $admin_model->find();  
            echo view ('header');
            echo view ('AdminSite/tabela', $data);
            echo view ('footer');
        }
        public function editar($id = null){//metodo
            $data['titulo'] = 'Editar Administrador '. $id;
            $data['acao'] = 'Editar';
            $data['msg'] = '';
            $adminModel = new \App\Models\AdminModel(); //criou um obj model
            
            $admin = $adminModel->find($id); // busca através deste método

            if($this->request->getMethod() === 'post'){
                //quando o form for submetido
                //vai pegar o valor inserido no forme pelo getPost e vai atribuir ao objeto
                $admin->login = $this->request->getPost('login'); 
                $senha = md5($this->request->getPost('senha'));
                $admin->senha = $senha;
                //if para ver se att
                if($adminModel->update($id, $admin)){
                     $data['msg'] = 'Sucesso';
                }else{
                    $data['msg'] = 'Erro';
                }
            }

            $data['admin'] = $admin; //passa pro data pra poder acessar em outras páginas 
            echo view('header');
            echo view('AdminSite/cadAdm', $data);
            echo view('footer');
        }
        public function excluir($id = null){
            $db = \Config\Database::connect();
            $db = db_connect();
            if(is_null($id)){
                //definir uma msg via session
                //flashdata tu acessa ela e ela se destroi
                $this->session->setFlashdata('msg', 'Adm não encontrado');
                $retorno = $this->tabela();
                return $retorno;
            }
            $adminModel = new \App\Models\AdminModel();
            $check = $id;
            $sql4 = "SELECT * FROM `admin` WHERE admin.id = ?";
            $query4 = $db->query($sql4, [$check]);
            $results4 = $query4->getResult();

                if($adminModel->delete($id)){
                    $data['msg'] = 'Sucesso';
                    $data['cod'] = 444;
                }else{
                    $data['msg'] = 'Erro';   
                    $data['cod'] = 333;
                }
            
            $data['adm'] = $adminModel->find();  
            echo view ('header');
            echo view ('AdminSite/tabela', $data);
            echo view ('footer');
        }
        public function autenticar(){
            $db = \Config\Database::connect();
            $db = db_connect();

            if($this->request->getMethod() === 'post'){
                $login = $this->request->getPost('login');
                $senha = md5($this->request->getPost('password'));
            }

            $queryEmpresa = $db->query('SELECT * FROM empresa WHERE login = "'.$login.'"');
            $queryAdmin = $db->query('SELECT * FROM admin WHERE login = "'.$login.'"');
            $resultsAdmin = $queryAdmin->getResult();
            $resultsEmpresa = $queryEmpresa->getResult();

            //inicializando session
            $session = \Config\Services::session();
            $session = session();
            
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
           
        }
        public function logout(){
            $_SESSION['user'] = null;
            $_SESSION['senha'] = null;
            session()->destroy();
            $retorno = $this->index();
            return $retorno;
        }
        public function cadAdm(){
            $data['titulo'] = 'Inserir Novo ADM';
            $data['acao'] = 'Inserir';
            $data['msg'] = '';
            echo view ('header');
            echo view ('AdminSite/cadAdm', $data);
            echo view ('footer');
        }
        public function voltarPainelAdm(){
            
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
        ////////////////Ruas e Avenidas//////////////////
        public function tabelaRuas(){
                $ruaModel = new \App\Models\RuaModel();
                $data['rua'] = $ruaModel->find(); 
                $data['msg']='';                      
                echo view ('header');
                echo view ('AdminSite/Ruas/tabela', $data);
                echo view ('footer');
        }
        public function editarRua($cep = null){//metodo
                $data['titulo'] = 'Editar Rua '. $cep;
                $data['acao'] = 'Editar';
                $data['msg'] = '';
                $ruaModel = new \App\Models\RuaModel(); //criou um obj model
                
                $rua = $ruaModel->find($cep); // busca através deste método

                if($this->request->getMethod() === 'post'){
                    //quando o form for submetido
                    //vai pegar o valor inserido no forme pelo getPost e vai atribuir ao objeto
                   // $rua->cep = $this->request->getPost('cep'); 
                    $rua->nome = $this->request->getPost('nome');
                    //if para ver se att
                    if($ruaModel->update($cep, $rua)){
                        $data['msg'] = 'Sucesso';
                    }else{
                        $data['msg'] = 'Erro';
                    }
                }

                $data['rua'] = $rua; //passa pro data pra poder acessar em outras páginas 
                echo view('header');
                echo view('AdminSite/Ruas/cadRua', $data);/////////////////
                echo view('footer');
        }
        public function excluirRua($cep = null){
                if(is_null($cep)){
                    //definir uma msg via session
                    //flashdata tu acessa ela e ela se destroi
                    $this->session->setFlashdata('msg', 'Rua não encontrada');
                    $retorno = $this->tabelaRuas();
                    return $retorno;
                }
                $ruaModel = new \App\Models\RuaModel();
                if($ruaModel->delete($cep)){
                    //excluiu com sucesso
                    $data['msg'] = 'Sucesso';
                    $data['cod'] = 444;
                }else{
                    //erro ao excluir
                    $data['msg'] = 'Erro';   
                    $data['cod'] = 333;
                }
                $data['rua'] = $ruaModel->find();  

                echo view ('header');
                echo view ('AdminSite/Ruas/tabela', $data);
                echo view ('footer');
        }
        public function cadRua(){
                $data['titulo'] = 'Inserir Nova Rua';
                $data['acao'] = 'Inserir';
                $data['msg'] = '';
                echo view ('header');
                echo view ('AdminSite/Ruas/cadRua', $data);
                echo view ('footer');
        }
        public function inserirRua(){
                $data['titulo'] = 'Inserir Nova Rua';
                $data['acao'] = 'Inserir';
                if($this->request->getMethod() === 'post'){
                    //acessou a classe pelo namespace dela
                    $rua_model = new \App\Models\RuaModel(); //criou um obj model
                    //parametros (nomedacoluna, valor)
                    $rua_model->set('cep', $this->request->getPost('cep'));
                    $rua_model->set('nome', $this->request->getPost('nome'));

                    if($rua_model->find($this->request->getPost('cep')) != null){
                        $data['msg'] = 'Erro';
                        $data['cod'] = 222;
                    }else{
                        if($rua_model->insert()){
                            $data['msg'] = 'Sucesso';
                            $data['cod'] = 111;
                        }else{
                            $data['msg'] = 'Sucesso';
                            $data['cod'] = 111;
                        }
                    }
                }
                $data['rua'] = $rua_model->find(); 
                echo view ('header');
                echo view ('AdminSite/Ruas/tabela', $data);
                echo view ('footer');
        }
        ////////////////Pontos//////////////////
        public function tabelaPontos(){
            $pontoModel = new \App\Models\PontoModel();
            $data['ponto'] = $pontoModel->find(); 
            $data['msg'] = '';                     
            echo view ('header');
            echo view ('AdminSite/Ponto/tabela', $data); 
            echo view ('footer');
        }
        public function cadPonto(){
            $data['titulo'] = 'Inserir Novo Ponto';
            $data['acao'] = 'Inserir';
            $data['msg'] = '';
            $ruaModel = new \App\Models\RuaModel(); //criou um obj model
            $rua = $ruaModel->find();
            $data['rua_cep'] = $rua;

            echo view ('header');
            echo view ('AdminSite/Ponto/cadPonto', $data);
            echo view ('footer');
        }
        public function inserirPonto(){
            $ruaModel = new \App\Models\RuaModel(); //criou um obj model
            $rua = $ruaModel->find();
            $data['rua_cep'] = $rua;
            $data['titulo'] = 'Inserir Novo Ponto';
            $data['acao'] = 'Inserir';
            if($this->request->getMethod() === 'post'){
                //acessou a classe pelo namespace dela
                $ponto_model = new \App\Models\PontoModel(); //criou um obj model
                //parametros (nomedacoluna, valor)
                $ponto_model->set('endereco', $this->request->getPost('endereco'));
                $ponto_model->set('localizacao', $this->request->getPost('localizacao'));
                $ponto_model->set('rua_cep', $this->request->getPost('rua_cep'));

                if($ponto_model->insert()){
                    $data['msg'] = 'Sucesso';
                    $data['cod'] = 111;
                }else{
                    $data['msg'] = 'Erro';
                    $data['cod'] = 222;
                }
            }
            $data['ponto'] = $ponto_model->find(); 

            echo view ('header');
            echo view ('AdminSite/Ponto/tabela', $data);
            echo view ('footer');
        }
        public function editarPonto($id = null){//metodo
            $ruaModel = new \App\Models\RuaModel(); //criou um obj model
            $rua = $ruaModel->find();
            $data['rua_cep'] = $rua;
            $data['titulo'] = 'Editar Ponto '. $id;
            $data['acao'] = 'Editar';
            $data['msg'] = '';
            $pontoModel = new \App\Models\PontoModel(); //criou um obj model
            
            $ponto = $pontoModel->find($id); // busca através deste método

            if($this->request->getMethod() === 'post'){
                //quando o form for submetido
                //vai pegar o valor inserido no forme pelo getPost e vai atribuir ao objeto
                $ponto->endereco = $this->request->getPost('endereco'); 
                $ponto->localizacao = $this->request->getPost('localizacao');
                $ponto->rua_cep = $this->request->getPost('rua_cep');
                //if para ver se att
                if($pontoModel->update($id, $ponto)){
                    $data['msg'] = 'Sucesso';
                }else{
                    $data['msg'] = 'Erro';
                }
            }

            $data['ponto'] = $ponto; //passa pro data pra poder acessar em outras páginas 
            echo view('header');
            echo view('AdminSite/Ponto/cadPonto', $data);/////////////////
            echo view('footer');
        }
        public function excluirPonto($id = null){
            if(is_null($id)){
                //definir uma msg via session
                //flashdata tu acessa ela e ela se destroi
                $this->session->setFlashdata('msg', 'Ponto não encontrado');
                $retorno = $this->tabelaPontos();
                return $retorno;
            }
            $pontoModel = new \App\Models\PontoModel();
            if($pontoModel->delete($id)){
                //excluiu com sucesso
                $data['msg'] = 'Sucesso';
                $data['cod'] = 444;
            }else{
                //erro ao excluir
                $data['msg'] = 'Erro';
                $data['cod'] = 333;
            }
            $data['ponto'] = $pontoModel->find(); 

            echo view ('header');
            echo view ('AdminSite/Ponto/tabela', $data);
            echo view ('footer');
        }
        ////////////////Empresa//////////////////
        public function tabelaEmpresa(){
            $empresaModel = new \App\Models\EmpresaModel();
            $data['msg'] = '';
            $data['empresa'] = $empresaModel->find();   
                               
            echo view ('header');
            echo view ('AdminSite/Empresa/tabela', $data);
            echo view ('footer');
        }
        public function cadEmpresa(){
            $data['titulo'] = 'Inserir Nova Empresa';
            $data['acao'] = 'Inserir';
            $data['msg'] = '';

            echo view ('header');
            echo view ('AdminSite/Empresa/cadEmpresa', $data);
            echo view ('footer');
        }
        public function inserirEmpresa(){
            $db = \Config\Database::connect();
            $db = db_connect();
            $data['titulo'] = 'Inserir Nova Empresa';
            $data['acao'] = 'Inserir';
            if($this->request->getMethod() === 'post'){
                //acessou a classe pelo namespace dela
                $empresa_model = new \App\Models\EmpresaModel(); //criou um obj model
                //parametros (nomedacoluna, valor)
                $check = $empresa_model->find($this->request->getPost('id'));
                $empresaModel = new \App\Models\EmpresaModel(); //criou um obj model
                $senha = md5($this->request->getPost('senha'));
                $empresaModel->set('id', $this->request->getPost('id'));
                $empresaModel->set('login', $this->request->getPost('login'));
                $empresaModel->set('senha', $senha);
                $empresaModel->set('nome', $this->request->getPost('nome'));
                $empresaModel->set('numero', $this->request->getPost('numero'));

                if($check != null){
                    $data['msg'] = 'Erro';
                    $data['cod'] = 222;
                }else{
                    if($empresaModel->insert()){
                        $data['msg'] = 'Erro';
                    }else{
                        $data['msg'] = 'Sucesso';
                        $data['cod'] = 111;
                    }
                } 
            }

            $data['empresa'] = $empresa_model->find();                       
            echo view ('header');
            echo view ('AdminSite/Empresa/tabela', $data);
            echo view ('footer');
        }
        public function editarEmpresa($id = null){//metodo
            $data['titulo'] = 'Editar Empresa '. $id;
            $data['acao'] = 'Editar';
            $data['msg'] = '';
            $empresaModel = new \App\Models\EmpresaModel(); //criou um obj model
            
            $empresa = $empresaModel->find($id); // busca através deste método

            if($this->request->getMethod() === 'post'){
                //quando o form for submetido
                //vai pegar o valor inserido no forme pelo getPost e vai atribuir ao objeto
                $empresa->login = $this->request->getPost('login');
                $senha = md5($this->request->getPost('senha'));
                $empresa->senha = $senha;
                $empresa->nome = $this->request->getPost('nome');
                $empresa->numero = $this->request->getPost('numero');
                //if para ver se att
                if($empresaModel->update($id, $empresa)){
                    $data['msg'] = 'Sucesso';
                }else{
                    $data['msg'] = 'Erro';
                }
            }

            $data['empresa'] = $empresa; //passa pro data pra poder acessar em outras páginas 
            echo view('header');
            echo view('AdminSite/Empresa/cadEmpresa', $data);/////////////////
            echo view('footer');
        }
        public function excluirEmpresa($id = null){
            if(is_null($id)){
                //definir uma msg via session
                //flashdata tu acessa ela e ela se destroi
                $this->session->setFlashdata('msg', 'empresa não encontrada');
                $retorno = $this->tabelaEmpresa();
                return $retorno;
            }
            $empresaModel = new \App\Models\EmpresaModel();
            if($empresaModel->delete($id)){
                //excluiu com sucesso
                $data['msg'] = 'Sucesso';
                $data['cod'] = 444;
            }else{
                //erro ao excluir
                $data['msg'] = 'Erro';
                $data['cod'] = 333;
            }
            $data['empresa'] = $empresaModel->find(); 

            echo view ('header');
            echo view ('AdminSite/Empresa/tabela', $data);
            echo view ('footer');
        }

    }
?>


 