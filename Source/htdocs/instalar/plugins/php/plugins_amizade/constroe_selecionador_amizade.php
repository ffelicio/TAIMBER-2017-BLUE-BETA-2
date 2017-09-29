<?php

// constroe o selecionador de amizade
function constroe_selecionador_amizade($evento_campo, $valor_atual, $titulo_campo, $idcampo_1, $idcampo_2, $relacao){

// globals
global $tabela_banco;
global $idioma_sistema;

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_logado_sessao();

// array com dados de amigos
$array_amizade = $dados_compilados_usuario[$tabela_banco[6]];

// numero de amigos
$numero_amigos = retorne_numero_amigos($array_amizade);

// contador
$contador = 0;

// id de usuario logado
$uid = retorne_idusuario_logado();

// informa se esta em um relacionamento serio
$relacionamento_serio = retorne_usuario_relacionamento_serio(null, $relacao);

// extraindo amigos de usuario
for($contador == $contador; $contador <= $numero_amigos; $contador++){
	
	// dados de array de amigos
	$dados = $array_amizade[$contador];
	
	// id de usuario amigo
	$idusuario = retorne_idamigo_dados_amigo(true, $dados, $uid);
	
	// valida id de usuario
	if($idusuario != null){

		// nome do usuario
		$nome_usuario = converte_minusculo(retorne_nome_usuario(true, $idusuario));

		// atualizando array de opcoes
		$array_options .= $nome_usuario.",";
		
		// atualizando array de valores
		$array_valores .= $idusuario.",";

	};

};

// valida relacao
if($relacao == NUMERO_RELACIONAMENTO_FILHOS){
	
	// limpa o valor atual
	$valor_atual = null;
	
};

// eventos
$evento[0] = "onclick='$evento_campo'";

// campos
$campo[0] .= carregar_relacionamento($relacao, 1);	
$campo[0] .= carregar_relacionamento($relacao, 0);

// valida relacionamento serio
if($relacionamento_serio == false){
	
	// campos
	$campo[1] = "
	<div class='classe_campo_selecionador_amizade_conteudo_separa_3'>
	<input type='button' value='$idioma_sistema[561]' $evento[0]>
	</div>
	";

};

// html
$html = gerador_select_option_especial($array_options, $array_valores, $valor_atual, null, $idcampo_1, null);

// html
$html = "
<div class='classe_campo_selecionador_amizade classe_cor_2'>
<div class='classe_campo_selecionador_amizade_titulo'>$titulo_campo</div>

<div class='classe_campo_selecionador_amizade_conteudo'>
<div class='classe_campo_selecionador_amizade_conteudo_separa_1'>$html</div>

$campo[1]

<div class='classe_campo_selecionador_amizade_conteudo_separa_2' id='$idcampo_2'>
$campo[0]
</div>

</div>

</div>
";

// retorno
return $html;

};

?>