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
    <div class="retangulo"> 
        <h1><?php echo $titulo; ?></h1>
        <br>
        <img class="img" src="<?php echo base_url("assets/IMG/adminSite/man.png")?>" alt="" width="200" height="200">
        <div class="divCampos">
        <?php
            if($acao == "Inserir"){
                $form = base_url("public/admin/inserir");
                $statusId = "enabled";
            }else{
                if($acao == "Editar"){
                    $form = "";
                    $statusId = "disabled";
                }
            }
        ?>
        <form id="formInserir"  method="post" action="<?php echo $form?>">
            <ul>
                <ol>
                    <label class="label">Id:&nbsp;&nbsp;</label>
                    <input name="id" id="id" type="text" class="form-control" value="<?php echo (isset($admin) ? $admin->id : '2968')?>" placeholder="Seu ID" required autofocus <?php echo $statusId?>>
                </ol>
                <br>
                <ol>
                    <label class="label">Login:&nbsp;&nbsp;</label>
                    <input name="login" id="login" type="text" class="form-control" value="<?php echo (isset($admin) ? $admin->login : 'Userdefault')?>" placeholder="Seu usuário" required autofocus>
                </ol>
                <br>
                <ol>
                    <label class="label">Senha:&nbsp;</label>
                    <input name="senha" id="senha" type="password" class="form-control"  value="<?php echo (isset($admin) ? $admin->senha : '********')?>" placeholder="Sua senha" required autofocus>
                </ol>
            <ul>
            <br>
            <ul>
                <ol>
                    <button class="btn btn-lg" type="submit">Salvar</button>
                </ol>
                <br>
                <ol>
                    <a href=" <?php echo base_url('public/admin/tabela')?>"><label class="btn btn-lg voltar">Voltar</label></a>
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
