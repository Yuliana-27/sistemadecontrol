<?php
if (!empty($_POST["btnentrada"])) {
    if (!empty($_POST["txtdni"])) {
        $dni = $_POST["txtdni"];
        $consulta = $conexion->query("SELECT count(*) as 'total', id_empleado FROM empleado WHERE dni='$dni'");
        $empleado = $consulta->fetch_assoc(); 

        if ($empleado['total'] > 0) {
            date_default_timezone_set('America/Mexico_City');
            $fecha = date("Y-m-d");

            // Verificar si ya registró entrada hoy
            $consultaFecha = $conexion->query("SELECT entrada FROM asistencia WHERE id_empleado={$empleado['id_empleado']} AND DATE(entrada) = '$fecha'");
            $entradaHoy = $consultaFecha->fetch_assoc();

            if ($entradaHoy) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "ERROR!",
                            type: "error",
                            text: "Ya has registrado tu entrada hoy",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php } else {
                $sql = $conexion->query("INSERT INTO asistencia(id_empleado, entrada) VALUES ({$empleado['id_empleado']}, NOW())");
                if ($sql) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "CORRECTO!",
                                type: "success",
                                text: "¡Hola, bienvenido al ITTUX!",
                                styling: "bootstrap3"
                            })
                        })
                    </script>
                <?php } else { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "ERROR!",
                                type: "error",
                                text: "Error al registrar entrada",
                                styling: "bootstrap3"
                            })
                        })
                    </script>
                <?php }
            }
        } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR!",
                        type: "error",
                        text: "El número de control no existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "Ingrese su número de control",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php } ?>

    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>
<?php } ?>


<!--Registro de Salida-->

<?php
if (!empty($_POST["btnsalida"])) {
    if (!empty($_POST["txtdni"])) {
        $dni = $_POST["txtdni"];
        $consulta = $conexion->query("SELECT count(*) as 'total', id_empleado FROM empleado WHERE dni='$dni'");
        $empleado = $consulta->fetch_assoc();

        if ($empleado['total'] > 0) {
            date_default_timezone_set('America/Mexico_City');
            $fecha = date("Y-m-d");

            // Verificar si ya registró salida hoy
            $consultaFecha = $conexion->query("SELECT salida FROM asistencia WHERE id_empleado={$empleado['id_empleado']} AND DATE(salida) = '$fecha'");
            $salidaHoy = $consultaFecha->fetch_assoc();

            if ($salidaHoy) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "ERROR!",
                            type: "error",
                            text: "Ya has registrado tu salida hoy",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php } else {
                $sql = $conexion->query("UPDATE asistencia SET salida = NOW() WHERE id_empleado={$empleado['id_empleado']} AND DATE(entrada) = '$fecha'");
                if ($sql) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "CORRECTO!",
                                type: "success",
                                text: "¡Adiós, que tengas un buen día!",
                                styling: "bootstrap3"
                            })
                        })
                    </script>
                <?php } else { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "ERROR!",
                                type: "error",
                                text: "Error Al Registrar Salida",
                                styling: "bootstrap3"
                            })
                        })
                    </script>
                <?php }
            }
        } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR!",
                        type: "error",
                        text: "El número de control no existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "Ingrese su número de control",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php } ?>

    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>
<?php } ?>
