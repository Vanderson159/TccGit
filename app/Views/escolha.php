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
</style>
<div class="retangulo">  
    <a  href="<?php echo base_url('/public/home/onibusFiltro');?>/<?php echo $id?>"><button class="btn btn-lg opcao1" ><p class="label">Horários e Pontos</p></button></a>
    <a  href="<?php echo base_url('/public/home/mapaRota');?>/<?php echo $id?>"><button class="btn btn-lg opcao2"><p class="label">Mapa da Rota</p></button></a>
</div>