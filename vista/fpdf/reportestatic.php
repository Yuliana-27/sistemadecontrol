<?php
include("FusionCharts.php"); // Incluir la clase FusionCharts
?>

<html>
<head>
    <title>Gráfico de Empleados por Cargo</title>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
</head>
<body>
    <?php
        // Datos estáticos obtenidos previamente de la base de datos
        $data = [
            ["label" => "Sistemas", "value" => 8],
            ["label" => "Civil", "value" => 1],
            ["label" => "Bioquimíca", "value" => 4],
            ["label" => "Administración", "value" => 1],
            ["label" => "Informática", "value" => 1],
            ["label" => "Electromecánica", "value" => 2],
            ["label" => "Gestión", "value" => 2]
        ];

        $arrData = array(
            "chart" => array(
                "caption" => "Cantidad de Alumnos por Carrera",
                "xAxisName" => "Carrera",
                "yAxisName" => "Cantidad de Alumnos",
                "theme" => "fusion"
            ),
            "data" => $data
        );

        // Codificar los datos en JSON
        $jsonEncodedData = json_encode($arrData);

        // Crear el gráfico de columnas de FusionCharts usando los datos codificados JSON
        $columnChart = new FusionCharts("column2D", "EmpleadosPorCargoChart", 1200, 300, "chart-1", "json", $jsonEncodedData);

        // Render el gráfico
        $columnChart->render();
    ?>
    
    <!-- Div para renderizar el gráfico -->
    <div id="chart-1"><!-- Fusion Charts se renderizará aquí--></div>
</body>
</html>
