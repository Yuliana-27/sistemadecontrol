<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) && !empty($_POST["txtapellido"]) && !empty($_POST["txtdni"]) && !empty($_POST["txtcargo"])) {
        
        // Validar y sanitizar entradas
        $nombre = filter_var($_POST["txtnombre"], FILTER_SANITIZE_STRING);
        $apellido = filter_var($_POST["txtapellido"], FILTER_SANITIZE_STRING);
        $dni = filter_var($_POST["txtdni"], FILTER_SANITIZE_STRING);
        $cargo = filter_var($_POST["txtcargo"], FILTER_SANITIZE_NUMBER_INT);

        // Preparar y ejecutar la consulta
        $sql = $conexion->prepare("INSERT INTO empleado (nombre, apellido, dni, cargo) VALUES (?, ?, ?, ?)");
        $sql->bind_param("sssi", $nombre, $apellido, $dni, $cargo);

        if ($sql->execute()) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO!",
                        type: "success",
                        text: "Alumno registrado correctamente",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR!",
                        type: "error",
                        text: "Alumno NO registrado",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "Los Campos Están Vacíos",
                    styling: "bootstrap3"
                });
            });
        </script>
    <?php } ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>
<?php }
?>
