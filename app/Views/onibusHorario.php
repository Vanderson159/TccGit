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
                    margin-left: 5%;
                    margin-top:1%;
                    width: 1050px;
                    height: 300px;
                }
                .trTable{
                    background-color: #ffcc00;
                }
                .table-wrapper {
                    overflow: scroll;
                    margin-right: 450px;
                    margin-top: -14%;
                    height: 360px;
                }
                .btn{
                    text-align: center;
                    margin-left: 80.5%;
                    margin-top: -70px;
                    width: 200px;
                }
                .Reg{
                    text-align: center;
                    margin-left:40%;
                    margin-top: -3%;
                }
                .img{
                    margin-left: 80%;
                    margin-top: 15px;
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
                h1{
                    text-align: center;
                }
                .btnAlert{
                    margin-left: 85%;
                    margin-top: -5%;
                    background-image: url(<?php echo base_url("assets/IMG/adminEmpresa/alerta.png")?>);
                    width: 30;
                    height: 30;
                    background-size: contain;
                    background-position: center;
                    background-repeat: no-repeat;
                    background-color: #BCB9B9;
                    border: none;
                }
                .btnAlert:hover{
                    margin-left: 85%;
                    margin-top: -5%;
                    background-image: url(<?php echo base_url("assets/IMG/adminEmpresa/alertaRed.png")?>);
                    width: 30;
                    height: 30;
                    background-size: contain;
                    background-position: center;
                    background-repeat: no-repeat;
                    background-color: #BCB9B9;
                    border: none;
                }
                
                .hide {
                    display: none;
                }

                .modal-bg {
                    position: fixed;
                    top: 0px;
                    right: 0px;
                    bottom: 0px;
                    left: 0px;
                    background: gainsboro;
                    opacity: 0.7;
                }

                .modal-content {
                    position: fixed;
                    margin: 0 auto;
                    width: 500px;
                    height: 200px;
                    top: 50px;
                    right: 0px;
                    bottom: 0px;
                    left: 0px;
                    background: #BCB9B9;
                    box-shadow: 0px 0px 10px black;
                    border-radius: 5px;
                    padding: 5px;
                    margin-top: 5%;
                }

                .modal-close {
                    font-size: 2rem;
                    line-height: 1;
                    position: absolute;
                    top: 0px;
                    right: 5px;
                    font-weight: bold;
                    cursor: pointer;
                    color: #AAAAAA;
                    font-family: 'Helvetica Neue', Helvetica, Helvetica, Arial, sans-serif;
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class="retangulo">
    <h1>Horários</h1>
    <img class="img" src="<?php echo base_url("assets/IMG/adminEmpresa/relógio.png")?>" alt="" width="200" height="200">
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
        <div id="modal" class="hide">
            <div class="modal-bg"></div>
            <div class="modal-content">
                <h3>Aviso</h3>
                <p style="color: black; font-family: Arial;">Os horários informados não são 100% precisos, porque podem ocorrer imprevistos, 
                como por exemplo: o ônibus estragar, motorista ou cobrador não comparecerem; resultando assim no atraso da rota. Entre diversos
                outros imprevistos.</p>
                <a class="modal-close">&#215;</a>
            </div>
        </div>
    <button id="btAbrirModal" class="btn btn-lg" type="submit">Aviso</button>

</div>
 <!-- jQUery-->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Ação para ocultar a div depois de 5 segundos -->
<script>
	$("#alert").hide(5000);
</script>

<script type="text/javascript">
        //btn de aviso
        var btAbrirModal = $("#btAbrirModal");
        var modal = $("#modal");
        var modalClose = $("#modal .modal-close");
        var modalBackground = $("#modal .modal-bg");
        btAbrirModal.click(function () {
            modal.fadeIn(500);
        });

        modalClose.click(function () {
            modal.fadeOut(500);
        });

        //Caso queira que o dialogo feche ao realizar um click fora dele.
        modalBackground.click(function () {
            modal.fadeOut(500);
        });
</script>


