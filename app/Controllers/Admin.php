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
             //chamar view que exibe todas as categorias
             $adminModel = new \App\Models\AdminModel();
             $data['adm'] = $adminModel->find();//busca todas as categorias e coloca em um array como objetos                         
             echo view ('header');
             echo view ('AdminSite/tabela', $data); // a posição do array data é categorias
             echo view ('footer');
        }
        public function index(){
            //$data['msg'] = $this->session->getFlashdata('msg'); //tentativa de mensagem de erro
            echo view ('header');
            echo view ('login');
            echo view ('footer'); 
        }
        public function inserir(){
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

                if($admin_model->insert()){
                    //deu certo
                    $data['msg'] = 'Administrador cadastrado com sucesso';
                }else{
                    //deu errado
                    $data['msg'] = 'Erro ao cadastrar administrador';
                }
            }
            echo view ('header');
            echo view ('AdminSite/cadAdm', $data);
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
                     $data['msg'] = 'ADM editada com sucesso';
                }else{
                    $data['msg'] = 'Erro ao editar ADM';
                }
            }

            $data['admin'] = $admin; //passa pro data pra poder acessar em outras páginas 
            echo view('header');
            echo view('AdminSite/cadAdm', $data);
            echo view('footer');
        }
        public function excluir($id = null){
            if(is_null($id)){
                //redirecionar a aplicação para o categoria index    view das listas
                //definir uma msg via session
                //flashdata tu acessa ela e ela se destroi
                $this->session->setFlashdata('msg', 'Adm não encontrado');
                $retorno = $this->tabela();
                return $retorno;
            }
            $adminModel = new \App\Models\AdminModel();
            if($adminModel->delete($id)){
                //excluiu com sucesso
                $this->session->setFlashdata('msg', 'Administrador excluido com sucesso');
            }else{
                //erro ao excluir
                $this->session->setFlashdata('msg', 'Erro ao excluir administrador');
            }
            $retorno = $this->tabela();
            return $retorno;
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
            $data['titulo'] = 'Inserir Nova Categoria';
            $data['acao'] = 'Inserir';
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
                                $_SESSION['user'] = $resultsEmpresa;

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
                //chamar view que exibe todas as categorias
                $ruaModel = new \App\Models\RuaModel();
                $data['rua'] = $ruaModel->find();//busca todas as categorias e coloca em um array como objetos                         
                echo view ('header');
                echo view ('AdminSite/Ruas/tabela', $data); // a posição do array data é categorias
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
                    $rua->cep = $this->request->getPost('cep'); 
                    $rua->nome = $this->request->getPost('nome');
                    //if para ver se att
                    if($ruaModel->update($cep, $rua)){
                        $data['msg'] = 'Rua editada com sucesso';
                    }else{
                        $data['msg'] = 'Erro ao editar Rua';
                    }
                }

                $data['rua'] = $rua; //passa pro data pra poder acessar em outras páginas 
                echo view('header');
                echo view('AdminSite/Ruas/cadRua', $data);/////////////////
                echo view('footer');
        }
        public function excluirRua($cep = null){
                if(is_null($cep)){
                    //redirecionar a aplicação para o categoria index    view das listas
                    //definir uma msg via session
                    //flashdata tu acessa ela e ela se destroi
                    $this->session->setFlashdata('msg', 'Rua não encontrada');
                    $retorno = $this->tabelaRuas();
                    return $retorno;
                }
                $ruaModel = new \App\Models\RuaModel();
                if($ruaModel->delete($cep)){
                    //excluiu com sucesso
                    $this->session->setFlashdata('msg', 'Rua excluida com sucesso');
                }else{
                    //erro ao excluir
                    $this->session->setFlashdata('msg', 'Erro ao excluir rua');
                }
                $retorno = $this->tabelaRuas();
                return $retorno;
        }
        public function cadRua(){
                $data['titulo'] = 'Inserir Nova Rua';
                $data['acao'] = 'Inserir';
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

                    if($rua_model->insert()){
                        //deu certo
                        $data['msg'] = 'Rua cadastrada com sucesso';
                    }else{
                        //deu errado
                        $data['msg'] = 'Erro ao cadastrar rua';
                    }
                }
                echo view ('header');
                echo view ('AdminSite/Ruas/cadRua', $data);
                echo view ('footer');
        }
        ////////////////Pontos//////////////////
        public function tabelaPontos(){
            //chamar view que exibe todas as categorias
            $pontoModel = new \App\Models\PontoModel();
            $data['ponto'] = $pontoModel->find();//busca todas as categorias e coloca em um array como objetos                         
            echo view ('header');
            echo view ('AdminSite/Ponto/tabela', $data); // a posição do array data é categorias
            echo view ('footer');
        }
        public function cadPonto(){
            $data['titulo'] = 'Inserir Novo Ponto';
            $data['acao'] = 'Inserir';
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
                    //deu certo
                    $data['msg'] = 'Ponto cadastrado com sucesso';
                }else{
                    //deu errado
                    $data['msg'] = 'Erro ao cadastrar Ponto';
                }
            }
            echo view ('header');
            echo view ('AdminSite/Ponto/cadPonto', $data);
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
                    $data['msg'] = 'Ponto editado com sucesso';
                }else{
                    $data['msg'] = 'Erro ao editar Ponto';
                }
            }

            $data['ponto'] = $ponto; //passa pro data pra poder acessar em outras páginas 
            echo view('header');
            echo view('AdminSite/Ponto/cadPonto', $data);/////////////////
            echo view('footer');
        }
        public function excluirPonto($id = null){
            if(is_null($id)){
                //redirecionar a aplicação para o categoria index    view das listas
                //definir uma msg via session
                //flashdata tu acessa ela e ela se destroi
                $this->session->setFlashdata('msg', 'Ponto não encontrado');
                $retorno = $this->tabelaPontos();
                return $retorno;
            }
            $pontoModel = new \App\Models\PontoModel();
            if($pontoModel->delete($id)){
                //excluiu com sucesso
                $this->session->setFlashdata('msg', 'Ponto excluido com sucesso');
            }else{
                //erro ao excluir
                $this->session->setFlashdata('msg', 'Erro ao excluir Ponto');
            }
            $retorno = $this->tabelaPontos();
            return $retorno;
        }
        ////////////////Empresa//////////////////
        public function tabelaEmpresa(){
            //chamar view que exibe todas as categorias
            $empresaModel = new \App\Models\EmpresaModel();
            $data['empresa'] = $empresaModel->find();//busca todas as categorias e coloca em um array como objetos                         
            echo view ('header');
            echo view ('AdminSite/Empresa/tabela', $data); // a posição do array data é categorias
            echo view ('footer');
        }
        public function cadEmpresa(){
            $data['titulo'] = 'Inserir Nova Empresa';
            $data['acao'] = 'Inserir';

            echo view ('header');
            echo view ('AdminSite/Empresa/cadEmpresa', $data);
            echo view ('footer');
        }
        public function inserirEmpresa(){
            $data['titulo'] = 'Inserir Nova Empresa';
            $data['acao'] = 'Inserir';
            if($this->request->getMethod() === 'post'){
                //acessou a classe pelo namespace dela
                $empresa_model = new \App\Models\EmpresaModel(); //criou um obj model
                //parametros (nomedacoluna, valor)
                $senha = md5($this->request->getPost('senha'));
                $empresa_model->set('id', $this->request->getPost('id'));
                $empresa_model->set('login', $this->request->getPost('login'));
                $empresa_model->set('senha', $senha);
                $empresa_model->set('nome', $this->request->getPost('nome'));

                if($empresa_model->insert()){
                    //deu certo
                    $data['msg'] = 'Empresa cadastrada com sucesso';
                }else{
                    //deu errado
                    $data['msg'] = 'Erro ao cadastrar Empresa';
                }
            }
            echo view ('header');
            echo view ('AdminSite/Empresa/cadEmpresa', $data);
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
                //if para ver se att
                if($empresaModel->update($id, $empresa)){
                    $data['msg'] = 'Empresa editada com sucesso';
                }else{
                    $data['msg'] = 'Erro ao editar Empresa';
                }
            }

            $data['empresa'] = $empresa; //passa pro data pra poder acessar em outras páginas 
            echo view('header');
            echo view('AdminSite/Empresa/cadEmpresa', $data);/////////////////
            echo view('footer');
        }
        public function excluirEmpresa($id = null){
            if(is_null($id)){
                //redirecionar a aplicação para o categoria index    view das listas
                //definir uma msg via session
                //flashdata tu acessa ela e ela se destroi
                $this->session->setFlashdata('msg', 'Empresa não encontrado');
                $retorno = $this->tabelaEmpresa();
                return $retorno;
            }
            $empresaModel = new \App\Models\EmpresaModel();
            if($empresaModel->delete($id)){
                //excluiu com sucesso
                $this->session->setFlashdata('msg', 'Empresa excluida com sucesso');
            }else{
                //erro ao excluir
                $this->session->setFlashdata('msg', 'Erro ao excluir Empresa');
            }
            $retorno = $this->tabelaEmpresa();
            return $retorno;
        }
    }
?>


 