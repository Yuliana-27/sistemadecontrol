<?php
   include '../../modelo/conexion.php'; // Archivo de conexión a la base de datos
   include("FusionCharts.php"); // Incluir la clase FusionCharts
?>

<html>
<head>
    <title>Gráfico de Entrada por Cargo</title>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
</head>
<body>
    <?php
        // Formar la consulta SQL para seleccionar el conteo de entradas agrupadas por cargo
        $strQuery = "SELECT cargo.nombre AS cargo, COUNT(asistencia.id_empleado) AS cantidad_entradas 
                FROM asistencia 
                JOIN empleado ON asistencia.id_empleado = empleado.id_empleado 
                JOIN cargo ON empleado.cargo = cargo.id_cargo 
                GROUP BY cargo.nombre";

        // Ejecutar la consulta
        $result = $conexion->query($strQuery) or exit("Error al ejecutar la consulta: ".$conexion->error);

        // Si la consulta devuelve un resultado válido, preparar el JSON para el gráfico
        if ($result->num_rows > 0) {
            $arrData = array(
                "chart" => array(
                    "caption" => "Cantidad de Entradas por Carrreras",
                    "xAxisName" => "Carreras",
                    "yAxisName" => "Cantidad de Entradas",
                    "theme" => "fusion"
                ),
                "data" => array()
            );

            while ($row = mysqli_fetch_array($result)) {
                array_push($arrData["data"], array(
                    "label" => $row["cargo"],
                    "value" => $row["cantidad_entradas"]
                ));
            }

            // Codificar los datos en JSON
            $jsonEncodedData = json_encode($arrData);

            // Crear el gráfico de columnas de FusionCharts usando los datos codificados JSON
            $columnChart = new FusionCharts("column2D", "EntradaPorCargoChart", 1200, 300, "chart-1", "json", $jsonEncodedData);

            // Render el gráfico
            $columnChart->render();

            // Cerrar la conexión a la base de datos
            $conexion->close();
        } else {
            echo "No se encontraron datos.";
        }
    ?>
    
    <!-- Div para renderizar el gráfico -->
    <div id="chart-1"><!-- Fusion Charts se renderizará aquí--></div>
</body>
</html>
