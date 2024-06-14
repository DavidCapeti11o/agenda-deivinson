<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "agenda";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

$resultados = [];
if (isset($_POST['buscar'])) {
    $nombreBuscar = $_POST['nombreBuscar'];
    $query = "SELECT * FROM AGENDA1 WHERE Nombre LIKE '%$nombreBuscar%'";
    $result = mysqli_query($enlace, $query);
    
    while ($fila = mysqli_fetch_assoc($result)) {
        $resultados[] = $fila;
    }
}

$todosLosRegistros = [];
if (isset($_POST['ver_todo'])) {
    $query = "SELECT * FROM AGENDA1";
    $result = mysqli_query($enlace, $query);
    
    while ($fila = mysqli_fetch_assoc($result)) {
        $todosLosRegistros[] = $fila;
    }
}

// Insertar datos en la base de datos
if (isset($_POST['registro'])) {
    $Nombre= $_POST['Nombre'];
    $Apellidos= $_POST['Apellidos'];
    $Domicilio= $_POST['Domicilio'];
    $Telefono_de_casa= $_POST['Telefono_de_casa'];
    $Celular= $_POST['Celular'];
    $Fecha_de_nacimiento= $_POST['Fecha_de_Nacimiento'];
    $Correo= $_POST['Correo'];

    $insertarDatos = "INSERT INTO AGENDA1( Nombre,Apellidos,Domicilio,Telefono_de_casa,Celular,Fecha_de_nacimiento,Correo_electronico) VALUES ('$Nombre','$Apellidos','$Domicilio','$Telefono_de_casa','$Celular','$Fecha_de_nacimiento','$Correo')";

    $ejecutarInsertar = mysqli_query($enlace, $insertarDatos);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario</title>
<style>
    body {
        font-family: arial , sans-serif;
        background-color: #D8D8D8;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    form {
        background-color: #FFFFFF;
        padding: 80px;
        border-radius: 20px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 400px;
    }
    input[type="text"],
    input[type="email"],
    input[type="submit"],
    input[type="reset"],
    input[type="date"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 5px solid #ccc;
        border-radius: 15px;
        box-sizing: border-box;
    }
    input[type="submit"],
    input[type="reset"] {
        background-color: #0055FF;
        color: white;
        cursor: pointer;
    }
    input[type="submit"]:hover,
    input[type="reset"]:hover {
        background-color: #6585C6;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 2px solid black;
    }
    th, td {
        padding: 5px;
        text-align: left;
    }
</style>
</head>
<body>

<form action="#" name="agenda" method="post">
    <input type="text" name="nombreBuscar" placeholder="Buscar por nombre">

    <input type="submit" name="buscar" value="Buscar">
    
    
    <input type="text" name="Nombre" placeholder="Nombre">
    
    <input type="text" name="Apellidos" placeholder="Apellidos">
    
    <input type="text" name="Domicilio" placeholder="Domicilio">
    
    <input type="text" name="Telefono_de_casa" placeholder="Telefono de casa">
    
    <input type="text" name="Celular" placeholder="Celular">
    
    <input type="date" name="Fecha_de_Nacimiento" placeholder="Fecha de nacimiento">
    
    <input type="email" name="Correo" placeholder="Correo">

    <input type="submit" name="registro" value="Guardar registro">

    <input type="reset">
    
    <input type="submit" name="ver_todo" value="Mostrar tabla">
</form>

<?php if (!empty($resultados)) : ?>
    <ul>
        <?php foreach ($resultados as $resultado) : ?>
            <li>
                <?php echo "Nombre: " . $resultado['Nombre'] . "<br>"; 
                      echo " Apellidos: " . $resultado['Apellidos'] . "<br>";
                      echo " Domicilio: " . $resultado['Domicilio'] . "<br>"; 
                      echo " Telefono_de_casa: " . $resultado['Telefono_de_casa'] . "<br>";
                      echo " Celular:" . $resultado['Celular'] . "<br>"; 
                      echo " Fecha de nacimiento: " . $resultado['Fecha_de_nacimiento'] . "<br>";
                      echo " Correo: " . $resultado['Correo_electronico']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if (!empty($todosLosRegistros)) : ?>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Domicilio</th>
                <th>Teléfono de casa</th>
                <th>Celular</th>
                <th>Fecha de nacimiento</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todosLosRegistros as $registro) : ?>
                <tr>
                    <td><?php echo $registro['Nombre']; ?></td>
                    <td><?php echo $registro['Apellidos']; ?></td>
                    <td><?php echo $registro['Domicilio']; ?></td>
                    <td><?php echo $registro['Telefono_de_casa']; ?></td>
                    <td><?php echo $registro['Celular']; ?></td>
                    <td><?php echo $registro['Fecha_de_nacimiento']; ?></td>
                    <td><?php echo $registro['Correo_electronico']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
