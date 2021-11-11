<style>
    
    @media screen and (max-width: 1600px){
        .mapa{
            margin-left: 19%;
            margin-top: 1%;
            width: 1000;
            height: 380;
        }
        h3{
            margin-left:40%;
        }      
    }
    @media screen and (max-width: 1366px){
        .mapa{
            margin-left: 13%;
            margin-top: 1%;
            width: 1000;
            height: 310;
        }
    }
</style>

<div class="retangulo">  
    <h3><?php echo $result[0]->nome?> : Mapa da Linha</h3>
    <iframe class="mapa" src="<?php echo $result[0]->mapa?>"></iframe>
</div>