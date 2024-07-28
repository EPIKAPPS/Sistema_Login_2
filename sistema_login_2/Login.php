<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            h1, h2{
                text-align: center;
            }
            table {
                width: 25%;
                background-color: #FFC;
                border: 2px dotted #F00;
                margin: auto;
            }
            .izq{text-align: right;}
            .der{text-align: left;}
            td {
                text-align: center;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <?php
        if (isset($_POST["enviar"])) {

            try {
                $base = new PDO("mysql:host=localhost; dbname=pruebas", "root", ""); //prepara la conexion

                $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //get errores

                $sql = "SELECT * FROM USUARIOS_PASS WHERE USUARIOS= :login AND PASSWORD=  :password";

                $resultado = $base->prepare($sql); //prepara la consulta

                $login = htmlentities(addslashes($_POST["login"])); //recoge el nom-usu y limita caracteres evitando inyeccion

                $password = htmlentities(addslashes($_POST["password"]));

                $resultado->bindValue(":login", $login); //une el marcador con la variable login

                $resultado->bindValue(":password", $password); //une el marcador con la variable passw

                $resultado->execute();

                //rowCount() devuelve 0 si no encuentra nada en la consulta, o el numero de coincidencias si hubo.
                $numero_registro = $resultado->rowCount();

                if ($numero_registro != 0) {

                    session_start();

                    $_SESSION["usuario"] = $_POST["login"];
                } else {

                    echo "Error. Usuario o contraseña incorrecto";
                }
            } catch (Exception $ex) {
                die("Error: " . $ex->getMessage()); //si hay error en la consulta
            }
        }
        ?>


        <?php
        if (!isset($_SESSION["usuario"])) { //comprueba si se inicio sesion
            include ("formulario.html"); // si no entra, el fomulario se repite
        } else {
            echo "Usuario: " . $_SESSION["usuario"]; // si entra aparece el nombre de usuario
            echo '<br><a href="Login_cierre.php">Cerrar Sesión</a><br>';
        }
        ?>
         <h2>CONTENIDO DE LA WEB</h2>
        <table>
            <tr>
                <td><img src="Sin-título-1-770x402.png" width="300" height="166"></td>
                <td><img src="roastbrief-anime-en-mexico.jpg" width="300" height="166"></td>
            </tr>
            <tr>
                <td><img src="principal-dragon-ball-anime.jpg" width="300" height="166"></td>
                <td><img src="sailor-moon-serie-anime.jpg" width="300" height="166"></td>
            </tr>
        </table>
    </body>
</html>
