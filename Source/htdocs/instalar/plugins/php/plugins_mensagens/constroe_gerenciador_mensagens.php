<?php

// constroe o gerenciador de mensagens
function constroe_gerenciador_mensagens(){

// globals
global $idioma_sistema;

// id de campo
$idcampo[0] = retorna_idcampo_conteudo_geral();

// campo pesquisa mensagem
$campo_pesquisa = constroe_pesquisa_mensagem($idcampo[0]);

// constroe o campo paginador de mensagens
$campo_paginador = constroe_campo_paginador_mensagens($idcampo[0]);

// html
$html = "
$campo_pesquisa
$campo_paginador
";

// retorno
return constroe_conteudo_padrao(true, $html, null);

};

?>