<?php
if (!empty($_POST["btnentrada"])) {
    if (!empty($_POST["txtdni"])) {
    $dni = $_POST["txtdni"];
    $consulta = $conexion->query(" select count(*) as 'total' from empleado where dni='$dni' ");
    $id = $conexion->query(" select id_empleado from empleado where dni='$dni' ");
    if ($consulta->fetch_object()->total > 0) {
        $fecha = date("Y-m-d H:i:s");
        $id_empleado = $id->fetch_object()->id_empleado;


        $consultaFecha=$conexion->query(" select entrada from asistencia where id_empleado=$id_empleado order by id_asistencia desc limit 1");
        $fechaBD=$consultaFecha->fetch_object()->entrada;

        if (substr($fecha, 0, 10)==substr($fechaBD, 0, 10)) { ?>
            <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "Ya Registraste Tu Entrada",
                    styling: "bootstrap3"
                })
            })
        </script>
        <?php } else {
            $sql = $conexion->query(" insert into asistencia(id_empleado,entrada)values($id_empleado, '$fecha') ");
            if ($sql == true) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO!",
                        type: "success",
                        text: "Hola, Bienvenido al ITTUX",
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
                        text: "Error Al Registrar Entrada",
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
                    text: "El Numero de Control No Existe",
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
                    text: "Ingrese Su Número de Control",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php } ?>

    <script>
        setTimeout(() => {
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
    </script>

    
<?php }
?>



<!--Registro de Salida-->


<?php
if (!empty($_POST["btnsalida"])) {
    if (!empty($_POST["txtdni"])) {
    $dni = $_POST["txtdni"];
    $consulta = $conexion->query(" select count(*) as 'total' from empleado where dni='$dni' ");
    $id = $conexion->query(" select id_empleado from empleado where dni='$dni' ");
    if ($consulta->fetch_object()->total > 0) {



        $fecha = date("Y-m-d H:i:s");
        $id_empleado = $id->fetch_object()->id_empleado;
        $busqueda = $conexion->query(" select id_asistencia from asistencia where id_empleado=$id_empleado order bay id_asistencia desc limit 1");

        //para que no haya duplicidad de salidas//

        while ($datos=$busqueda->fetch_object()) {
            $id_asistencia = $datos->id_asistencia;
            $entradaBD=$datos->entrada;
        }

        if (substr($fecha,0,10)!=substr($entradaBD,0,10)) { 
        ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "Primero Debes Registrar Tu Entrada",
                    styling: "bootstrap3"
                })
            })
        </script>
        <?php
        } else {
            $consultaFecha=$conexion->query(" select salida from asistencia where id_empleado=$id_empleado order by id_asistencia desc limit 1");
        $fechaBD=$consultaFecha->fetch_object()->salida;

        if (substr($fecha,0,10) == substr($fechaBD,0,10)) { 
            ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "Ya Registraste Tu Sálida",
                    styling: "bootstrap3"
                })
            })
        </script>
        <?php } else {
            $sql = $conexion->query(" update asistencia set salida='$fecha' where id_asistencia=$id_asistencia ");
            if ($sql == true) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO!",
                        type: "success",
                        text: "Adios, Vuelve Pronto al ITTUX",
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
                        text: "Error Al Registrar Sálida",
                        styling: "bootstrap3"
                    })
                })
            </script>
            <?php }
        }
        
        }
        

        

        //   
        
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "El Numero de Control No Existe",
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
                    text: "Ingrese Su Número de Control",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php } ?>

    <script>
        setTimeout(() => {
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
    </script>

    
<?php }
?>
