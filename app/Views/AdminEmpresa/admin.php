<style>
    h1{
        text-align: center;
        margin-top: 1%;
    }

    .btnOnibus{
        background-repeat: no-repeat;
        text-align: center;
        width: 210px;
        height: 142px;
        background-image: url('<?php echo base_url('assets/IMG/adminEmpresa/bus.png')?>');
        background-color: #282828;
        background-size: contain;
        background-position: center;
        border: 2px double #404040;
    }

    .btnLinha{
        background-repeat: no-repeat;
        text-align: center;
        width: 210px;
        height: 142px;
        background-image: url('<?php echo base_url('assets/IMG/adminEmpresa/gps.png')?>');
        background-color: #282828;
        background-size: contain;
        background-position: center;
        border: 2px double #404040;
    }

    .btnPonto{
        background-repeat: no-repeat;
        text-align: center;
        width: 210px;
        height: 142px;
        background-image: url('<?php echo base_url('assets/IMG/adminSite/pontoOnibus.png')?>');
        background-color: #282828;
        background-size: contain;
        background-position: center;
        border: 2px double #404040;
    }

    .btnEmpresa{
        background-repeat: no-repeat;
        text-align: center;
        width: 210px;
        height: 142px;
        background-image: url('<?php echo base_url('assets/IMG/adminSite/empresa.png')?>');
        background-color: #282828;
        background-size: contain;
        background-position: center;
        border: 2px double #404040;
    }
    
    .div1{
        width: 210px;
        height: 142px;
        margin-left: 12%;
        margin-top: 5;
    }
    
    .div2{
        width: 210px;
        height: 142px;
        margin-left: 33%;
        margin-top: -140;
    }

    .div3{
        width: 210px;
        height: 142px;
        margin-left: 54%;
        margin-top: -140;
    }

    .div4{
        width: 210px;
        height: 142px;
        margin-left: 75%;
        margin-top: -140;
    }

    .div5{
        margin-left: 14%;
        margin-top: 60;
    }

    .btnOnibus:hover,.btnLinha:hover, .btnPonto:hover, .btnEmpresa:hover{
       background-color: #ffcc00;
       background-image: none;
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

    .Btnlogut{
        margin-top: -5%;
        margin-left: -18%;
        width: 120px;
        height: 50px;
        border: none;
        background-color: #BCB9B9;
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
        background-image: url('<?php echo base_url('assets/IMG/adminSite/logOut.png')?>');
    }

    .labelLogout{
        margin-top: 2%;
        margin-left: 46%;
        font-size: 20;
        font-weight: bold;
    }
    .ulLogout{
        margin-left: -19%;
    }
</style>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, "http://localhost/TccGit/public/adminEmpresa/voltarPainelAdmEmpresa" );
    }
</script>
<?php $session = session();?>
<?php if(isset($_SESSION['user'])) : ?>
<?php $login = $_SESSION['user'];?>
<div class="retangulo"> 
    <h1>Área administrativa da Empresa</h1>
<div class="div5">
    <div class="div1"><button class="btnOnibus"><a href="<?php echo base_url("public/adminEmpresa/tabelaOnibus")?>"><p class="label">Ônibus</p></a></button></div>
    <div class="div2"><button class="btnLinha"><a href="<?php echo base_url("public/adminEmpresa/tabelaLinha")?>"><p class="label">Linhas</p></a></button></div>
    <div class="div3"><button class="btnPonto"><a href="<?php echo base_url("public/adminEmpresa/tabelaPonto")?>"><p class="label">Pontos</p></a></button></div>
   <!-- <div class="div4"><button class="btnEmpresa"><p class="label">Empresas</p></button></div> -->
    <ul class="ulLogout">
        <ol>
            <label class="labelLogout">Logout:</label>
        </ol>
        <ol>
            <form id="formLogin" class="form-signin text-center" method="post" action="<?php echo base_url("public/admin/logout")?>">
                <button class="Btnlogut"></button>
            </form>
        </ol>
    </ul>
</div>
</div>
<?php else : ?>
    <?php 
        echo view('header');
        echo view('login');
        echo view('footer');
    ?>
<?php endif ?>