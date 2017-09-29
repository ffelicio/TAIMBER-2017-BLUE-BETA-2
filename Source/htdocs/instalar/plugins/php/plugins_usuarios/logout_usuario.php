<?php

// logout de usuario
function logout_usuario(){

// executa antes de deslogar ou fazer logout
executar_antes_logout();

// libera todas as variaveis de sessao
session_unset();

// faz logout de usuario
salva_sessao_usuario(null, null, null);

};

?>