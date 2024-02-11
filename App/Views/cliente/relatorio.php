<?php $data = (object) $data; ?>

<style>
   #ul_dados_principais_do_cliente {
     margin:0;
     padding:0;
     list-style:none;
   }
</style>

<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-stats">
            <div class="card-body">
                <b style="color:red">OBS: TELA EM CONSTRUCAO</b>
            <h5 class="card-title"><i class="fas fa-user-tie"></i> 
                Cliente: <?php echo $data->nome;?>
            </h5>

            <ul id="ul_dados_principais_do_cliente">
                <li>Vendido até o momento R$ <?php echo real($data->totalVendidoAteOMomento);?></li>
                <li>Cliente desde <?php echo $data->clienteDesDe;?></li>
            </ul>
            
            </div>
            <div class="card-footer ">
                <hr>
                <!--<div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update Now
                </div>-->
            </div>
        </div>
    </div>

</div>


<div class="row">
    

<div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <center>
                    Vendas por mês.
                    <small style="opacity:0.70">Ano de (<?php echo date('Y');?>)</small>
                </center>
                <canvas class="grafico" id="grafi-valor-vendas-do-mes-no-ano" width="400" height="185"></canvas>
            </div>
            <div class="card-footer ">
                <hr>
                <!--<div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update Now
                </div>-->
            </div>
        </div>
    </div>



    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <center>
                    Vendas por dia.
                    <small style="opacity:0.70">Ultimos 30 dias</small>
                </center>
                <canvas class="grafico" id="grafi-valor-vendas-por-dia" width="400" height="185"></canvas>
            </div>
            <div class="card-footer ">
                <hr>
                <!--<div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update Now
                </div>-->
            </div>
        </div>
    </div>


</div>

<script src="<?php echo BASEURL; ?>/public/assets/js/core/jquery.min.js"></script>
<script src="<?php echo BASEURL; ?>/public/assets/chartjs/dist/Chart.min.js"></script>

<script>
     ////////////////////////////////////////////////////////
     var ctx = document.getElementById("grafi-valor-vendas-do-mes-no-ano");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                <?php foreach ($data->valorDeVendasPorMesNoAno as $mes):?>
                <?php $nomeDoMes = mesesPorExtensoEnumeroDoMes($mes->mes);?>
                <?php echo "\"{$nomeDoMes}\",";?>
                <?php endforeach?>
            ],
            datasets: [{
                label: 'Valor Vendido',
                data: [
                    <?php foreach ($data->valorDeVendasPorMesNoAno as $valor):?>
                    <?php echo $valor->valor . ',';?>
                    <?php endforeach?>
                ],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                
                borderColor: '#087e5e',
                borderWidth: 1
            }
            ]
        },
        options: {
            responsive: true,
            scales: {
                xAxes: [{
                    ticks: {
                        maxRotation: 90,
                        minRotation: 80
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        min: 0
                    }
                }]
            }
        }
    });
</script>

