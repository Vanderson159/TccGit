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
            font-weight: bold;
            font-size: large;
        }
        .voltar{
            margin-left: 11%;
            margin-top: -7%;
        }
        .img{
            margin-left: 52%;
            margin-top: 25px;
        }
        #formInserir{
            margin-top: -13%;
            margin-left: 5%;
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
                Ônibus inserido com sucesso!
            </div>
        <?php endif ?>
        <?php if($msg == 'Erro') : ?>
            <div class="alert alert-danger" id="alert" role="alert" style="text-align: center;">
                Erro ao tentar inserir Ônibus!
            </div>
        <?php endif ?>
    <div class="retangulo" id="retangulo"> 
        <h1><?php echo $titulo; ?></h1>
        <br>
        <img class="img" src="<?php echo base_url("assets/IMG/adminEmpresa/bus.png")?>" alt="" width="200" height="200">
        <div class="divCampos">
        <?php
            if($acao == "Inserir"){
                $form = base_url("public/adminEmpresa/inserir");
                $statusId = "Enabled";
            }else{
                if($acao == "Editar"){
                    $form = "";
                    $statusId = "Disabled";
                }
            }
        ?>
        <form id="formInserir"  method="post" action="<?php echo $form?>">
            <ul>
                <ol>
                    <label class="label">Id:&nbsp;&nbsp;</label>
                    <input name="id" id="id" type="text" class="form-control" value="<?php echo (isset($onibus) ? $onibus->id : '2000')?>" placeholder="ID do ônibus" required autofocus <?php echo $statusId?>>
                </ol>
                <br>
                <ol>
                    <label class="label">Nome:&nbsp;&nbsp;</label>
                    <input name="nome" id="nome" type="text" class="form-control" value="<?php echo (isset($onibus) ? $onibus->nome : 'Bus')?>" placeholder="Nome do ônibus" required autofocus>
                </ol>
                <br>
                <ol>
                    <label class="label">Linha:&nbsp;</label>
                    <select name="linha" id="linha" class="form-control">
                        <?php if(isset($onibus)) : ?>
                            <option value="<?php echo $onibus->linha_id?>"><?php echo $onibus->linha_id?></option>
                        <?php endif ?>
                        <?php foreach ($linha as $linha):?>
                            <option value="<?php echo $linha->id?>"><?php echo $linha->id?></option>
                        <?php endforeach ?>
                    </select>
                </ol>
            <ul>
            <br>
            <ul>
                <ol>
                    <button class="btn btn-lg" type="submit">Salvar</button>
                </ol>
                <br>
                <ol>
                    <a href=" <?php echo base_url('public/adminEmpresa/tabelaOnibus')?>"><label class="btn btn-lg voltar">Voltar</label></a>
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