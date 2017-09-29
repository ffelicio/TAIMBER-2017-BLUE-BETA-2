<?php

// campo com opcoes do visualizador de amigos
function campo_opcoes_visualizador_amigos($id_campo_visualizador){

// globals
global $idioma_sistema;
global $tabela_banco;

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// array com dados de amigos
$array_dados_amigos = $dados_compilados_usuario[$tabela_banco[6]];

// numero de amigos
$numero_amigos = retorne_numero_amigos($array_dados_amigos);

// singular ou plural
if($numero_amigos > 1){

    // adiciona o tamanho
    $numero_amigos = retorne_tamanho_resultado(retorne_numero_amigos($array_dados_amigos));
    
	// textos de campos
	$texto_campo[1] = $idioma_sistema[62].$numero_amigos.$idioma_sistema[63];
	
}else{
	
	// textos de campos
	$texto_campo[1] = $idioma_sistema[64].$numero_amigos.$idioma_sistema[65];
	
};

// funcoes
$funcao[0] = "carregar_visualizador_amigos(\"$id_campo_visualizador\")";
$funcao[1] = "visualizar_todas_amizades_inicial(\"$id_campo_visualizador\")";

// eventos
$evento[0] = "onkeyup='$funcao[0];'";
$evento[1] = "onclick='$funcao[1];'";

// id de campos
$idcampo[0] = "id_campo_pesquisa_amigos_local";

// campo de pesquisa
$campo_pesquisa[0] = "
<div class='classe_div_opcoes_visualizador_amigos_pesquisa_1'>
<input type='text' id='$idcampo[0]' placeholder='$idioma_sistema[42]' $evento[0]>
</div>
";

// campo de pesquisa
$campo_pesquisa[1] = "
<div class='classe_div_opcoes_visualizador_amigos_pesquisa_2'>
<span class='span_link' $evento[1]>$texto_campo[1]</span>
</div>
";

// opcoes de pesquisa de amigos
$opcoes_pesquisa = constroe_opcoes_parametros_pesquisa_amigos($funcao, $idcampo[0]);

// campos de pesquisa
$campo_pesquisa[2] = "
<div class='classe_div_opcoes_visualizador_amigos_pesquisa_3'>
$opcoes_pesquisa
</div>
";

// html
$html = "
<div class='classe_div_opcoes_visualizador_amigos classe_cor_2'>
$campo_pesquisa[0]
$campo_pesquisa[2]
$campo_pesquisa[1]
</div>
";

// retorno
return $html;

};

?>