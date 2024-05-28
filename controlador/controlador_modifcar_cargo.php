<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre = $_POST["txtnombre"];
        $id = $_POST["txtid"];
        
        // Verifica la conexión a la base de datos
        if ($conexion->connect_error) {
            die("Error en la conexión a la base de datos: " . $conexion->connect_error);
        }
        
        // Depura la consulta SQL
        $verificarNombreQuery = "SELECT COUNT(*) AS total FROM cargo WHERE nombre='$nombre' AND id_cargo != '$id'";
        
        $verificarNombre = $conexion->query($verificarNombreQuery);
        
        // Verifica si la consulta se ejecutó correctamente
        if ($verificarNombre === false) {
            echo "Error en la consulta SQL: " . $conexion->error;
        } else {
            $result = $verificarNombre->fetch_assoc();
            if ($result && $result['total'] > 0) { ?>
                <script>
                    $(function() {
                        new PNotify({
                            title: "ERROR!",
                            type: "error",
                            text: "El Nombre <?= $nombre ?> Ya Existe",
                            styling: "bootstrap3"
                        });
                    });
                </script>
            <?php } else {
                $updateQuery = "UPDATE cargo SET nombre='$nombre' WHERE id_cargo='$id'";
                
                $sql = $conexion->query($updateQuery);
                if ($sql === false) {
                    // Manejar el error de la consulta de actualización
                    echo "Error en la consulta de actualización: " . $conexion->error;
                } else {
                    if ($sql->affected_rows > 0) { ?>
                        <script>
                            $(function() {
                                new PNotify({
                                    title: "ERROR!",
                                    type: "error",
                                    text: "Cargo No Modificado Correctamente",
                                    styling: "bootstrap3"
                                });
                            });
                        </script>
                    <?php } else { ?>
                        <script>
                            $(function() {
                                new PNotify({
                                    title: "CORRECTO!",
                                    type: "success",
                                    text: "Cargo Modificado Correctamente",
                                    styling: "bootstrap3"
                                });
                            });
                        </script>
                    <?php }
                }
            }
        }
    } else { ?>
        <script>
            $(function() {
                new PNotify({
                    title: "ERROR!",
                    type: "error",
                    text: "Los Campos Estan Vacios",
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

<?php } ?>
