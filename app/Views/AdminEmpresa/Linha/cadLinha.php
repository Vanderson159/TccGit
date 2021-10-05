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
            margin-left: 54.5%;
            margin-top: 40px;
        }
        #formInserir{
            margin-top: -13%;
            margin-left: 5%;
        }
        .empresa{
            margin-left: 25%;
            margin-top: -20%;
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
            margin-left: 58%;
            margin-top: -15px;
        }
        #formInserir{
            margin-top: -13%;
            margin-left: 5%;
        }
    }
</style>

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
                    <input name="tempo" id="tempo" type="text" class="form-control" value="<?php echo (isset($linha) ? $linha->tempo : '30 min')?>" placeholder="Duração: 20 min" required autofocus>
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