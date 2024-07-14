<?php use System\HtmlComponents\FlashMessage\FlashMessage;?>

<h5 class="card-title text-center">
    Cadastre-se
</h5>

<form method="post"
    action="<?php echo BASEURL?>/criarConta/cadastrar">

    <div class="">
        <?php FlashMessage::show(); ?>
    </div>
    
    <!-- token de segurança -->
    <input type="hidden" name="_token" value="<?php echo TOKEN; ?>"/>

        <?php if (isset($empresa->id)) : ?>
            <input type="hidden" name="id" value="<?php echo $empresa->id; ?>">
        <?php endif; ?>

        <div class="form-label-group">
            <input type="text" class="form-control" name="nome" id="nome"
            placeholder="Nome da empresa"
            autofocus>
            <label for="nome">Nome da empresa *</label>
        </div>
        <div class="form-label-group">
            <input type="text" class="form-control" name="email" id="email"
            placeholder="Email" onchange="return verificaSeEmailExiste(this)">
            <label for="email">Email *</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="password" name="password" class="form-control"
            placeholder="Senha">
            <label for="password">Senha *</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block text-uppercase" 
        onclick="return salvarEmpresas()" style="border-radius:30px">
            Confirmar
        </button>

        <center>
            <div class="form-links">
                <a href="<?php echo BASEURL;?>/">
                    Voltar para tela de login
                </a>
            </div>
        </center>

        <hr class="my-4">

    <center style="font-size:13px;opacity:0.70">ZigMoney <span style="font-size:17px">&hearts;</span></center>
    <center style="font-size:13px;opacity:0.70"><small>Versāo Pitaya 0.1</small></center>

</form>

<script src="<?php echo BASEURL; ?>/public/assets/js/core/jquery.min.js"></script>
<script src="<?php echo BASEURL; ?>/public/assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo BASEURL; ?>/public/js/helpers.js"></script>

<script>
    // Anula duplo click em salvar
    anulaDuploClick($('form'));

    function salvarEmpresas() {
        if ($('#nome').val() == '') {
            modalValidacao('Validação', 'Campo (Nome da Empresa) deve ser preenchido!');
            return false;

        } else if ($('#email').val() == '') {
            modalValidacao('Validação', 'Campo (Email) deve ser preenchido!');
            return false;

        } else if (!emailValido($('#email').val())) {
            modalValidacao('Validação', 'Digite um Email valido!');
            return false;

        } else if ($('#sena').val() == '') {
            modalValidacao('Validação', 'Campo (Sena) deve ser preenchido!');
            return false;
        }

        return true;
    }

    function verificaSeEmailExiste(email) {
        var rota = getDomain() + "/criarConta/verificaSeEmailExiste/" + in64(email.value);
        
        $.get(rota, function (data, status) {
            var retorno = JSON.parse(data);

            if (retorno.status == true) {
                modalValidacao('Validação', '<small>Este Email já existe! Por favor, informe outro!</small>');
                $('.button-salvar-empresa').attr('disabled', 'disabled');
                $('.label-email').html('<small style="color:#cc0000!important">Este Email já existe!</small>');
            } else {
                $('.button-salvar-empresa').attr('disabled', false);
                $('.label-email').html('');
            }
        });
    }

    //jQuery('#id_segmento').select2();
</script>