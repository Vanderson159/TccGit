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
                    width: 1200px;
                    height: 500px;
                }
                .trTable{
                    background-color: #ffcc00;
                }
                .table-wrapper {
                    overflow: scroll;
                    margin-right: 200px;
                    margin-top: -14%;   
                    height: 450px;

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
                    margin-left: 90px;
                    width: 1050px;
                    height: 400px;
                }
                .trTable{
                    background-color: #ffcc00;
                }
                .table-wrapper {
                    overflow: scroll;
                    margin-right: 300px;
                    margin-top: 3%;
                    height: 320px;
                }
                .base{
                    margin-left: 8%;
                }
                .letreiro{
                    background-color: #ffcc00;
                    width: 1050px;
                    margin-left: 8%;
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
<div class="retangulo">
    <div class="base">
    <div class="table-wrapper">
        <h1 class="letreiro" style="text-align: center;">Ônibus: <?php echo $result[0]->nome ?></h1>
        <table class="tabela">
            <tr class="trTable">
                <td style="text-align: center;">Pontos</td>
                <td style="text-align: center;">Horários</td>
                <?php foreach ($ponto as $pontos):?>
                    <tr>
                        <td style="text-align: center;"><?php echo $pontos->endereco?></td>
                        <td style="text-align: center;"><a href="<?php echo base_url('/public/home/onibusHorario');?>/<?php echo $pontos->id?>/<?php echo $idBus?>">Visualizar</a></td>
                    </tr> 
                <?php endforeach ?>
            </tr>
        </table>
    </div>
    </div>
</div>