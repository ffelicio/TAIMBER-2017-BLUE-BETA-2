<?php

// campo visualizar amigos de usuario
function campo_visualizar_amigos_usuario(){

// globals
global $idioma_sistema;
global $tabela_banco;

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// array com dados de amigos
$array_dados_amigos = $dados_compilados_usuario[$tabela_banco[6]];

// numero de amigos
$numero_amigos = retorne_numero_amigos($array_dados_amigos);

// id de dialogo visualizador de amigos
$id_dialogo_visualizador = retorne_idcampo_md5();

// id de campo visualizador de amigos
$id_campo_visualizador = retorna_idcampo_conteudo_geral();

// opcoes do visualizador
$opcoes_visualizador = campo_opcoes_visualizador_amigos($id_campo_visualizador);

// funcoes
$funcao[0] = "carregar_visualizador_amigos(\"$id_campo_visualizador\");";

// eventos
$evento[0] = "onclick='$funcao[0]'";

// progresso gif
$progresso[0] = campo_progresso_gif(retorna_idcampo_progresso_gif_geral());

// conteudo de dialogo
$conteudo_dialogo = "
$opcoes_visualizador
<div class='classe_div_campo_visualizar_amigos_usuario' id='$id_campo_visualizador'></div>
$progresso[0]

<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
$idioma_sistema[61]
</div>
";

// array de retorno
$array_retorno["campo_visualizador"] = constroe_dialogo($idioma_sistema[60], $conteudo_dialogo, $id_dialogo_visualizador);
$array_retorno["id_dialogo_visualizador"] = $id_dialogo_visualizador;
$array_retorno["id_campo_visualizador"] = $id_campo_visualizador;
$array_retorno["campo_conteudo"] = $conteudo_dialogo;

// retorno
return $array_retorno;

};

?>