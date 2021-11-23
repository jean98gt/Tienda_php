<!DOCTYPE html>
<html>
      <head>
        <meta charset="utf-8"/>
        <title>productos</title>

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/popper.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            function ajax() {
                var d = document.getElementById("productos").value;
                const xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function () {
                    try {
                        myObj = JSON.parse(this.responseText);//[1013,Juan,Milena,Herrera,García,jua@h.com]
                        document.getElementById("Código de barras").value = myObj[1];
                        document.getElementById("Nombre").value = myObj[2];
                        document.getElementById("Descripción").value = myObj[3];
                    } catch (e) {
                        document.getElementById("Código de barras").value = "";
                        document.getElementById("Nombre").value = "";
                        document.getElementById("Descripción").value = "";
                       
                        document.getElementById("ver").innerHTML = this.responseText;
                    }

                }
                xmlhttp.open("POST", "controlador/empleados.php");
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("accion=Consultar&ndocumento=" + d);

            }



            function enviarF(accion) {
                var form = document.enviar;
                form.action = "controlador/productosc.php?accion=" + accion;
                var cd = document.getElementById("Código de barras");
                var n = document.getElementById("Nombre");
                var d = document.getElementById("Descripción");
                var sub = true;
                if (accion == "Guardar") {
                    if (d.value == "") {
                        sub = false;
                        d.style = "border-color:red;";
                    }
                    if (c.value == "") {
                        sub = false;
                        c.style = "border-color:red;";
                    }
                    
                }
                if (accion == "Eliminar") {
                    if (d.value == "") {
                        sub = false;
                        d.style = "border-color:red;";
                    }
                }
                if (accion == "Consultar") {
                    sub = false;
                    if (d.value == "") {
                        d.style = "border-color:red;";
                    } else {
                        ajax();
                    }
                }
             if (sub) {
                    form.submit();
                }
            }
        </script>
        <style type="text/css">
            input{
                padding: 5px;
                text-align: center;
                font-family: cursive;
            }
            #tabla1{
                width: 434px;

            }
        </style>
    </head>
    <body>


        <form action="" method="post" name="enviar">
            <table id="tabla1" class="table table-hover table-bordered">
                <tr>
                    <td><label for="Código de barras" class="form-label">Código de barras</label></td>
                    <td><input type="number" class="form-control" id="Código de barras" name="Código de barras" ></td>
                </tr>
                <tr>
                    <td><label for="Nombre" class="form-label">Nombre</label></td>
                    <td><input type="text" class="form-control" id="Nombre" name="Nombre"></td>
                </tr>
                <tr>
                    <td><label for="Descripción" class="form-label">Descripción</label></td>
                    <td><input type="text" class="form-control" id="Descripción" name="Descripción"></td>
                </tr>
                
                <tr>
                    <td><input type="button" value="Guardar" class="btn btn-danger"  onclick="enviarF('Guardar')"></td>
                    <td><input type="button" value="Actualizar" class="btn btn-danger" onclick="enviarF('Actualizar')"></td>
                </tr>
                <tr>
                    <td><input type="button" value="Eliminar" class="btn btn-danger" onclick="enviarF('Eliminar')"></td>
                    <td><input type="button" value="Consultar" class="btn btn-danger" onclick="enviarF('Consultar')"></td>
                </tr>
            </table>
        </form>
        <div id="ver">
        </div>
        <?php ?>
    </body>
</html>