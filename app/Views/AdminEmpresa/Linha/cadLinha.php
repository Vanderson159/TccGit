<META HTTP-EQUIV="Pragma" CONTENT="no-cache">

<style>
    @media screen and (max-width: 1920px){
        h1{
            text-align: center;
        }

        .divCampos{
            margin-left: 25%;
        }

        .form-control{
            width: 200px;
            margin-top: -37px;
            margin-left: 65px;
        }
        
        .label{
            font-weight: bold;
            font-size: large;
        }
        .voltar{
            margin-left: 9%;
            margin-top: -5.8%;
        }
        .img{
            margin-left: 52%;
            margin-top: 25px;
        }
        #formInserir{
            margin-top: -13%;
            margin-left: 5%;
        }
    }
    @media screen and (max-width: 1600px){
        h1{
            text-align: center;
        }

        .divCampos{
            margin-left: 25%;

        }

        .form-control{
            width: 200px;
            margin-top: -37px;
            margin-left: 65px;
        }
        
        .label{
            margin-left: -3%;
            font-weight: bold;
            font-size: large;
        }
        .labelEmpresa{
            margin-top: 1%;
            margin-left: 0;
            font-weight: bold;
            font-size: large;
        }
        .voltar{
            margin-left: 11%;
            margin-top: -7.1%;
        }
        .img{
            margin-left: 56%;
            margin-top: 50px;
        }
        #formInserir{
            margin-top: -13%;
            margin-left: 5%;
        }
        
        .inputEmpresa{
            margin-left: 11%;
            margin-top: -5%;
        }
        .acoes{
            margin-top: 16%;
        }
        .inputs{
            margin-top: -22%;
        }
        .btnAlert{
            margin-left: 50%;
            margin-top: -11.7%;
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
            margin-left: 50%;
            margin-top: -11.7%;
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
            width: 800px;
            height: 500;
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
        .video{
            margin-left: 5%;
        }
        .alert{
            width: 2000px;
            height: 50px;
        }
        .empresa{
            margin-left: 27%;
            margin-top: -20%;
        }
    }
    @media screen and (max-width: 1366px){
        h1{
            text-align: center;
        }

        .divCampos{
            margin-left: 25%;
            margin-top: -14%;
        }

        .form-control{
            width: 200px;
            margin-top: -37px;
            margin-left: 65px;
        }
        
        .label{
            font-weight: bold;
            font-size: large;
        }
        .voltar{
            margin-left: 11%;
            margin-top: -8.5%;
        }
        .img{
            margin-left: 78%;
            margin-top: -15px;
        }
        #formInserir{
            margin-top: -13%;
            margin-left: 5%;
        }
        .empresa{
            margin-left: 30%;
            margin-top: -24%;
        }
        .inputEmpresa{
            margin-left: 15%;
            margin-top: -6.5%;
        }
        .labelEmpresa{
            margin-top: 2%;
            margin-left: 0;
            font-weight: bold;
            font-size: large;
        }
        .btnAlert{
            margin-left: 55%;
            margin-top: -11.7%;
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
            margin-left: 55%;
            margin-top: -11.7%;
            background-image: url(<?php echo base_url("assets/IMG/adminEmpresa/alertaRed.png")?>);
            width: 30;
            height: 30;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #BCB9B9;
            border: none;
        }
        .acoes{
            margin-top: 20%;
        }
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<?php $session = session();?>
<?php if(isset($_SESSION['user'])) : ?>
        <?php if($msg == 'Sucesso') : ?>
            <div class="alert alert-success" id="alert" role="alert" style="text-align: center;">
                Linha inserida com sucesso!
            </div>
        <?php endif ?>
        <?php if($msg == 'Erro') : ?>
            <div class="alert alert-danger" id="alert" role="alert" style="text-align: center;">
                Erro ao tentar inserir Linha!
            </div>
        <?php endif ?>
    <div class="retangulo" id="retangulo"> 
        <h1><?php echo $titulo; ?></h1>
        <br>
        <img class="img" src="<?php echo base_url("assets/IMG/adminEmpresa/gps.png")?>" alt="" width="200" height="200">
        <button class="btnAlert" id="btAbrirModal"></button>
        <!--div da mensagem de alerta-->
        <div id="modal" class="hide">
            <div class="modal-bg"></div>
            <div class="modal-content">
                <a href="https://www.google.com/intl/pt-BR/maps/about/mymaps/" target="_blank"><h3>MyMaps</h3></a>
                <p style="color: black; font-family: Arial;">Neste campo você deve inserir o link que esta no iframe ao gerar seu mapa no site do  <a href="https://www.google.com/intl/pt-BR/maps/about/mymaps/" target="_blank">MyMaps</a>.
                Tutorial de como gerar o iframe:</p>
                    <video width="700" height="340" controls="controls" autoplay="autoplay" class="video">
                        <source src="<?php echo base_url("assets/VIDEO/Tutorial.mp4")?>" type="video/mp4">
                        <object data="" width="320" height="240">
                        <embed width="320" height="240" src="Yes Bank Advertisment.mp4">
                        </object>
                    </video>
                <a class="modal-close">&#215;</a>
            </div>
        </div>
        <div class="divCampos">
        <?php
            if($acao == "Inserir"){
                $form = base_url("public/adminEmpresa/inserirLinha");
                $statusId = "Enabled";
                $statusEmpresa = "Disabled";
            }else{
                if($acao == "Editar"){
                    $form = "";
                    $statusId = "Disabled";
                    $statusEmpresa = "Disabled";
                }
            }
        ?>
        <form id="formInserir"  method="post" action="<?php echo $form?>">
            <ul class="inputs">
                <ol>
                    <label class="label">Id:&nbsp;&nbsp;</label>
                    <input name="id" id="id" type="text" class="form-control" value="<?php echo (isset($linha) ? $linha->id : '2968')?>" placeholder="ID da Linha" required autofocus <?php echo $statusId?>>
                </ol>
                <br>
                <ol>
                    <label class="label">Mapa:&nbsp;&nbsp;</label>
                    <input name="mapa" id="mapa" type="text" class="form-control" value="<?php echo (isset($linha) ? $linha->mapa : 'MyMaps')?>" placeholder="Link do Mapa" required autofocus>
                </ol>
                <br>
                <ol>
                    <label class="label">Duração:&nbsp;&nbsp;</label>
                    <input name="tempo" id="tempo" type="time" class="form-control" value="00:30"  required  autofocus>
                </ol>
                <br>
                <ol>
                    <label class="label">Passagens:&nbsp;&nbsp;</label>
                    <input name="passagens" id="passagens" type="double" class="form-control" value="<?php echo (isset($linha) ? $linha->passagens : '3.75')?>" placeholder="3.75" required autofocus>
                </ol>
                <ol class="empresa">
                    <label class="labelEmpresa">Empresa:&nbsp;&nbsp;</label>
                    <input name="empresa" id="empresa" type="text" class="form-control inputEmpresa" value="<?php echo $_SESSION['nomeEmp']?>" placeholder="1001" required autofocus <?php echo $statusEmpresa?>>
                </ol>
            <ul>
            <br>
            <ul class="acoes">
                <ol>
                    <button class="btn btn-lg" type="submit">Salvar</button>
                </ol>
                <br>
                <ol>
                    <a href=" <?php echo base_url('public/adminEmpresa/tabelaLinha')?>"><label class="btn btn-lg voltar">Voltar</label></a>
                </ol>
            </ul>
        </form>
        </div>
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