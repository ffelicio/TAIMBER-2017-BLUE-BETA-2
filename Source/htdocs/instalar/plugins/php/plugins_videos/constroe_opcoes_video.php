<?php

// constroe as opcoes de video
function constroe_opcoes_video($dados, $idcampo_1){

// globals
global $idioma_sistema;

// separa os dados
$id = $dados["id"];
$uid = $dados[UID];

// valida usuario dono de video
if($uid != retorne_idusuario_logado()){

	// retorno
	return constroe_link_abrir_media($dados);
	
};

// valida idcampo
if($idcampo_1 == null){
	
	// idcampo
	$idcampo_1 = retorne_idcampo_md5();
	
};

// id de campos
$idcampo[0] = codifica_md5("id_dialogo_excluir_video_usuario_".$uid.$id.retorne_contador_iteracao());

// eventos
$evento[0] = "onclick='exibe_dialogo(\"$idcampo[0]\");'";
$evento[1] = "onclick='excluir_video_usuario(\"$id\", \"$idcampo_1\", \"$idcampo[0]\");'";

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// imagens de sistema
$imagem_sistema[0] = retorne_imagem_sistema(36, null, false);

// campos
$campo[0] = "

<div class='separa_opcao_player_video_pergunta'>
$nome_usuario$idioma_sistema[593]
</div>

<div class='separa_opcao_player_video_resposta'>
<input type='button' value='$idioma_sistema[32]' $evento[1]>
</div>

";

// adiciona dialogo
$campo[0] = constroe_dialogo($idioma_sistema[588], $campo[0], $idcampo[0]);

// campos
$campo[1] = "
<div class='classe_div_opcao_menu_suspense' $evento[0]>

<div class='separa_opcao_player_video'>
$imagem_sistema[0]
</div>

<span class='separa_opcao_player_video_titulo span_link'>
$idioma_sistema[592]
</span>

</div>
";

// campos
$campo[1] = constroe_menu_suspense(false, null, retorne_modo_mobile(), null, null, $campo[1]);

// constroe o link para abrir a media
$campo[2] = constroe_link_abrir_media($dados);

// html
$html = "
$campo[2]

<div class='classe_separa_player_media_opcoes' id='$idcampo_1'>
$campo[1]
</div>

$campo[0]
";

// retorno
return $html;

};

?>