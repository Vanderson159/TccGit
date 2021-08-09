<div class="retangulo">
<form id="formLogin" class="form-signin text-center" method="post" action="<?php echo base_url("public/admin/autenticar")?>">
      <img class="mb-4" src="<?php echo base_url("assets/IMG/user.png")?>" alt="" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal">Faça seu login</h1>
      <label for="inputEmail" class="sr-only">usuário</label>
      <input name="login" id="login" type="text" class="form-control" placeholder="Seu usuário" required autofocus>
      <label for="inputPassword" class="sr-only">Senha</label>
      <input name="password" id="password"  type="password" class="form-control" placeholder="Senha" required>
      <button class="btn btn-lg btn-block" type="submit">Logar</button>
</form>
</div>