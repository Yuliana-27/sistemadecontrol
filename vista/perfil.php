<?php
session_start();
if (empty($_SESSION['nombre']) && empty($_SESSION['apellido'])) {
    header('location:login/login.php');
}
$id= $_SESSION["id"];
?>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">PERFIL</h4>

    <?php
include "../modelo/conexion.php"; // Incluir la conexión aquí
include "../controlador/controlador_modificar_perfil.php";
$sql = $conexion->query("SELECT * FROM usuario WHERE id_usuario = $id");
?>
    <div class="row">
        <form action="" method="POST">
            <?php
            while ($datos = $sql->fetch_object()) { ?>
            <div hidden class="fl-flex-label mb-4 px-2 col-12 col-md-6">
            <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->id_usuario ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="Apellido" class="input input__text" name="txtapellido" value="<?= $datos->apellido ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" placeholder="Usuario" class="input input__text" name="txtusuario" value="<?= $datos->usuario ?>">
            </div>
            <div class="text-right p-2">
                <!-- <a href="usuario.php" class="btn btn-secondary btn-rounded">Atras</a> -->
                <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
            </div>
            <?php }
            ?>
        </form>
    </div>
</div>
<!-- fin del contenido principal -->
<?php require('./layout/footer.php'); ?>
