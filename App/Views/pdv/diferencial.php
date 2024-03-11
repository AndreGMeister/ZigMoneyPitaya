<!--Usando o Html Components-->
<?php use System\HtmlComponents\Modal\Modal; ?>
<style type="text/css">
    .imagem-perfil {
        width: 30px;
        height: 30px;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
    }
    @media only screen and (min-width: 600px) {
        #salvar-venda {
            margin-top: 25px;
        }
    }
    @media only screen and (max-width: 600px) {
        .card-produtos {
            width:50%;
            padding-bottom:10px!important;
        }
        .div-realizar-pagamento {
            background:white!important;
            box-shadow:none;
            padding-right:0;
        }
        .div-card-body-realizar-pagamento {
            background:white;
            border-radius:none!important;
            box-shadow:none!important;
            border:none!important;
        }
    }
    .card-two {
        margin-top: 10px;
        border-radius: 3px;
        box-shadow: none;
        border: 1px solid #dddddd;
        padding-left: 3px;
        padding-right: 3px;
    }
    .tabela-ajustada tr td {
        padding-top: 2px !important;
        padding-bottom: 2px !important;
        font-size: 12px;
    }
    .tabela-ajustada th {
        font-size: 13px !important;
    }
    .card-produtos {
        margin-top: 10px;
        border-left: 1px solid #dddddd;
        padding: 10px;
        float: left;
    }
    .card-produtos img:hover {
        cursor: pointer;
        border: 2px solid #7fe3ca;
        filter: brightness(95%);
    }
    .card-produtos img:active {
        cursor: pointer;
        border: 1px solid #7fe3ca;
        box-shadow: silver 1px 1px 3px;
    }
    .card-produtos img, .icone-produtos {
        width: 80px;
        height: 80px;
        object-fit: cover;
        object-position: center;
        margin: 0 auto;
        display: block;
        border-radius: 50%;
        border: 1px solid gray;
        padding: 3px;
        background: white;
    }
    .icone-produtos {
        padding-top:15px;
        padding-left:8px;
    }
    .icone-produtos:hover {
        cursor: pointer;
        border: 2px solid #7fe3ca;
        filter: brightness(95%);
    }
    .produto-titulo {
        font-size: 11px !important;
        text-align: center;
        display: block;
        margin-top: 3px;
    }
    .produto-valor {
        font-size: 13px !important;
        text-align: center;
        font-weight: bold;
    }
    .div-inter-produtos {
        background: #f4f3ef;
    }
    .img-produto-seleionado {
        width: 30px;
        height: 30px;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
        border: 1px solid #dee2e6;
    }
    .campo-quantidade {
        border: 1px solid #dee2e6;
        width: 50px;
        text-align: center;
    }
    .div-inter-produtos {
        overflow-y: scroll;
        height: 160px;
        padding-bottom: 10px;
    }
    .div-inter-produtos::-webkit-scrollbar-track {
        background-color: white;
    }
    .div-inter-produtos::-webkit-scrollbar {
        width: 5px;
        background: #252422;
    }
    .div-inter-produtos::-webkit-scrollbar-thumb {
        background: #252422;
    }
    .div-inter-produtos::-webkit-input-placeholder {
        color: #8198ac;
    }
    .div-inter-produtos {
        height: 300px !important;
    }
    #data-compensacao {
        transition: opacity 1s ease-out;
        opacity: 0;
        height: 0;
        overflow: hidden;
    }
    #data-compensacao.visivel {
        opacity: 1;
        height: auto;
    }
    .div-realizar-pagamento {
        background:transparent;
        box-shadow:none;
        padding-right:0;
    }
    .div-card-body-realizar-pagamento {
        background:white;
        border-radius:10px;
        box-shadow:#deddd9 1px 2px 10px;
    }
    .small_nome {
        font-size: 15px;
    }
    .small_nome_link {
        color: #007bff;
        cursor: pointer;
    }
    .obs {
        background:#fffcf5;
        padding-10px;
        margin-bottom:20px;
        opacity:0.80;
    }
    #modalClienteNaVenda .close {
        display: none!important
    }

    .unidade {
        font-size: 10px;
        color: #999999;
        padding:1px;
    }
