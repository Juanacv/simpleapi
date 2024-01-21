<?php
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['token'])) {
    $attributes = ["name"=>$_POST['name'],'token'=>$_POST['token']];
    $verb = $_POST['verb'];

    $url = 'http://127.0.0.1/simple-api/api/'.$_POST['method'];
    $ch = curl_init($url);

    // Configurar opciones para la solicitud PUT
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verb);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($attributes)); // Aquí puedes ajustar la forma en que envías los datos según tus necesidades
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud
    $response = curl_exec($ch);

    // Verificar errores
    if (curl_errno($ch)) {
        echo 'Error en la solicitud cURL: ' . curl_error($ch);
    }

    // Cerrar la sesión cURL
    curl_close($ch);
    
    // Manejar la respuesta (puedes hacer lo que necesites con $response)
    echo $response;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Envío a API</title>
    </head>
    <body>
        <h2>Probar api</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
            <select name="verb" id="verb">
                <option value="GET">GET</option>
                <option value="POST">POST</option>
                <option value="PUT">PUT</option>
                <option value="DELETE">DELETE</option>
            </select>
            <select name="method" id="method">
                <option value="welcome">welcome</option>
                <option value="sayhello">sayhello</option>
            </select>            
            <input type="text" name="name" id="name">
            <input type="hidden" name="token" value="fa3b2c9c-a96d-48a8-82ad-0cb775dd3e5d">
            <button type="submit">Enviar</button>
        </form>
    </body>
</html>
