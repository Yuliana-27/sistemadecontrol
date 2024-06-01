<?php

require('./fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        include '../../modelo/conexion.php'; // llamamos a la conexión BD

        $consulta_info = $conexion->query("SELECT * FROM empresa"); // traemos datos de la empresa desde BD
        $dato_info = $consulta_info->fetch_object();
        $this->Image('../../public/img-inicio/logo2.png', 270, 5, 20); // logo de la empresa, moverDerecha, moverAbajo, tamañoIMG
        $this->SetFont('Arial', 'B', 19); // tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(95); // Movernos a la derecha
        $this->SetTextColor(0, 0, 0); // color
        // creamos una celda o fila
        $this->Cell(110, 15, utf8_decode($dato_info->nombre), 0, 1, 'C', 0); // AnchoCelda, AltoCelda, titulo, borde(1-0), saltoLinea(1-0), posicion(L-C-R), ColorFondo(1-0)
        $this->Ln(3); // Salto de línea
        $this->SetTextColor(103); // color

        /* UBICACION */
        $this->Cell(85); // mover a la derecha
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(96, 10, utf8_decode("Ubicación : " . $dato_info->ubicacion), 0, 0, '', 0);
        $this->Ln(5);

        /* TELEFONO */
        $this->Cell(85); // mover a la derecha
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(59, 10, utf8_decode("Teléfono : " . $dato_info->telefono), 0, 0, '', 0);
        $this->Ln(5);

        /* RUC */
        $this->Cell(85); // mover a la derecha
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(85, 10, utf8_decode("RUC : " . $dato_info->ruc), 0, 0, '', 0);
        $this->Ln(10);

        /* TITULO DE LA TABLA */
        // color
        $this->SetTextColor(0, 95, 189);
        $this->Cell(90); // mover a la derecha
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("REPORTE DE ASISTENCIAS "), 0, 1, 'C', 0);
        $this->Ln(7);

        /* CAMPOS DE LA TABLA */
        // color
        $this->SetFillColor(125, 173, 221); // colorFondo
        $this->SetTextColor(0, 0, 0); // colorTexto
        $this->SetDrawColor(163, 163, 163); // colorBorde
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
        $this->Cell(80, 10, utf8_decode('ALUMNO'), 1, 0, 'C', 1);
        $this->Cell(30, 10, utf8_decode('DNI'), 1, 0, 'C', 1);
        $this->Cell(50, 10, utf8_decode('CARGO'), 1, 0, 'C', 1);
        $this->Cell(50, 10, utf8_decode('ENTRADA'), 1, 0, 'C', 1);
        $this->Cell(50, 10, utf8_decode('SALIDA'), 1, 1, 'C', 1);
    }


    // Pie de página
    function Footer()
    {
        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); // tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); // pie de página (número de página)

        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); // tipo fuente, cursiva, tamañoTexto
        $hoy = date('d/m/Y');
        $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de página (fecha de página)

          // Agregar enlace al archivo XML
          $this->SetY(-15); // Posición: a 1,5 cm del final
          $this->SetFont('Arial','I',10);
          $this->Cell(0,10,utf8_decode('Descargar registros en formato XML: '),0,1);
          $this->SetTextColor(0,0,255);
          $this->Cell(0,3,'reporteAsistencia.xml',0,1,'', false, 'reporteAsistencia.xml');
    }
}

include '../../modelo/conexion.php';

/* FUNCION PARA GENERAR XML */
function generarXML($conexion)
{
    $consulta_reporte_asistencia = $conexion->query("SELECT asistencia.entrada, asistencia.salida, empleado.nombre, empleado.apellido, empleado.dni, cargo.nombre as 'nomCargo' FROM asistencia
    INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado
    INNER JOIN cargo ON empleado.cargo = cargo.id_cargo");

    $xml = new SimpleXMLElement('<asistencias/>');

    while ($datos_reporte = $consulta_reporte_asistencia->fetch_object()) {
        $asistencia = $xml->addChild('asistencia');
        $asistencia->addChild('nombre', $datos_reporte->nombre . " " . $datos_reporte->apellido);
        $asistencia->addChild('dni', $datos_reporte->dni);
        $asistencia->addChild('cargo', $datos_reporte->nomCargo);
        $asistencia->addChild('entrada', $datos_reporte->entrada);
        $asistencia->addChild('salida', $datos_reporte->salida);
    }

    $xml->asXML('ReporteAsistencia.xml');
}

generarXML($conexion);

/* GENERAR PDF */
$pdf = new PDF();
$pdf->AddPage("landscape"); /* aquí entran dos parámetros (orientación, tamaño) V->portrait H->landscape tamaño (A3, A4, A5, letter, legal) */
$pdf->AliasNbPages(); // muestra la página / y total de páginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); // colorBorde

$consulta_reporte_asistencia = $conexion->query("SELECT asistencia.entrada, asistencia.salida, empleado.nombre, empleado.apellido, empleado.dni, cargo.nombre as 'nomCargo' FROM asistencia
INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado
INNER JOIN cargo ON empleado.cargo = cargo.id_cargo");

while ($datos_reporte = $consulta_reporte_asistencia->fetch_object()) {
    $i = $i + 1;
    /* TABLA */
    $pdf->Cell(15, 10, utf8_decode($i), 1, 0, 'C', 0);
    $pdf->Cell(80, 10, utf8_decode($datos_reporte->nombre . " " . $datos_reporte->apellido), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($datos_reporte->dni), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($datos_reporte->nomCargo), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($datos_reporte->entrada), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($datos_reporte->salida), 1, 1, 'C', 0);
}

$pdf->Output('Reporte Asistencia.pdf', 'I'); // nombreDescarga, Visor(I->visualizar - D->descargar)
?>