</style>

<div class="row">
    <div class="card col-lg-6 content-div">
        <div class="card-body" style="overflow-x:auto!important;">
            <h3><i class="fas fa-box-open"></i> Produto</h3>
            <div class="row">
                <div class="col-md-6">
                    <label label="">Pesquise Nome</label>
                    <input type="text" class="form-control" placeholder="Pesquise por nome..."
                    onkeyup="pesquisarProdutoPorNome($(this).val())">
                </div>

                <div class="col-md-6">
                    <label label="">Pesquise Código de barras</label>
                    <input type="text" class="form-control" placeholder="Pesquise por código de barras..."
                    onkeyup="pesquisarProdutoPorCodigoDeBarras($(this).val())"
                    onkeypress="pesquisarProdutoPorCodigoDeBarras($(this).val())">
                </div>
            </div>
        </div>
        <div style="margin-bottom:20px"></div>
    </div>

    <div class="card col-lg-6 content-div div-realizar-pagamento">
        <div class="card-body div-card-body-realizar-pagamento">
            <h3><i class="fas fa-user-tie"></i> Cliente <span id="cliente_nome"></span></h3>
            <div class="row">
                <div class="col-md-6">
                    <label label="">Pesquise CPF</label>
                    <input type="text" id="campo_cliente_cpf" class="form-control cpf_mask" placeholder="Pesquise por CPF"
                    onkeyup="pesquisarClientesParaOpdv($(this).val())"
                    onblur="limpaCpf()">
                </div>

                <div class="col-md-6">
                    <label label="">Pesquise CNPJ</label>
                    <input type="text" id="campo_cliente_cnpj" class="form-control cnpj_mask" placeholder="Pesquise por CNPJ"
                    onkeyup="pesquisarClientesParaOpdv($(this).val())"
                    onblur="limpaCnpj()">
                </div>
                <input type="hidden" id="cliente_id">
            </div>
        </div>
    </div>
</div>

<!-- Carrega os produtos-->
<div class="row">
    <div class="card col-lg-8 content-div">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-box-open"></i> Produtos</h5>
            <div id="carregar-produtos"></div>
        </div>
    </div>

    <div class="card col-lg-4 content-div div-realizar-pagamento" style="">
        <div class="card-body div-card-body-realizar-pagamento">

            <span>Total</span> <br>
            <input type="text" class="form-control" id="b-mostra-valor-total" readonly placeholder="R$ 00,00">

            <hr>

            <div class="form-group">
                <label for="id_meio_pagamento">Meios de pagamento *</label>
                <select class="form-control" name="id_meio_pagamento" id="id_meio_pagamento" onchange="handleAoMudarMeioDePagamento()">
                    <option value="selecione">Selecione</option>
                    <?php foreach ($meiosPagamentos as $pagamento): ?>
                        <option value="<?php echo $pagamento->id; ?>">
                            <?php echo $pagamento->legenda; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" id="div-valor-recebido" style="display:none">
                <label for="valor_recebido" id="label-valor-pago">Valor pago</label>
                <input type="text" class="form-control campo-moeda" id="valor_recebido" name="valor_recebido" placeholder="R$ 00,00"
                onblur="calcularTroco();">
            </div>

            <div id="div-troco" style="display:none">
                Troco <br>
                <input type="text" class="form-control campo-moeda" id="input_troco" readonly placeholder="R$ 00,00">
            </div>

            <div id="div-cartao" style="display:none">
                Parcelar em... <br>
                <select class="form-control" name="" id="select_parcelamento_cartao">

                </select>
            </div>

            <div class="form-group" id="data-compensacao">
                <label for="id_meio_pagamento">Data de compensacao</label>
                <input type="date" class="form-control" id="data_compensacao_boleto" name="data_compensacao_boleto">
            </div>

            <button class="btn btn-sm btn-success btn-block" id="button-confirmar-venda"
            style="padding:10px"
            onclick="saveVendasViaSession('<?php echo TOKEN; ?>')">
                <i class="fas fa-save"></i> Finalizar venda
            </button>

        </div>
    </div>
