<?php

header('Content-Type: application/json');

if (isset($_FILES["foto"])) {
    $file = $_FILES["foto"];

    if ($file["error"] == UPLOAD_ERR_INI_SIZE || $file["size"] > 1000000) {
        echo json_encode([
            "message" => "Arquivo excedeu limite de tamanho.",
            "status" => "error",
            "error_code" => $file["error"],
        ]);
        exit;
    }

    $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $supported_extensions = ["jpg", "jpeg", "png", "webp"];

    if (!in_array($extension, $supported_extensions)) {
        echo json_encode([
            "message" => "Arquivo não é uma imagem válida.",
            "status" => "error",
        ]);
        exit;
    }

    

    echo json_encode([
        "message" => "Arquivo enviado com sucesso.",
        "status" => "success",
    ]);
} else {
    echo json_encode([
        "message" => "Nenhum arquivo foi enviado.",
        "status" => "error",
    ]);
}
