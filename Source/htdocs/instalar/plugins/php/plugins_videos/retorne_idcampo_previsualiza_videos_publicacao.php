<?php

// retorna o id de campo para previsualizar videos de publicacao
function retorne_idcampo_previsualiza_videos_publicacao(){

// retorno
return codifica_md5("idcampo_previsualiza_videos_publicacao_".retorne_idusuario_logado());

};

?>