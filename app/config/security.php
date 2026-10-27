<?php
// Generar token CSRF único si no existe
function generarCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Validar token CSRF a tiempo constante
function verificarCSRFToken($tokenEnviado) {
    if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $tokenEnviado)) {
        return true;
    }
    return false;
}
?>