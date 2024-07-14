<!--Usando o Html Components-->
<?php

use System\HtmlComponents\FlashMessage\FlashMessage; ?>

<div class="col-md-12">
    <?php FlashMessage::show(); ?>
</div>

<h5 class="card-title text-center">
    Bem vindo
</h5>
<form class="form-signin" method="post" action="<?php echo BASEURL; ?>/login/logar">

    <!-- token de segurança -->
    <input type="hidden" name="_token" value="<?php echo TOKEN; ?>"/>

    <div class="form-label-group">
        <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="email">Email</label>
    </div>

    <div class="form-label-group">
        <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
        <label for="password">Senha</label>
    </div>

    <div class="p-2">
        <label for="remember" class="checkbox-options">
            <input type="checkbox" name="remember" id="remember" checked/>
            Permanecer conectado
        </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>

    <div class="form-links">
        <a href="<?php echo BASEURL; ?>/login/senha">Esqueci a minha senha</a>
    </div>

    
    <hr class="my-4">

    <center>
        <div class="form-links">
            <a href="<?php echo BASEURL;?>/criarConta/index" style="color:#0050A6">
                Criar uma conta
            </a>
        </div>
    </center>

    <hr class="my-4">

    <center style="font-size:13px;opacity:0.70">ZigMoney <span style="font-size:17px">&hearts;</span></center>
    <center style="font-size:13px;opacity:0.70"><small>Versāo Pitaya 0.1</small></center>

</form>
