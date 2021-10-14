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
            margin-left: -3.5%;
            font-weight: bold;
            font-size: large;
        }
        .voltar{
            margin-left: 9%;
            margin-top: -6.1%;
        }
        .img{
            margin-left: 52%;
            margin-top: 25px;
        }
        #formInserir{
            margin-top: -13%;
            margin-left: 9%;
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
        .voltar{
            margin-left: 11%;
            margin-top: -6.7%;
        }
        .img{
            margin-left: 47%;
            margin-top: 70px;
        }
        #formInserir{
            margin-top: -16%;
            margin-left: 5%;
        }
        .btnAcoes{
            margin-top: 1%;
            margin-left:-4%;
        }
        .inputs{
            margin-top: 3%;
        }
        #timeManha, #timeTarde{
            width: 150px;
        }
        .alert{
            width: 2000px;
            height: 40px;
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
                Ponto relacionado à linha com sucesso!
            </div>
        <?php endif ?>
        <?php if($msg == 'Erro' && $cod == 222) : ?>
            <div class="alert alert-danger" id="alert" role="alert" style="text-align: center;">
                Relacionamento já existente!
            </div>
        <?php endif ?>
    <div class="retangulo"> 
        <h1><?php echo $titulo; ?></h1>
        <br>
        <img class="img" src="<?php echo base_url("assets/IMG/adminEmpresa/relógio.png")?>" alt="" width="200" height="200">
        <div class="divCampos">
        <?php
            if($acao == "Inserir"){
                $form = base_url("public/adminEmpresa/inserirPonto");
                $statusId = "enabled";
                $voltar = base_url('public/adminEmpresa/adicionarPonto/'.$_SESSION['idLinha']);
            }else{
                if($acao == "Editar"){
                    $form = base_url("public/adminEmpresa/pontosLinhaEditInsert");
                    $statusId = "enabled";
                    $voltar = base_url('public/adminEmpresa/pontosLinha/'.$_SESSION['idLinha']);
                }
            }

            if($pontosLinha != null){
                $timestamp = strtotime($pontosLinha[0]->manha);
                $dataHoraManha = strftime('%H:%M', $timestamp);
                $timestamp = strtotime($pontosLinha[0]->tarde);
                $dataHoraTarde = strftime('%H:%M', $timestamp);
            }
        ?>

        <form id="formInserir"  method="post" action="<?php echo $form?>">
            <ul class="inputs">
                <ol>
                    <label class="label">Manhã:&nbsp;&nbsp;</label>
                   <!-- <input type="time" id="appt" name="appt" min="06:00" max="19:00" value="<?php //echo (isset($ponto) ? $ponto->manha : "06:00")?>" required  autofocus <?php //echo $statusId?>> -->
                    <input type="time" id="timeManha" name="timeManha" min="06:00" max="11:00" value="<?php echo (isset($pontosLinha) ? $dataHoraManha : "06:00")?>"  required  autofocus <?php echo $statusId?>>

                </ol>
                <br>
                <ol>
                    <label class="label">Tarde:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="time" id="timeTarde" name="timeTarde" min="12:00" max="19:00" value="<?php echo (isset($pontosLinha) ? $dataHoraTarde : "12:00")?>"  required  autofocus <?php echo $statusId?>>
                    <!-- <input type="time" id="appt" name="appt" min="12:00" max="19:00" value="<?php //echo (isset($ponto) ? $ponto->tarde : "12:00")?>" required  autofocus <?php //echo $statusId?>>  -->
                </ol>
            <ul>
            <br>
            <ul class="btnAcoes">
                <ol>
                    <button class="btn btn-lg" type="submit">Salvar</button>
                </ol>
                <br>
                <ol>
                    <a href="<?php echo $voltar?>"><label class="btn btn-lg voltar">Voltar</label></a>
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
