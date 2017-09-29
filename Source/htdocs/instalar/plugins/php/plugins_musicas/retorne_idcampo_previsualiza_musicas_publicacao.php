<?php

// retorna o id de campo para previsualizar musicas de publicacao
function retorne_idcampo_previsualiza_musicas_publicacao(){

// retorno
return codifica_md5("idcampo_previsualiza_musicas_publicacao_".retorne_idusuario_logado());

};

?>