<?php
   include '../../modelo/conexion.php'; // Archivo de conexión a la base de datos
?>

<html>
<head>
    <title>Gráfico de Entrada y Salida</title>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
</head>
<body>
    <?php
        // Formar la consulta SQL para seleccionar las columnas entrada y salida de la tabla asistencia
        $strQuery = "SELECT entrada, salida FROM asistencia";

        // Ejecutar la consulta
        $result = $dbhandle->query($strQuery) or exit("Error al ejecutar la consulta: ".$dbhandle->error);

        // Si la consulta devuelve un resultado válido, preparar el JSON para el gráfico
        if ($result) {
            $arrData = array(
                "chart" => array(
                    "caption" => "Entrada y Salida",
                    "xAxisName" => "Fecha",
                    "yAxisName" => "Cantidad",
                    "theme" => "fusion"
                ),
                "data" => array()
            );

            while ($row = mysqli_fetch_array($result)) {
                array_push($arrData["data"], array(
                    "label" => "Entrada",
                    "value" => $row["entrada"]
                ));
                array_push($arrData["data"], array(
                    "label" => "Salida",
                    "value" => $row["salida"]
                ));
            }

            // Codificar los datos en JSON
            $jsonEncodedData = json_encode($arrData);

            // Crear el gráfico de área de FusionCharts usando los datos codificados JSON
            $areaChart = new FusionCharts("area2D", "EntradaSalidaChart", 600, 300, "chart-1", "json", $jsonEncodedData);

            // Render el gráfico
            $areaChart->render();

            // Cerrar la conexión a la base de datos
            $dbhandle->close();
        }
    ?>
    
    <!-- Div para renderizar el gráfico -->
    <div id="chart-1"><!-- Fusion Charts se renderizará aquí--></div>
</body>
</html>

<?php
?>
