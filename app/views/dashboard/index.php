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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

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

    <table border="1" cellpadding="10" cellspacing="0"  id="tablaUsuarios" border="1" cellpadding="10" cellspacing="0">

        <thead>

            <tr>
                <th>
                    <input type="checkbox" id="seleccionarTodos">
                </th>

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
                        <input type="checkbox" name="usuarios[]" value="<?php echo $usuario["us_id"]; ?>" class="checkboxUsuario">
                    </td>               
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


        document.getElementById("seleccionarTodos").addEventListener("change", function() {
            const checkboxes = document.querySelectorAll(".checkboxUsuario");
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById("seleccionarTodos").checked;
            });
        });


        $(document).ready(function() {

        $('#tablaUsuarios').DataTable({

            dom: 'Bfrtip',

            buttons: [

                {
                    extend: 'excelHtml5',
                    text: 'Exportar seleccionados a Excel',
                    title: 'Usuarios seleccionados',

                    exportOptions: {

                        columns: [1, 2, 3, 4, 5, 6, 7],

                        rows: function (idx, data, node) {

                            return $(node)
                                .find('.checkboxUsuario')
                                .prop('checked');

                        }

                    }

                },

                {
                    extend: 'pdfHtml5',
                    text: 'Exportar seleccionados a PDF',
                    title: 'Usuarios seleccionados',

                    orientation: 'landscape',

                    pageSize: 'A4',

                    exportOptions: {

                        columns: [1, 2, 3, 4, 5, 6, 7],

                        rows: function (idx, data, node) {

                            return $(node)
                                .find('.checkboxUsuario')
                                .prop('checked');

                        }

                    }

                },

                {
                    extend: 'print',
                    text: 'Imprimir seleccionados',

                    exportOptions: {

                        columns: [1, 2, 3, 4, 5, 6, 7],

                        rows: function (idx, data, node) {

                            return $(node)
                                .find('.checkboxUsuario')
                                .prop('checked');

                        }

                    }

                }

            ]

        });

        });

        // botones
        buttons: [

                {
                    extend: 'excelHtml5',
                    text: 'Exportar a Excel',
                    title: 'Usuarios registrados',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                },

                {
                    extend: 'pdfHtml5',
                    text: 'Exportar a PDF',
                    title: 'Usuarios registrados',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                },

                {
                    extend: 'print',
                    text: 'Imprimir',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                }

            ]


    </script>