</div>

<div class="row">

    <div class="card col-lg-8 content-div">
        <div class="card-body" style="overflow-x:auto!important;">
            <h5 class="card-title">
                <i class="fas fa-cart-arrow-down"></i>
                Itens selecionados
            </h5>

            <table class="table tabela-ajustada tabela-de-produto" style="width:100%;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Produto</th>
                    <th class="hidden-when-mobile">Preço</th>
                    <th>QTD</th>
                    <th>Total</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody></tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>

    <div class="card col-lg-4 content-div div-realizar-pagamento" style="">
        <div class="card-body div-card-body-realizar-pagamento">
            <h5 class="card-title">
                <i class="fas fa-cart-arrow-down"></i>
                As ultimas 10 vendas realizadas no dia.
            </h5>

            <table class="table tabela-ajustada tabela-ultimas-vendas-realizadas" style="width:100%;">
                <thead>
                <tr>
                    <th>Total</th>
                    <th>Pagamento</th>
                    <th>Data</th>
                    <th>Cupom</th>
                </tr>
                </thead>
                <tbody></tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
</div>
</div><!--end row-->

<script src="<?php echo BASEURL; ?>/public/assets/js/core/jquery.min.js"></script>

<?php Modal::start([
    'id' => 'cupomFiscal',
    'width' => 'modal-lg',
    'title' => '<button class="btn btn-sm btn-success" onclick="imprimirConteudo()"><i class="fas fa-print"></i> Imprimir</button>',
]); ?>
    <div id="modal-content"></div>
<?php Modal::stop(); ?>


<?php Modal::start([
    'id' => 'modalFinalizarVenda',
    'width' => 'modal-lg',
    'title' => '<button class="btn btn-sm btn-success" onclick="imprimirConteudo()"><i class="fas fa-print"></i> Imprimir</button>',
]); ?>
<div id="modal-content-venda-finalizada"></div>
<?php Modal::stop(); ?>

<?php Modal::start([
    'id' => 'modalClienteNaVenda',
    'width' => 'modal-lg',
    'title' => 'Cliente',
]); ?>
<div id="modal-content-cliente-na-venda">
    <div class="row">
        <div class="col-md-12 obs">
            <span>
                Obs: Deseja associar este cliente a esta venda?
            </span>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="modal_cliente_nome" id="modal_cliente_nome" disabled>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="nome">E-mail</label>
                <input type="text" class="form-control" name="modal_cliente_email" id="modal_cliente_email" disabled>
            </div>
        </div>
        <div class="col-md-4 div-cliente-cpf">
            <div class="form-group">
                <label for="nome">CPF</label>
                <input type="text" class="form-control" name="modal_cliente_cpf" id="modal_cliente_cpf" disabled>
            </div>
        </div>
        <div class="col-md-4 div-cliente-cnpj">
            <div class="form-group">
                <label for="nome">CNPJ</label>
                <input type="text" class="form-control" name="modal_cliente_cnpj" id="modal_cliente_cnpj" disabled>
            </div>
        </div>
        <div class="col-md-4">
            <button class="btn btn-success button-salvar-clientes"
                onclick="return associarCliente()">
                    <i class="fas fa-save"></i> SIM
            </button>
            <button class="btn btn-danger button-salvar-clientes"
                onclick="return  desassociarCliente()">
                    <i class="fas fa-save"></i> NĀO
            </button>
        </div>
        <div class="col-md-4">

        </div>
    </div><!--end row-->
</div>
<?php Modal::stop(); ?>

<script src="<?php echo BASEURL; ?>/public/assets/js/core/jquery.min.js"></script>
<script defer src="<?php echo BASEURL; ?>/public/js/helpers.js"></script>
<script src="<?php echo BASEURL; ?>/public/js/maskedInput.js"></script>
<script defer src="<?php echo BASEURL; ?>/public/js/venda/funcoesPdvAvancado.js"></script>

