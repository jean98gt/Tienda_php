

<?php

require_once '../modelo/personasM.php';
require_once './Mensajes.php';

class empleadosC extends empleados {

    function __construct() {
        switch ($_REQUEST['accion']) {
            case "Guardar":
                $this->head();
                $this->resgistrar();
                $this->footer();
                break;
            case "Actualizar":
                $this->head();
                $this->actualizar();
                $this->footer();
                break;
            case "Eliminar":
                $this->head();
                $this->eliminar();
                $this->footer();
                break;
            case "Consultar":
                $this->consultar();
                break;
            default:
                break;
        }
    }

    function head() {
        echo '<!DOCTYPE html>
        <html>
        <head>
            <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <script src="../bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
            <script src="../bootstrap/js/popper.min.js" type="text/javascript"></script>
            <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        </head>
        <body>';
    }

    function footer() {
        echo '</body>
        </html>';
    }

    function consultar() {
        if ($this->validarDatos()) {
            $sql = "SELECT * FROM empleados  WHERE ndocumento='" . $this->getNdocumento() . "'";
            $this->ejecutarSelect($sql);
        }
    }

    function eliminar() {
        if ($this->validarDatos()) {
            $sql = "DELETE FROM empleados  WHERE ndocumento='" . $this->getNdocumento() . "'";
            $this->ejecutarQuery($sql, "La persona se ha eliminado en el base.");
        } else {
            Mensajes::info("Faltan datos, no se pudo registrar");
        }
    }

    function resgistrar() {
        if ($this->validarDatos()) {
            $sql = "INSERT INTO empleados VALUES('" . $this->getndocumento() . "','" . $this->getContraseña() . "')";
            $this->ejecutarQuery($sql, "El empleado se ha registrado en la base.");
        } else {
            Mensajes::info("Faltan datos, no se pudo registrar");
        }
    }

    function actualizar() {
        if ($this->validarDatos()) {
            $sql = "UPDATE empleado SET  ndocumento='" . $this->getNdocumento() . "' , contraseña='" . $this->getContraseña() . "' WHERE ndocumento='" . $this->getNdocumento() . "'";
            $this->ejecutarQuery($sql, "El empleado se ha actualizado en la base.");
        } else {
            Mensajes::info('Los datos no se pueden actualizar.');
        }
    }

    function ejecutarSelect($sql) {
        require_once 'conexion.php';
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $p = array($row['ndocumento'], $row['contraseña']);

                $myJSON = json_encode($p);

                echo $myJSON;//[1013,Juan,Milena,Herrera,García,jua@h.com]
            }
        } else {
            Mensajes::info("No hay resultados");
        }
        $conn->close();
    }

    function ejecutarQuery($sql, $msj) {
        require_once 'conexion.php';
        if ($conn->query($sql) === TRUE) {
            Mensajes::success($msj);
        } else {
            Mensajes::danger($conn->error);
        }

        $conn->close();
    }

    function validarDatos() {
        if (isset($_POST['ndocumento'])) {

            $this->setDocumento($_POST['ndocumento']);
            if ($_POST['accion'] != "Consultar") {
                $this->setNdocumento($_POST['ndocumento']);
                $this->setContraseña($_POST['contraseña']);
               
            }

            return true;
        } else {
            return false;
        }
    }

}

new empleadosC();
?>



