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
                    margin-right: 450px;
                    margin-top: -18%;
                    height: 320px;
                }
                .btn{
                    margin-left: 22%;
                    margin-top: 25px;
                }
                .Reg{
                    margin-left:30%;
                    margin-top: 3%;
                }
                .img{
                    margin-left: 80%;
                    margin-top: 25px;
                }
                #imgLabel{
                    margin-left: 75%;
                    margin-top: 20px;
                }
                .alert{
                    width: 2000px;
                    height: 45px;
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
                    margin-left: 71%;
                    margin-top: 10px;
                }
                .imgLetreiro{
                    margin-left:-5%;
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
        <?php if($msg == 'Sucesso' && $cod == 111) : ?>
            <div class="alert alert-success" id="alert" role="alert" style="text-align: center;">
                Ponto inserido com sucesso!
            </div>
        <?php endif ?>
        <?php if($msg == 'Sucesso' && $cod == 444) : ?>
            <div class="alert alert-success" id="alert" role="alert" style="text-align: center;">
                Ponto deletado com sucesso!
            </div>
        <?php endif ?>
        <?php if($msg == 'Erro'  && $cod == 222) : ?>
            <div class="alert alert-danger" id="alert" role="alert" style="text-align: center;">
                Erro ao tentar inserir ponto!
            </div>
        <?php endif ?>
        <?php if($msg == 'Erro' && $cod == 333) : ?>
            <div class="alert alert-danger" id="alert" role="alert" style="text-align: center;">
                Erro ao tentar excluir ponto!
            </div>
        <?php endif ?>
<div class="retangulo"> 
    <img class="img" src="<?php echo base_url("assets/IMG/adminSite/pontoOnibus.png")?>" alt="" width="200" height="200">
    <h2 id="imgLabel">Pontos Associados a Linha</h2>
    <div class="table-wrapper">
        <table class="tabela">
            <tr class="trTable">
                <td>Id</td>
                <td>Endereço</td>
                <td>Localização</td>
                <td>Cep Rua</td>
                <td>Manhã</td>
                <td>Tarde</td>
                <td></td>
                <td></td>
                <?php foreach ($ponto as $pontos):?>
                    <tr>
                        <td><?php echo $pontos->id ?></td>  
                        <td><?php echo $pontos->endereco ?></td>
                        <td><a href="<?php echo $pontos->localizacao ?>" target="_blank">GOOGLE MAPS</a></td>
                        <td><?php echo $pontos->rua_cep ?></td>
                        <td><?php echo $pontos->manha ?></td>
                        <td><?php echo $pontos->tarde ?></td>
                        <td><a href="<?php echo base_url('/public/adminEmpresa/pontosLinhaEdit');?>/<?php echo $pontos->id?>">Editar</a></td>
                        <td><a href="<?php echo base_url('/public/adminEmpresa/pontosLinhaDelete');?>/<?php echo $pontos->id?>">Excluir</a></td>
                    </tr>                                  
                <?php endforeach ?>
            </tr>
        </table>
    </div>
    <ul>
       <ol>
            <a href="<?php echo base_url('public/adminEmpresa/tabelaLinha');?>"><button class="btn Reg btn-lg" style="width: 200px;">Regressar ao Painel</button></a>
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
 <!-- jQUery-->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Ação para ocultar a div depois de 5 segundos -->
<script>
	$("#alert").hide(5000);
</script>