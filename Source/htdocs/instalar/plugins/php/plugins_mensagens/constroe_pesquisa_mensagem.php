<?php

// constroe pesquisa mensagem
function constroe_pesquisa_mensagem($idcampo_resultados){

// globals
global $idioma_sistema;
global $variavel_campo;

// id de campo
$idcampo[0] = codifica_md5("id_campo_entrada_pesquisa_mensagem".data_atual());
$idcampo[1] = $idcampo_resultados;

// eventos
$evento[0] = "onkeyup='pesquisar_troca_mensagem(\"$idcampo[0]\", \"$idcampo[1]\");'";
$evento[1] = "onclick='pesquisar_troca_mensagem(\"$idcampo[0]\", \"$idcampo[1]\");'";

// campos
$campos[0] = constroe_campo_formulario(1, null, $idcampo[0], null, $idioma_sistema[221], $evento[0]);
$campos[1] = constroe_campo_formulario(2, $idioma_sistema[66], null, null, null, $evento[1]);

// numero de mensagens
$numero_mensagens = retorne_numero_mensagens(1, null);

// pagina inicial
$pagina_inicial = PAGINA_INICIAL;

// valida numero de mensagens
if($numero_mensagens > 1){
	
	// numero de mensagens
	$numero_mensagens = retorne_tamanho_resultado($numero_mensagens);
	
	// texto
	$texto[0] = $numero_mensagens.$idioma_sistema[225];
	
}else{
	// texto
	$texto[0] = $numero_mensagens.$idioma_sistema[224];

};

// links
$link[0] = "<a href='$pagina_inicial?$variavel_campo[2]=42' title='$texto[0]'>$texto[0]</a>";

// campo numero de mensagens
$campo_numero_mensagens = "
<div class='classe_campo_pesquisa_mensagem_numero'>

<div class='classe_campo_pesquisa_mensagem_numero_separa'>
$link[0]
</div>

</div>
";

// html
$html = "
<div class='classe_campo_pesquisa_mensagem'>
<div class='classe_campo_pesquisa_mensagem_campos'>
<div class='classe_campo_pesquisa_mensagem_entrada'>$campos[0]</div>
<div class='classe_campo_pesquisa_mensagem_botao'>$campos[1]</div>
</div>
$campo_numero_mensagens
<div class='classe_campo_pesquisa_mensagem_resultados classe_cor_10' id='$idcampo[1]'></div>
</div>
";

// retorno
return $html;

};

?>