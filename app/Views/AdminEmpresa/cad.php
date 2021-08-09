<?php $session = session();?>
<?php if(isset($_SESSION['user'])) : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bus</title>
</head>
<body>
    <h1>Cadastro de Ônibus</h1>
    <form id="formLogin" class="form-signin text-center" method="post" action="<?php echo base_url("public/admin/voltarPainelAdm")?>">
      <button type="submit">Voltar</button>
    </form>
</body>
</html>
<?php else : ?>
    <?php 
        echo view('header');
        echo view('login');
        echo view('footer');
    ?>
<?php endif ?>
