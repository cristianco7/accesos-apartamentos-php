<?php
class accesos_VI{
    function __construct(){}
    function iniciarSesion(){
        ?>
                <!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Subsidios vivienda</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        </head>
        <body class="hold-transition login-page">
        <div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>SISTEMA</b> INICIO SESIÓN</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">Inicie sesi&oacute;n para ingresar</p>

            <form action="index.php" method="post">
                <div class="input-group mb-3">
                <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-user"></span>
                    </div>
                </div>
                </div>
                <div class="input-group mb-3">
                <input type="password" name="clave" class="form-control" placeholder="Clave" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                </div>
                <div class="row">
                <!-- /.col -->
                    <div class="col-12">
                        <button type="submit"  class="btn btn-primary btn-block">Iniciar sesión</button>
                    </div>
                </div>
            </form>    <!-- /.col -->
            <!-- /.login-card-body -->
        </div>
        </div>
        </div>
        <!-- /.login-box -->
        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        </body>
        </html>

        <?php
    }


}
?>