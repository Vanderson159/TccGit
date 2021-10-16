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
                    margin-left: 15%;
                    margin-top: 4%;
                    width: 1050px;
                    height: 300px;
                }
                .trTable{
                    background-color: #ffcc00;
                }
                .table-wrapper {
                    overflow: scroll;
                    margin-right: 450px;
                    margin-top: -1%;
                    height: 350px;
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
                    <?php 
                        // convertendo o tempo da linha em minutos
                        $tempo = strtotime($result[0]->tempo); 
                        $horasLinha =  strftime('%H', $tempo);
                        $minutosLinha =  strftime('%M', $tempo);
                        $segundosLinha =  strftime('%S', $tempo);
                        if($horasLinha > 0){
                            $horasLinha = $horasLinha * 60;
                        }
                        if($segundosLinha > 0){
                            $segundosLinha = $segundosLinha / 60;
                        }
                        $tempo = $minutosLinha + $horasLinha + $segundosLinha;
                        $contador = 0;
                        $contadorTeste = 8;
                        $contadorM = 0;
                        $validacao = false;

                    ?>
<div class="retangulo">
    <div class="table-wrapper">
        <table class="tabela">
            <tr class="trTable">
                <td style="text-align: center;">Manhã</td>
                <td style="text-align: center;">Tarde</td>
                <?php foreach ($result as $results):?>
                    <?php $timestamp = strtotime($results->manha) + 60*$tempo; ?>
                    <?php $dataHora = strftime('%H:%M:%S', $timestamp); ?>
                    
                    <?php $timestamp = strtotime($results->tarde) + 60*$tempo; ?>
                    <?php $dataHoraT = strftime('%H:%M:%S', $timestamp); ?>

                    <?php while($validacao == false):?>
                        <tr>
                            <?php if($contador == 0):?>
                                <td style="text-align: center;"><?php echo $results->manha?></td>
                                <td style="text-align: center;"><?php echo $results->tarde?></td>
                                <?php $contador++;?>                    
                            <?php endif?>
                        </tr>
                        <tr>
                            <?php if($dataHora < 12 || $dataHoraT < 20):?>
                                <?php if($dataHora < 12):?>
                                    <td style="text-align: center;"><?php echo $dataHora?></td>
                                <?php else : ?>
                                    <td style="text-align: center;"></td>
                                <?php endif?>
                                <?php if($dataHoraT < 20):?>
                                    <td style="text-align: center;"><?php echo $dataHoraT?></td>
                                <?php else : ?>
                                    <td style="text-align: center;"></td>
                                <?php endif?>
                            <?php else : ?>
                                <?php $validacao = true;?>
                            <?php endif?>
                        </tr>
                        
                        <?php $timestamp = strtotime($dataHora) + 60*$tempo; ?>
                        <?php $dataHora = strftime('%H:%M:%S', $timestamp); ?>
                        <?php $timestamp = strtotime($dataHoraT) + 60*$tempo; ?>
                        <?php $dataHoraT = strftime('%H:%M:%S', $timestamp); ?>
                        <?php $contadorTeste--; ?>
                    <?php endwhile;?>
                <?php endforeach ?>
            </tr>
        </table>
    </div>
</div>



