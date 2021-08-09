<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<style>
            @media screen and (max-width: 1920px){
                .tabela, .tabela td, .tabela tr{
                    border: 1px solid; 
                }
                .tabela{
                    background-color: white;
                    color: black;
                    font-size: 20;
                    font-weight: bold;
                    margin-left: 120px;
                    width: 1050px;
                    height: 500px;
                }
                .trTable{
                    background-color: #ffcc00;
                }
                .table-wrapper {
                    overflow: scroll;
                    margin-right: 500px;
                    margin-top: -14%;   
                    height: 450px;

                }
                .btn{
                    margin-left: 22%;
                    margin-top: 25px;
                }
                .Reg{
                    margin-left:40%;
                    margin-top: -2.5%;
                }
                .img{
                    margin-left: 82%;
                    margin-top: 25px;
                }
                #imgLabel{
                    margin-left: 80.5%;
                    margin-top: 20px;
                }
            }
            @media screen and (max-width: 1600px){
                .tabela, .tabela td, .tabela tr{
                    border: 1px solid; 
                }
                .tabela{
                    background-color: white;
                    color: black;
                    font-size: 20;
                    font-weight: bold;
                    margin-left: 50px;
                    width: 1050px;
                    height: 400px;
                }
                .trTable{
                    background-color: #ffcc00;
                }
                .table-wrapper {
                    overflow: scroll;
                    margin-right: 500px;
                    margin-top: -18%;
                    height: 320px;
                }
                .btn{
                    margin-left: 22%;
                    margin-top: 25px;
                }
                .Reg{
                    margin-left:40%;
                    margin-top: -3%;
                }
                .img{
                    margin-left: 80%;
                    margin-top: 25px;
                }
                #imgLabel{
                    margin-left: 73%;
                    margin-top: 20px;
                }
            }
            @media screen and (max-width: 1366px){
                .tabela, .tabela td, .tabela tr{
                    border: 1px solid; 
                }
                .tabela{
                    background-color: white;
                    color: black;
                    font-size: 20;
                    font-weight: bold;
                    margin-left: 30px;
                    width: 835px;
                    height: 200px;
                }
                .trTable{
                    background-color: #ffcc00;
                }
                .table-wrapper {
                    overflow: scroll;
                    margin-right: 500px;
                    margin-top: -20%;
                    height: 300px;

                }
                .btn{
                    margin-left: 10%;
                    margin-top: 10px;
                }
                .Reg{
                    margin-left:35%;
                    margin-top: -3.5%;
                }
                .img{
                    margin-left: 77%;
                    margin-top: 25px;
                } 
                #imgLabel{
                    margin-left: 68%;
                    margin-top: 10px;
                }
               
            }
        </style>
   
        <!--passa o controle e a função como parametros -->
       <!-- <p><a href="admin/inserir">+Inserir novo administrador</a></p> -->
<?php $session = session();?>
<?php if(isset($_SESSION['user'])) : ?>
    <?php 
        $login = $_SESSION['user'];
        $senha = $_SESSION['senha'];
    ?>
<div class="retangulo"> 
    <img class="img" src="<?php echo base_url("assets/IMG/adminSite/empresa.png")?>" alt="" width="200" height="200">
    <h2 id="imgLabel">Gerenciamento de Empresas</h2>
    <div class="table-wrapper">
        <table class="tabela">
            <tr class="trTable">
                <td>Id (CNPJ)</td>
                <td>Login</td>
                <td>Senha</td>
                <td>Nome</td>
                <td></td>
                <td></td>
                <?php foreach ($empresa as $empresas):?>
                    <tr>
                        <td><?php echo $empresas->id ?></td>  
                        <td><?php echo $empresas->nome ?></td>
                        <td><?php echo $empresas->login ?></td>
                        <td><?php echo $empresas->senha ?></td>    
                        <td><a class="editar" href="<?php echo base_url('/public/admin/editarEmpresa');?>/<?php echo $empresas->id?>">Editar</a></td>
                        <td><a href="<?php echo base_url('/public/admin/excluirEmpresa');?>/<?php echo $empresas->id?>">Excluir</a></td>
                    </tr> 
                    <tr>
                        <td><?php echo $empresas->id ?></td>  
                        <td><?php echo $empresas->nome ?></td>
                        <td><?php echo $empresas->login ?></td>
                        <td><?php echo $empresas->senha ?></td>    
                        <td><a class="editar" href="<?php echo base_url('/public/admin/editarEmpresa');?>/<?php echo $empresas->id?>">Editar</a></td>
                        <td><a href="<?php echo base_url('/public/admin/excluirEmpresa');?>/<?php echo $empresas->id?>">Excluir</a></td>
                    </tr>  
                    <tr>
                        <td><?php echo $empresas->id ?></td>  
                        <td><?php echo $empresas->nome ?></td>
                        <td><?php echo $empresas->login ?></td>
                        <td><?php echo $empresas->senha ?></td>    
                        <td><a class="editar" href="<?php echo base_url('/public/admin/editarEmpresa');?>/<?php echo $empresas->id?>">Editar</a></td>
                        <td><a href="<?php echo base_url('/public/admin/excluirEmpresa');?>/<?php echo $empresas->id?>">Excluir</a></td>
                    </tr>                                     
                <?php endforeach ?>
            </tr>
        </table>
    </div>
    <ul>
       <ol>
            <a href="<?php echo base_url('public/admin/cadEmpresa');?>"><button class="btn btn-lg" style="width: 200px;">Inserir Empresa</button></a>
       </ol>
       <ol>
            <a href="<?php echo base_url('public/admin/voltarPainelAdm');?>"><button class="btn Reg btn-lg" style="width: 200px;">Regressar ao Painel</button></a>
       </ol>
    </ul>
</div>
<?php else : ?>
    <?php 
        echo view('header');
        echo view('login');
        echo view('footer');
    ?>
<?php endif ?>