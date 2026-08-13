<?php

date_default_timezone_set('America/Mexico_City');

session_start();

if (!isset($_SESSION["usuario_id"])) {

    header("Location: ../auth/login.php");

    exit();

}
    require_once "../../models/usuario.php";

    $usuario = new Usuario();
    $usuarios = $usuario->obtenerUsuarios();
    $totalUsuarios = $usuario->contarUsuarios();
    $usuariosSexo = $usuario->usuariosPorSexo();

    $sexos = [];
    $cantidades = [];

    foreach ($usuariosSexo as $fila) {
        $sexos[] = $fila["us_sexo"];
        $cantidades[] = $fila["total"];
    }
?>


<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <h1>
        Bienvenido,
        <?php echo $_SESSION["nombre"]; ?>
    </h1>

    <p>
        Has iniciado sesión correctamente.
    </p>

    <p>
        Correo:
        <?php echo $_SESSION["correo"]; ?>
    </p>

    <a href="../../controllers/LogoutController.php">
        Cerrar sesión
    </a>
    <hr>

    <h2>Usuarios registrados</h2>

    <table border="1" cellpadding="10" cellspacing="0">

        <thead>

            <tr>

                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>CURP</th>
                <th>RFC</th>
                <th>Sexo</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($usuarios as $usuario): ?>

                <tr>

                    <td>
                        <?php echo $usuario["us_id"]; ?>
                    </td>

                    <td>
                        <?php echo $usuario["us_nombre"]; ?>
                    </td>

                    <td>
                        <?php echo $usuario["us_correo"]; ?>
                    </td>

                    <td>
                        <?php echo $usuario["us_telefono"]; ?>
                    </td>
    
                    <td>
                        <?php echo $usuario["us_curp"]; ?>
                    </td>

                    <td>
                        <?php echo $usuario["us_rfc"]; ?>
                    </td>

                    <td>
                        <?php echo $usuario["us_sexo"]; ?>
                    </td>
                    
                    <td>
                        <a href="editar.php?id=<?php echo $usuario["us_id"]; ?>">
                            <button type="button">Editar</button>
                        </a>
                    </td>


                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>
    
    <hr>
    <h3>
        Total de usuarios:
        <?php echo $totalUsuarios["total"]; ?>
    </h3>
    <h2>Usuarios por sexo</h2>

    <div style="width: 600px;">
        <canvas id="graficaSexo"></canvas>
    </div>

</body>

</html>

    <script>

        const sexos = <?php echo json_encode($sexos); ?>;
        const cantidades = <?php echo json_encode($cantidades); ?>;
        const ctx = document.getElementById('graficaSexo');

        new Chart(ctx, {

            type: 'bar',
            data: {
                labels: sexos,
                datasets: [{
                    label: 'Usuarios',
                    data: cantidades
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

    </script>