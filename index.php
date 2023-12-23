<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .wrapper {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .page-header {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }

        table {
            margin-top: 20px;
        }

        table th, table td {
            text-align: center;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip({
                template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
            });
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Vehiculos</h2>
                        <a href="create.php" class="btn btn-success pull-right">
                            <i class="glyphicon glyphicon-plus"></i> Agregar vehiculo
                        </a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM vehicles";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped table-hover'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Placa</th>";
                            echo "<th>Marca</th>";
                            echo "<th>Modelo</th>";
                            echo "<th>Año</th>";
                            echo "<th>Color</th>";
                            echo "<th>Acción</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td style='vertical-align: middle;'>" . $row['id'] . "</td>";
                                echo "<td style='vertical-align: middle;'>" . $row['placa'] . "</td>";
                                echo "<td style='vertical-align: middle;'>" . $row['marca'] . "</td>";
                                echo "<td style='vertical-align: middle;'>" . $row['modelo'] . "</td>";
                                echo "<td style='vertical-align: middle;'>" . $row['anio'] . "</td>";
                                echo "<td style='vertical-align: middle;'>" . $row['color'] . "</td>";
                                echo "<td>";
                                echo "<div style='margin-bottom: 5px;'><a href='read.php?id=". $row['id'] ."' title='Ver' data-toggle='tooltip' style='color: #007bff;'><span class='glyphicon glyphicon-eye-open'></span></a></div>";
                                echo "<div style='margin-bottom: 5px;'><a href='update.php?id=". $row['id'] ."' title='Actualizar' data-toggle='tooltip' style='color: #28a745;'><span class='glyphicon glyphicon-pencil'></span></a></div>";
                                echo "<div><a href='delete.php?id=". $row['id'] ."' title='Borrar' data-toggle='tooltip' style='color: #dc3545;'><span class='glyphicon glyphicon-trash'></span></a></div>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";                            
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No existen registros para mostrar.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
