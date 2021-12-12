    <?php 		
        session_start();
        $_SESSION['destino'] = $destino;
    ?>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, "http://localhost/TccGit/public/home/filtro/<?php echo $_SESSION['destino']?>" );
        }
    </script>
    <style>
                @media screen and (max-width: 1920px){
                    .tabela, .tabela td, .tabela tr{
                        border: 1px solid; 
                    }
                    .tabela{
                        background-color: white;
                        color: black;
                        font-size: 20;
                        font-weight: bold;
                        margin-left: 120px;
                        width: 1200px;
                        height: 500px;
                    }
                    .trTable{
                        background-color: #ffcc00;
                    }
                    .table-wrapper {
                        overflow: scroll;
                        margin-right: 200px;
                        margin-top: -14%;   
                        height: 450px;

                    }
                    .Btnlogut{
                        margin-top: 2%;
                        margin-left: -45%;
                        width: 120px;
                        height: 50px;
                        border: none;
                        background-color: #BCB9B9;
                        background-repeat: no-repeat;
                        background-size: contain;
                        background-position: center;
                        background-image: url('<?php echo base_url('assets/IMG/adminSite/logOut.png')?>');
                    }
                }
                @media screen and (max-width: 1600px){
                    .tabela, .tabela td, .tabela tr{
                        border: 1px solid; 
                    }
                    .tabela{
                        background-color: white;
                        color: black;
                        font-size: 20;
                        font-weight: bold;
                        margin-left: 50px;
                        width: 1100px;
                        height: 400px;
                    }
                    .trTable{
                        background-color: #ffcc00;
                    }
                    .table-wrapper {
                        overflow: scroll;
                        margin-right: 300px;
                        margin-top: -15%;
                        height: 320px;
                        width: 1200px;
                    }
                    .base{
                        margin-left: 3%;
                    }
                    .Btnlogut{
                        margin-top: 8%;
                        margin-left: -44%;
                        width: 120px;
                        height: 50px;
                        border: none;
                        background-color: #BCB9B9;
                        background-repeat: no-repeat;
                        background-size: contain;
                        background-position: center;
                        background-image: url('<?php echo base_url('assets/IMG/adminSite/logOut.png')?>');
                    }
                    .baseIMG{
                        margin-left: 80%;
                    }
                    .img{
                        margin-left: 20px;
                    }
                }
                @media screen and (max-width: 1366px){
                    .tabela, .tabela td, .tabela tr{
                        border: 1px solid; 
                    }
                    .tabela{
                        background-color: white;
                        color: black;
                        font-size: 20;
                        font-weight: bold;
                        margin-left: 10px;
                        width: 1000px;
                        height: 250px;
                    }
                    .trTable{
                        background-color: #ffcc00;
                    }
                    .table-wrapper {
                        overflow: scroll;
                        margin-right: 300px;
                        margin-top: -22%;
                        height: 280px;
                        width: 1040px;
                    }
                    .btn{
                        margin-left: 10%;
                        margin-top: 10px;
                    }
                    .Reg{
                        margin-left:35%;
                        margin-top: -3.5%;
                    }
                    .img{
                        margin-left: 77%;
                        margin-top: 25px;
                    } 
                    #imgLabel{
                        margin-left: 8%;
                        margin-top: 10px;
                        text-align: center;
                    }
                    .Btnlogut{
                        margin-top: -1%;
                        margin-left: -45%;
                        width: 120px;
                        height: 40px;
                        border: none;
                        background-color: #BCB9B9;
                        background-repeat: no-repeat;
                        background-size: contain;
                        background-position: center;
                        background-image: url('<?php echo base_url('assets/IMG/adminSite/logOut.png')?>');
                    }  
                    .baseIMG{
                        margin-left: 80%;
                    }
                    .img{
                        margin-left: 20px;
                    }
                    .base{
                        margin-left: 1%;
                        margin-top: -10%;
                    }
                }
    </style>

    <div class="retangulo">
        <div class="baseIMG">
            <img class="img" src="<?php echo base_url("assets/IMG/adminEmpresa/bus.png")?>" alt="" width="250" height="200">
            <h2 id="imgLabel">Ônibus Encontrados</h2>
        </div>
        <div class="base">
            <div class="table-wrapper">
                <table class="tabela">
                    <tr class="trTable">
                        <td style="text-align: center;">ÔNIBUS ENCONTRADOS</td>
                        <td style="text-align: center;">PASSAGEM (INTEIRA)</td>
                        <td style="text-align: center;">PASSAGEM (MEIA)</td>
                        <td></td>
                        <?php foreach ($result as $results):?>
                            <tr>
                                <td style="text-align: center;"><?php echo $results->nome ?></td>
                                <td style="text-align: center;">R$ <?php echo $results->passagens ?></td>
                                <td style="text-align: center;">R$ <?php $meia = number_format(($results->passagens/2), 2); echo $meia;?></td>
                                <td style="text-align: center;"><a href="<?php echo base_url('/public/home/escolha');?>/<?php echo $results->id?>/<?php echo $_SESSION['destino']?>">Visualizar</a></td>
                            </tr>  
                        <?php endforeach ?>
                    </tr>
                </table>
            </div>
                <form id="formLogin" class="form-signin text-center" method="post" action="<?php echo base_url("public/home/")?>">
                    <button class="Btnlogut"></button>
                </form>
        </div>
    </div>