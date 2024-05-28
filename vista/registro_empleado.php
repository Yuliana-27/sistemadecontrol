<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
header('location:login/login.php');
}

?>
<style>
ul li:nth-child(3) .activo{
    background: rgb(11, 150, 214) !important;
}
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">REGISTRO DE ALUMNOS</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_empleado.php"
    ?>

    <div class="row">
    <form action="" method="POST">
    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" required>
    </div>
    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Apellido" class="input input__text" name="txtapellido" required>
    </div>
    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <input type="text" placeholder="Num_Control" class="input input__text" name="txtdni" required>
    </div>
    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
        <select name="txtcargo" class="input input__select" required>
            <option value="">Seleccionar...</option>
            <?php
            $sql = $conexion->query("SELECT * FROM cargo");
            while ($datos = $sql->fetch_object()) { ?>
                <option value="<?= $datos->id_cargo ?>"><?= $datos->nombre ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="text-right p-2">
        <a href="empleado.php" class="btn btn-secondary btn-rounded">Atrás</a>
        <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
    </div>
</form>

    </div>
</div>
</div>

<!-- fin del contenido principal -->



<?php require('./layout/footer.php'); ?>