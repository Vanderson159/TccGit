<style>
    .mapa{
        margin-left: 19%;
        margin-top: 1%;
    }
    h3{
        margin-left:40%;
    }
</style>

<div class="retangulo">  
    <h3><?php echo $result[0]->nome?> : Mapa da Linha</h3>
    <iframe class="mapa" src="<?php echo $result[0]->mapa?>" width="1000" height="380"></iframe>
</div>