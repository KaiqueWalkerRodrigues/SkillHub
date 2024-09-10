<?php
// Inicia a sessão
session_start();

// Destroi todas as variáveis de sessão
$_SESSION = array();

// Se deseja destruir também o cookie da sessão (caso esteja sendo utilizado)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroi a sessão
session_destroy();

// Redireciona para a página de login ou outra página desejada
header("Location:login");
exit;
?>
