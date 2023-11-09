<?php

require "conection.php";

$validate = validate_person();
if($validate["status"]=="erro") {
    echo json_encode($validate);
    exit;
}

$email = $_POST["email"];
$password = $_POST["password"];

$query = "SELECT * FROM usuarios WHERE email_user = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$email]);

if($stmt->rowCount() == 0){
    // coloca coisa que o usuario nao existe
    $response["status"] = "erro";
    $response["message"] = "essa conta nao existe";
    echo json_encode($response);
    exit;
}

$user = $stmt->fetch();

if (!password_verify($password, $user["senha_user"])) {
    $response["status"] = "erro";
    $response["message"] = "essa conta não existe";
    echo json_encode($response);
    exit;
}

$response["status"] = "sucesso";
$response["message"]="Bem vindo, logado com sucesso";
echo json_encode($response);


function validate_person(){
        $response = [];
        $response["status"] = "sucesso";

        if (!$_POST["email"]){
            $response["status"] = "erro";
            $response["message"] = "Campo email deve estar presente.";
        }
        elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $response["status"] = "erro";
            $response["message"] = "Email inválido.";
        }
        elseif (!$_POST["password"]){
            $response["status"] = "erro";
            $response["message"] = "Campo senha deve estar presente.";
        }
        elseif (strlen($_POST["password"]) < 8){
            $response["status"] = "erro";
            $response["message"] = "Senha deve possuir no mínimo 8 caracteres.";
        }

        return $response;
    }

?>


