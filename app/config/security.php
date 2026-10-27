<?php
// Generar un Token CSRF único si no existe en la sesión
function generarCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Verificar si el token enviado por el formulario coincide con el de la sesión en tiempo constante
function verificarCSRFToken($tokenEnviado) {
    if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $tokenEnviado)) {
        return true;
    }
    return false;
}
?>