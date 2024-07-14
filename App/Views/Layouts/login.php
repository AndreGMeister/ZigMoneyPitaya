<!DOCTYPE html>
<html>
<head>

    <?php if (getenv('APPLICATION_NAME')): ?>
        <link rel="shortcut icon" href="public/img/favicon_tonie.png"/>
    <?php else: ?>
        <link rel="shortcut icon" href="public/img/favicon.png"/>
    <?php endif; ?>

    <?php if (getenv('APPLICATION_NAME')): ?>
        <title><?php echo getenv('APPLICATION_NAME'); ?></title>
    <?php else: ?>
        <title>ZigMoney</title>
    <?php endif; ?>

    <meta charset="utf-8">
    <base href="<?php echo BASEURL; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>/public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>/public/css/login.css">
    <style type="text/css">
        body {
            background-image: url('<?php echo BASEURL; ?>/public/img/fundo_login.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <?php $this->viewRender(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-validacao" class="modal fade bd-example-modal-lg" role="dialog"
     style="background: rgba(00, 00, 00, 0.6);">
    <div class="modal-dialog" data-backdrop="static">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!--<h4 class="modal-title"></h4>-->
            </div>

            <div class="modal-body">
                <div id="modal-body-content">
                    <p id="p-modal-validation"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASEURL; ?>/public/assets/js/core/jquery.min.js"></script>
<script src="<?php echo BASEURL; ?>/public/assets/js/core/popper.min.js"></script>
<script src="<?php echo BASEURL; ?>/public/assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo BASEURL; ?>/public/js/helpers.js"></script>

</body>
</html>
