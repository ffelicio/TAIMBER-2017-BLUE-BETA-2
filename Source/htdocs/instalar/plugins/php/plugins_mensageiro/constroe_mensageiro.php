<?php

// constroe o mensageiro
function constroe_mensageiro(){

// globals
global $idioma_sistema;

// valida chave nula
if(retorna_chave_request() != null or retorne_usuario_logado() == false){
	
	// retorno
	return null;
	
};

// modo mobile
$modo_mobile = retorne_modo_mobile();

// id de amigo aberto
$uidamigo = $_SESSION[SESSAO_UIDAMIGO_TEMP_MENSAGEIRO];

// id de campos
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_geral_troca_mensagens_mensageiro();
$idcampo[2] = retorne_idcampo_md5();

// constroe os amigos de mensageiro
$campo[0] = constroe_amigos_mensageiro($idcampo);

// funcoes
$funcao[0] = "carregar_amigos_mensageiro(\"$idcampo[0]\", \"$idcampo[2]\");";

// eventos
$eventos[0] = "onkeyup='$funcao[0]'";

// campo atualizador de chat
$campo_atualizador[0] = "
\n
atualizador_chat_usuario();
\n
";

// adiciona o timer
$campo_atualizador[0] = plugin_timer_sistema(3, $campo_atualizador[0]);

// valida usuario amigo
if($uidamigo != null and retorne_usuario_amigo($uidamigo) == true){
	
	// funcoes
	$funcao[0] = "constroe_campos_troca_mensagens_mensageiro(\"$uidamigo\", \"$idcampo[1]\");";

	// scripts
	$script[0] = "
	<script>
	$funcao[0]
	</script>
	";

};

// campos
$campo[1] = "
<div class='classe_div_mensageiro_mensagens cor_borda_div' id='$idcampo[1]'>

<div class='classe_div_mensageiro_mensagens_temporario classe_cor_7'>
$idioma_sistema[529]
</div>

</div>
";

// valida modo mobile
if($modo_mobile == false){
	
	// campos
	$campo[0] = "
	<div class='classe_div_mensageiro_amigos cor_borda_div'>
	$campo[0]
	</div>
	";

}else{
	
	// campos
	$campo[0] = "
	<div class='classe_div_mensageiro_amigos cor_borda_div' id='$idcampo[1]'>
	$campo[0]
	</div>
	";
	
	// limpa campos
	$campo[1] = null;
	
};

// html
$html = "
<div class='classe_div_mensageiro cor_borda_div'>

$campo[0]
$campo[1]

</div>


$campo_atualizador[0]
$script[0]
";

// retorno
return $html;

};

?>