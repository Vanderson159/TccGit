
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
                    text-align: center;
                    margin-left: 22%;
                    margin-top: 25px;
                }
                .Reg{
                    text-align: center;
                    margin-left:39%;
                    margin-top: -2.5%;
                }
                .img{
                    margin-left: 82%;
                    margin-top: 25px;
                }
                #imgLabel{
                    margin-left: 77%;
                    margin-top: 20px;
                }
                td{
                    text-align: center;
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
                    height: 300px;
                }
                .trTable{
                    background-color: #ffcc00;
                }
                .table-wrapper {
                    overflow: scroll;
                    margin-right: 450px;
                    margin-top: -18%;
                    height: 320px;
                }
                .btn{
                    text-align: center;
                    margin-left: 22%;
                    margin-top: 25px;
                }
                .Reg{
                    text-align: center;
                    margin-left:40%;
                    margin-top: -3%;
                }
                .img{
                    margin-left: 80%;
                    margin-top: 25px;
                }
                #imgLabel{
                    margin-left: 74%;
                    margin-top: 20px;
                }
                td{
                    text-align: center;
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
                    margin-right: 450px;
                    margin-top: -20%;
                    height: 300px;

                }
                .btn{
                    text-align: center;
                    margin-left: 10%;
                    margin-top: 10px;
                }
                .Reg{
                    margin-left:35%;
                    margin-top: -3.5%;
                    text-align: center;
                }
                .img{
                    margin-left: 78%;
                    margin-top: 25px;
                } 
                #imgLabel{
                    margin-left: 70%;
                    margin-top: 10px;
                }
                .imgLetreiro{
                    margin-left:-5%;
                }
                td{
                    text-align: center;
                }
            }
        </style>
   
        <!--passa o controle e a função como parametros -->
       <!-- <p><a href="admin/inserir">+Inserir novo administrador</a></p> -->
<?php $session = session();?>
<?php if((isset($_SESSION['user'])) && ($_SESSION['userType'] == 'admEmpresa')) : ?>
    <?php 
        $login = $_SESSION['user'];
        $senha = $_SESSION['senha'];
    ?>
<div class="retangulo"> 
    <div class="imgLetreiro">
    <img class="img" src="<?php echo base_url("assets/IMG/adminEmpresa/gps.png")?>" alt="" width="250" height="200">
    <h2 id="imgLabel">Gerenciamento de Linhas</h2>
    </div>
    <div class="table-wrapper">
        <table class="tabela">
            <tr class="trTable">
                <td>Id</td>
                <td>Mapa</td>
                <td>Duração</td>
                <td>Passagens</td>
                <td>Empresa</td>
                <td></td>
                <td></td>
                <?php foreach ($linha as $linhas):?>
                    <tr>
                        <td><?php echo $linhas->id ?></td>  
                        <td><a href="<?php echo $linhas->mapa ?>" target="_blank">MY MAPS</a></td>
                        <td><?php echo $linhas->tempo ?></td>
                        <td><?php echo $linhas->passagens ?></td>
                        <td><?php echo $_SESSION['nomeEmp'] ?></td>
                        <td><a class="editar" href="<?php echo base_url('/public/adminEmpresa/editarLinha');?>/<?php echo $linhas->id?>">Editar</a></td>
                        <td><a href="<?php echo base_url('/public/adminEmpresa/excluirLinha');?>/<?php echo $linhas->id?>">Excluir</a></td>
                    </tr>                                  
                <?php endforeach ?>
            </tr>
        </table>
    </div>
    <ul>
       <ol>
            <a href="<?php echo base_url('public/adminEmpresa/cadLinha');?>"><button class="btn btn-lg" style="width: 210px;">Inserir Linha</button></a>
       </ol>
       <ol>
            <a href="<?php echo base_url('public/adminEmpresa/voltarPainelAdmEmpresa');?>"><button class="btn Reg btn-lg" style="width: 210px;">Regressar ao Painel</button></a>
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