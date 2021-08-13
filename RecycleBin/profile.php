<?php
        session_start();
        if (!isset($_SESSION["usuario"])) {
            header("Location:login.php");
        }else {
            include("conexion.php");
            $usuName = $_SESSION["usuario"];
            $pass = $_SESSION["password"];
            $consulta = "SELECT ID FROM usuarios WHERE `usuarios`= '$usuName' AND `password`= '$pass'";
            $resultados = mysqli_query($conexion,$consulta);
            $fila=mysqli_fetch_array($resultados, MYSQLI_ASSOC);
            $id = $fila["ID"];
            $consulta = "SELECT * FROM trabajadores WHERE ID = $id";
            $resultados = mysqli_query($conexion,$consulta);
            $fila=mysqli_fetch_array($resultados, MYSQLI_ASSOC);
        }
    ?>
    <form action="profile.php" method="post" id="profileForm">
        <table>
            <tr>
                <td colspan="6" style="text-align: center;">
                    <h3>Información del Usuario</h3>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td class="der">
                    <input type="text" name="Nombre" id="Nombre" class="form-control">
                </td>
                <td>Apellido Paterno:</td>
                <td class="der">
                    <input type="text" name="APaterno" id="APaterno" class="form-control">
                </td>
                <td>Apellido Materno:</td>
                <td class="der">
                    <input type="text" name="AMaterno" id="AMaterno" class="form-control">
                </td>
            </tr>
            <tr>
                <td>Cargo:</td>
                <td class="der">
                    <input type="text" name="Cargo" id="Cargo" class="form-control">
                </td>
                <td>Fecha Nacimiento:</td>
                <td class="der">
                    <input type="text" name="FechaNac" id="FechaNac" class="form-control">
                </td>
                <td>Telefono:</td>
                <td class="der">
                    <input type="text" name="Telefono" id="Telefono" class="form-control">
                </td>
            </tr>
            <tr>
                <td>Dirección:</td>
                <td class="der">
                    <input type="text" name="Direccion" id="Direccion" class="form-control">
                </td>
                <td>Colonia:</td>
                <td class="der">
                    <input type="text" name="Colonia" id="Colonia" class="form-control">
                </td>
                <td>C.P.:</td>
                <td class="der">
                    <input type="text" name="CP" id="CP" class="form-control">
                </td>
            </tr>
            <tr>
                <td>Ciudad:</td>
                <td class="der">
                    <input type="text" name="Ciudad" id="Ciudad" class="form-control">
                </td>
                <td>Estado:</td>
                <td class="der">
                    <input type="text" name="Estado" id="Estado" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <input type="submit" value="Modificar" class="btn btn-dark">
                </td>
            </tr>
        </table>
    </form>
    <script>
        $(window).on("load", function(){
            
        });
    </script>