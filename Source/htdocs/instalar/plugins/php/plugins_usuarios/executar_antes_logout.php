<?php

// executa antes de deslogar ou fazer logout
function executar_antes_logout(){

// remove o conteudo url nao publicado
remove_conteudo_url_nao_publicado();

// remove as recomendacoes de usuario
remover_recomendacoes_usuario();

};

?>