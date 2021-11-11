

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
                    margin-left: 78%;
                    margin-top: 20px;
                }
                td{
                    text-align: center;
                }
                .alert{
                    width: 2000px;
                    height: 20px;
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
                    margin-left: 50px;
                    width: 900px;
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
                    width: 980px;
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
                    margin-left: 77%;
                    margin-top: 20px;
                }
                td{
                    text-align: center;
                }
                .alert{
                    width: 2000px;
                    height: 20px;
                }
            }
        </style>
   
        <!--passa o controle e a função como parametros -->
       <!-- <p><a href="admin/inserir">+Inserir novo administrador</a></p> -->
<?php $session = session();?>
<?php if((isset($result))) : ?>
<div class="retangulo"> 
    <div class="imgLetreiro">
    <img class="img" src="<?php echo base_url("assets/IMG/adminEmpresa/gps.png")?>" alt="" width="200" height="200">
    <h2 id="imgLabel">Linhas de Alegrete</h2>
    </div>
    <div class="table-wrapper">
        <table class="tabela">
            <tr class="trTable">
                <td>Linha</td>
                <td>Empresa</td>
                <td></td>
                <?php foreach ($result as $results):?>
                    <tr>
                        <td><?php echo $results->nome ?></td>  
                        <td><?php echo $results->empresa ?></td>
                        <td style="text-align: center;"><a href="<?php echo base_url('/public/home/escolha');?>/<?php echo $results->id?>">Visualizar</a></td>
                    </tr>  
                    <tr>
                        <td><?php echo $results->nome ?></td>  
                        <td><?php echo $results->empresa ?></td>
                        <td style="text-align: center;"><a href="<?php echo base_url('/public/home/escolha');?>/<?php echo $results->id?>">Visualizar</a></td>
                    </tr>                                  
                <?php endforeach ?>
            </tr>
        </table>
    </div>
</div>
<?php else : ?>
    <?php 
        echo view('header');
        echo view('site');
        echo view('footer');
    ?>
<?php endif ?>
