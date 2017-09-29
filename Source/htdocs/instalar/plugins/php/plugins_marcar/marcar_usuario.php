<?php

// marca usuario
function marcar_usuario(){

// dados de formulario
$id = retorne_campo_formulario_request(4);
$tabela = retorne_campo_formulario_request(10);
$chave = retorne_campo_formulario_request(3);
$uidamigo = retorne_idamigo_request(13);
$modo = retorne_campo_formulario_request(6);

// atualiza a sessao de marcador
sessao_marcador_usuario_seta_retorna($id, $tabela, $chave, $uidamigo, $modo);

// modo atual depois de atualizar
$modo = sessao_marcador_usuario_seta_retorna(null, null, $chave, $uidamigo, 3);

// dados de retorno
$array_retorno["dados"] = constroe_campo_marcador_usuario($uidamigo, $chave, $modo, false);

// retorno
return json_encode($array_retorno);

};

?>