<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$placa = $marca = $modelo = $anio = $color = "";
$placa_err = $marca_err = $modelo_err = $anio_err = $color_err = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate placa
    $input_placa = trim($_POST["placa"]);
    if (empty($input_placa)) {
        $placa_err = "Por favor ingrese la placa del vehículo.";
    } else {
        $placa = $input_placa;
    }
    
    // Validate marca
    $input_marca = trim($_POST["marca"]);
    if (empty($input_marca)) {
        $marca_err = "Por favor ingrese la marca del vehículo.";     
    } else {
        $marca = $input_marca;
    }
    
    // Validate modelo
    $input_modelo = trim($_POST["modelo"]);
    if (empty($input_modelo)) {
        $modelo_err = "Por favor ingrese el modelo del vehículo.";     
    } else {
        $modelo = $input_modelo;
    }
    
    // Validate anio
    $input_anio = trim($_POST["anio"]);
    if (empty($input_anio)) {
        $anio_err = "Por favor ingrese el año del vehículo.";     
    } elseif (!ctype_digit($input_anio)) {
        $anio_err = "Por favor ingrese un valor numérico para el año.";
    } else {
        $anio = $input_anio;
    }

    // Validate color
    $input_color = trim($_POST["color"]);
    if (empty($input_color)) {
        $color_err = "Por favor ingrese el color del vehículo.";     
    } else {
        $color = $input_color;
    }
    
    // Check input errors before inserting in database
    if (empty($placa_err) && empty($marca_err) && empty($modelo_err) && empty($anio_err) && empty($color_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO vehicles (placa, marca, modelo, anio, color) VALUES (?, ?, ?, ?, ?)";
         
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssis", $param_placa, $param_marca, $param_modelo, $param_anio, $param_color);
            
            // Set parameters
            $param_placa = $placa;
            $param_marca = $marca;
            $param_modelo = $modelo;
            $param_anio = $anio;
            $param_color = $color;
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agregar Vehículo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Agregar Vehículo</h2>
                    </div>
                    <p>Favor completar el siguiente formulario, para agregar el vehículo.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($placa_err)) ? 'has-error' : ''; ?>">
                            <label>Placa</label>
                            <input type="text" name="placa" class="form-control" value="<?php echo $placa; ?>">
                            <span class="help-block"><?php echo $placa_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($marca_err)) ? 'has-error' : ''; ?>">
                            <label>Marca</label>
                            <input type="text" name="marca" class="form-control" value="<?php echo $marca; ?>">
                            <span class="help-block"><?php echo $marca_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($modelo_err)) ? 'has-error' : ''; ?>">
                            <label>Modelo</label>
                            <input type="text" name="modelo" class="form-control" value="<?php echo $modelo; ?>">
                            <span class="help-block"><?php echo $modelo_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($anio_err)) ? 'has-error' : ''; ?>">
                            <label>Año</label>
                            <input type="text" name="anio" class="form-control" value="<?php echo $anio; ?>">
                            <span class="help-block"><?php echo $anio_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($color_err)) ? 'has-error' : ''; ?>">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control" value="<?php echo $color; ?>">
                            <span class="help-block"><?php echo $color_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
