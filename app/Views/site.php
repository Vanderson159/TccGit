<style>
    @media screen and (max-width: 1920px){
        .form-control{
            width: 500px;
            height: 200px;
            position: absolute;
            left: 34%;
            top: 35%
        }
        .busca{
            margin-top: 5%;
            margin-left: 44%;
            width: 200px;
        }
        .origem{
            margin-top:-5%;
            margin-left: 47%;
        }
        .destino{
            margin-top: 4%;
            margin-left: 47%;
        }
    }
</style>
<div class="enunciado">
    <div class="retangulo">  
        <p class="enunciadoTexto">Encontre seu ônibus por ruas, avenidas...:</p>
        <form id="formFiltro"  method="post" action="<?php echo base_url();?>">
            <h4 class="origem" for="rua_cep">ORIGEM:</h4>
            <select name="rua_cep" id="rua_cep" class="form-control">
                <?php foreach ($rua_cep as $rua_cep):?>
                    <option value="<?php echo $rua_cep->cep?>"><?php echo $rua_cep->nome?></option>
                <?php endforeach ?>
            </select>
            <h4 class="destino" for="rua">DESTINO:</h4>
            <select name="rua" id="rua" class="form-control" style="top: 55%;">
                <?php foreach ($rua as $rua):?>
                    <option value="<?php echo $rua->cep?>"><?php echo $rua->nome?></option>
                <?php endforeach ?>
            </select>
            <button class="btn btn-lg busca" type="submit">Buscar</button>
        </form>
    </div>
</div>
