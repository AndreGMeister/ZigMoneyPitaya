<div id="divCupomFiscal" class="printable">
    <!-- CSS do cupom precisa ficar aqui dentro para ser lido pela biblioteca printJs-->
    <style>
        #divCupomFiscal {
            width:340px;
            border:1px solid #000;
            background:#f5f5e4;
            margin:0 auto;
            padding:10px;
            font-family: "Courier New", monospace;
        }
    </style>

    <b>EMPRESA: </b> <?php echo mb_strtoupper($dadosDaEmpresa->nomeEmpresa, 'UTF-8');?> <br>
    <b>ATIVIDADE: </b><?php echo  mb_strtoupper($dadosDaEmpresa->nomeSegmento, 'UTF-8');?> <br>
    <b>E-MAIL: </b><?php echo  mb_strtoupper($dadosDaEmpresa->email, 'UTF-8');?> <br>
    <b>TELEFONE: </b><?php echo  mb_strtoupper($dadosDaEmpresa->telefone, 'UTF-8');?>
    <br>
    <br>

    <!-- Se existir cliente -->
    <?php if (isset($dadosDaVenda[0]->id_cliente_tipo)):?>
        <center>-----------------------------------</center>
        <b>CLIENTE</b> <br>
        <?php if ($dadosDaVenda[0]->id_cliente_tipo == 1):?>
            <b>CPF: </b><?php echo $dadosDaVenda[0]->cpf; ?> <br>
        <?php else:?>
            <b>CNPJ: </b><?php echo $dadosDaVenda[0]->cnpj; ?> <br>
        <?php endif;?>
    <?php endif;?>

    <center>-----------------------------------</center>
    <h3>CUPOM NAO FISCAL</h3>
    <?php $total = 0; ?>
    <?php foreach ($dadosDaVenda as $venda): ?>
        <?php $total += $venda->valor; ?>
        <b>COD: </b><?php echo $venda->id; ?> <br>
        <b>ITEM: </b><?php echo $venda->nome; ?> <br>
        <b>PRECO: </b>R$ <?php echo real($venda->preco); ?> <br>
        <b>QTD: </b><?php echo $venda->quantidadeVendida; ?> <br>
        <b>SUB: </b>R$ <?php echo real($venda->valor); ?> <br>
        <b>DESC: </b>R$ <?php echo real($venda->valor_desconto); ?> <br>
        <br>
    <?php endforeach; ?>
    <center>-----------------------------------</center>
    <b>PAG: </b> <?php echo $dadosDaVenda[0]->meioPagamento;?> <br>

    <?php if ($dadosDaVenda[0]->idMeioPagamento == 1): ?>
        <b>RECEBIDO: </b>R$ <?php echo real($venda->valor_recebido); ?> <br>
        <b>TROCO: </b>R$ <?php echo real($venda->troco); ?> <br>
    <?php endif; ?>

    <?php if ($dadosDaVenda[0]->quantidade_parcela > 0): ?>
        <b>PARCELADO: </b> <?php echo $dadosDaVenda[0]->quantidade_parcela; ?>X
        DE
        R$  <?php echo real($dadosDaVenda[0]->valor_parcela); ?> <br>
    <?php endif; ?>

    <b>TOTAL: </b>R$ <?php echo real($total); ?> <br>

    <br>
    <b>DATA: </b> <?php echo $dadosDaVenda[0]->data; ?> <br>

    <b style="float:right"><small><b>BR</b></small></b>
    <br>
    <div style="clear: right"></div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>/public/css/printJs.css">
<script src="<?php echo BASEURL; ?>/public/js/printJs.js"></script>

<script>
function imprimirConteudo() {
    printJS({printable:'divCupomFiscal', type: 'html'});
}
</script>
