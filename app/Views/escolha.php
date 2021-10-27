<?php 	
    session_start();
    $_SESSION['cep'] = $cep;
?>
<style>
    .btn{
        text-align: center;
        margin-left: 40%;
        margin-top: 65px;
        width: 300px;
        height: 90px;
    }
    .label{
        font-family: Arial;
        font-size: 20;
        opacity: 0;
        color: black;
    }

    .label:hover{
        opacity: 100;
    }
    .opcao1{
        background-image: url('<?php echo base_url('assets/IMG/pontoHorario.png')?>');
        image-resolution: 100dpi;
    }
    .opcao2{
        background-image: url('<?php echo base_url('assets/IMG/mapa.png')?>');
    }
    .opcao1:hover, .opcao2:hover{
        background-color: #ffcc00;
        background-image: none;
    }
    .Btnlogut{
        margin-top: 2%;
        margin-left: -5%;
        width: 120px;
        height: 50px;
        border: none;
        background-color: #BCB9B9;
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
        background-image: url('<?php echo base_url('assets/IMG/adminSite/logOut.png')?>');
    }
</style>
<div class="retangulo">  
    <a  href="<?php echo base_url('/public/home/onibusFiltro');?>/<?php echo $id?>"><button class="btn btn-lg opcao1" ><p class="label">Horários e Pontos</p></button></a>
    <a  href="<?php echo base_url('/public/home/mapaRota');?>/<?php echo $id?>"><button class="btn btn-lg opcao2"><p class="label">Mapa da Rota</p></button></a>
    <form id="formLogin" class="form-signin text-center" method="post" action="<?php echo base_url("public/home/")?>/<?php echo $func ?>/<?php echo $cep?>">
        <button class="Btnlogut"></button>
    </form>
</div>