<script>
    pesquisarProdutoPorNome(false);
    jaExisteClienteAssociado();
    function pesquisarProdutoPorNome(nome) {
        $("#carregar-produtos").html("<center><h3>Carregando...</h3></center>");
        let url = "<?php echo BASEURL; ?>/pesquisarProdutoPorNome";
        url += nome? ("/"+in64(nome)) : "";
        $("#carregar-produtos").load(url);
    }

    function pesquisarProdutoPorCodigoDeBarras(codigo) {
        $("#carregar-produtos").html("<center><h3>Carregando...</h3></center>");
        let url = "<?php echo BASEURL; ?>/pesquisarProdutoPorCodigoDeBarra";
        url += codigo? ("/"+in64(codigo)) : "";
        $("#carregar-produtos").load(url);
    }

    function pesquisarClientesParaOpdv(termo, mostrarModal = true) {
        var rota = "<?php echo BASEURL; ?>/cliente/pesquisarClientesParaOpdv/"+in64(termo);
        $('#cliente_nome').html(`(<small class="small_nome">Carregando...</small>)`);
        $.get(rota, function (data, status) {
            var obj = JSON.parse(data);
            if (obj.nome === undefined) {
                $('#cliente_nome').html(`(<small class="small_nome">Não encontrado</small>)`);
                return false;
            }

            if (mostrarModal === true) {
                $('#modalClienteNaVenda').modal({backdrop: 'static'});
            }

            $('#modal_cliente_nome').val(obj.nome);
            $('#modal_cliente_email').val(obj.email);

            if (obj.id_cliente_tipo == 1) {
                $('#modal_cliente_cpf').val(obj.cpf);
                $('.div-cliente-cnpj').hide();
                $('.div-cliente-cpf').show();
            } else {
                $('#modal_cliente_cnpj').val(obj.cnpj);
                $('.div-cliente-cpf').hide();
                $('.div-cliente-cnpj').show();
            }

            $('#cliente_id').val(obj.id);
            $('#cliente_nome').html(`(<small class="small_nome small_nome_link" onclick="showModalCliente()">: ${obj.nome}</small>)`);
        });
    }

    function jaExisteClienteAssociado() {
        var rota = "<?php echo BASEURL; ?>/pdvDiferencial/jaExisteClienteAssociado";
        $.get(rota, function (data, status) {
            var obj = JSON.parse(data);
            if (obj.status === true) {
                if (obj.cliente_tipo == 1) {
                    pesquisarClientesParaOpdv(obj.cpf, false);
                    $('#campo_cliente_cpf').val(obj.cpf);
                } else  {
                    pesquisarClientesParaOpdv(obj.cnpj, false);
                    $('#campo_cliente_cnpj').val(obj.cnpj);
                }
            }
        });
    }

    function showModalCliente() {
        $('#modalClienteNaVenda').modal('show');
    }

    function limpaCpf() {
        if ($('#campo_cliente_cpf').val() === '___.___.___-__') {
            $('#cliente_nome').html('');
        }
    }

    function limpaCnpj() {
        if ($('#campo_cliente_cnpj').val() === '__.___.___/____-__') {
            $('#cliente_nome').html('');
        }
    }

    function associarCliente() {
        var rota = "<?php echo BASEURL; ?>/pdvDiferencial/associarClienteAVenda/"+$('#cliente_id').val();
        $.get(rota, function (data, status) {
            var obj = JSON.parse(data);
            $('#modalClienteNaVenda').modal('hide');
        });
    }

    function desassociarCliente() {
        var rota = "<?php echo BASEURL; ?>/pdvDiferencial/desassociarClienteAVenda/"+$('#cliente_id').val();
        $.get(rota, function (data, status) {
            var obj = JSON.parse(data);
            if (obj.status === true) {
                $('#cliente_nome').html('');
                $('#modalClienteNaVenda').modal('show');
                $('#modal_cliente_nome').val('');
                $('#modal_cliente_email').val('');
                $('#modal_cliente_cpf').val();
                $('#campo_cliente_cpf').val('');
                $('#campo_cliente_cnpj').val('');
                $('#modalClienteNaVenda').modal('hide');
                $('#cliente_id').val('');
            }
        });
    }

    
    
</script>
