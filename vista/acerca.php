<?php
session_start();
if (empty($_SESSION['nombre']) && empty($_SESSION['apellido'])) {
    header('location:login/login.php');
    exit(); // Agregar exit() después de redirigir para evitar que el resto del código se ejecute
}

include "../modelo/conexion.php"; // Incluir la conexión aquí
include "../controlador/controlador_modificar_empresa.php";
$sql = $conexion->query("SELECT * FROM empresa");
$datos = $sql->fetch_object(); // Obtener solo un conjunto de datos, asumiendo que solo necesitas mostrar una empresa

// Verificar si se recibió el formulario y realizar acciones necesarias (no está implementado en este código)

?>
<style>
    ul li:nth-child(5) .activo {
        background: rgb(11, 150, 214) !important;
    }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">INFORMACIÓN DE LA EMPRESA</h4>

    <div class="row">
        <form action="" method="POST">
            <div hidden class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->id_empresa ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="Telefono" class="input input__text" name="txttelefono" value="<?= $datos->telefono ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="Ubicacion" class="input input__text" name="txtubicacion" value="<?= $datos->ubicacion ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="txt" placeholder="Ruc" class="input input__text" name="txtruc" value="<?= $datos->ruc ?>">
            </div>
            <div class="text-right p-2">
                <!--<a href="usuario.php" class="btn btn-secondary btn-rounded">Atras</a> -->
                <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <p>
                    <strong>Autor:</strong>
                    Yuliana del Carmen Altamirano Montes <br>
                    <strong>Carrera:</strong> Ingenieria en Sistemas Computacionales  <br>
                    <strong>Edad:</strong> 21 años<br>
                    <strong>Descripción:</strong> Desarrollo de un Sistema de Acceso de Entrada y Sálida de los Alumnos del
                    Instituto Tecnologico de Tuxtepec. <br>
                    <strong>Conocimiento:</strong> <br>
                    HTML <br>
                    PHP <br>
                    CSS <br>
                    <strong>Contacto:</strong> 2871655409 <br>
                    <strong>Correo:</strong> isc20350250@gmail.com  <br>
                    
                </p>
            </div>

            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <p>
                    <strong>Autor:</strong>
                    Jennifer Vendrell Javier <br>
                    <strong>Carrera:</strong> Ingenieria en Sistemas Computacionales  <br>
                    <strong>Edad:</strong> 21 años<br>
                    <strong>Descripción:</strong> Desarrollo de un Sistema de Acceso de Entrada y Sálida de los Alumnos del
                    Instituto Tecnologico de Tuxtepec. <br>
                    <strong>Conocimiento:</strong> <br>
                    HTML <br>
                    PHP <br>
                    CSS <br>
                    <strong>Contacto:</strong> 2871450362 <br>
                    <strong>Correo:</strong> isc20350326@gmail.com
                    
                </p>
            </div>

            
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <p>
                    <strong>Autor:</strong>
                    Gerardo Luis Quiroga Leon <br>
                    <strong>Carrera:</strong> Ingenieria en Sistemas Computacionales  <br>
                    <strong>Edad:</strong> 21 años<br>
                    <strong>Descripción:</strong> Desarrollo de un Sistema de Acceso de Entrada y Sálida de los Alumnos del
                    Instituto Tecnologico de Tuxtepec. <br>
                    <strong>Conocimiento:</strong> <br>
                    HTML <br>
                    PHP <br>
                    CSS <br>
                    <strong>Contacto:</strong> 2871148477 <br>
                    <strong>Correo:</strong> isc20350309@gmail.com
                    
                </p>
            </div>
        </form>
    </div>
</div>
<!-- fin del contenido principal -->
<?php require('./layout/footer.php'); ?>
