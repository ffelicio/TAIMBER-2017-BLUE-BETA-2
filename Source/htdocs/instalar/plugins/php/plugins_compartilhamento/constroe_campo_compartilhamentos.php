<?php

// constroe o campo de compartilhamento
function constroe_campo_compartilhamentos($id, $tipo_campo, $uid){

// globals
global $idioma_sistema;

// valida modo pode interagir social
if(retorne_pode_interagir_social($id, true) == false){
	
	// retorno nulo
	return null;
	
};

// valida configuracao
if(retorna_configuracao_privacidade(10, $uid) == true){
	
	// retorno nulo
	return null;

};

// nao permite compartilhar propria publicacao
if(retorna_usuario_logado_dono_publicacao($id) == true){
	
	// retorno nulo
	return null;
	
};

// id de post
$id_post = retorne_idcompartilhamento_id_post($id);

// valida se esta trabalhando com compartilhamento de compartilhamento
if(retorne_idcompartilhamento_id_post($id) == null){
	
	// numero de compartilhamentos
	$numero_compartilhamentos = retorne_numero_compartilhamentos($id);

}else{
	
	// numero de compartilhamentos
	$numero_compartilhamentos = retorne_numero_compartilhamentos($id_post);

};

// valida usuario dono da publicacao
if(retorne_usuario_logado_dono_compartilhamento($id_post) == true and $numero_compartilhamentos > 0){

	// html
	$html = "
	<span class='classe_mensagem_usuario_dono_compartilhamento_span'>
	$idioma_sistema[342]
	</span>
	";
	
	// html
	$html = retorne_nome_link_usuario(true, retorne_idusuario_logado()).$html;
	
	// html
	$html = "
	<div class='classe_mensagem_usuario_dono_compartilhamento'>$html</div>
	";
	
	// retorno
	return $html;
	
};

// retorna tamanho
$numero_compartilhamentos = retorne_tamanho_resultado($numero_compartilhamentos);

// valida usuario compartilhou
if(retorne_usuario_logado_compartilhou($id) == true or retorne_usuario_logado_compartilhou($id_post) == true){
	
	// sim
	$compartilhou = true;
	
}else{
	
	// nao
	$compartilhou = false;	
	
};

// valida usuario logado compartilhou
if($compartilhou == true){
	
	// texto
	$texto[0] = retorne_imagem_sistema(33, null, false);

}else{

	// texto
	$texto[0] = retorne_imagem_sistema(89, null, false);

	// id de campos
	$idcampo[0] = retorne_idcampo_md5();
	$idcampo[1] = retorne_idcampo_md5();
	$idcampo[2] = retorne_idcampo_md5();
	$idcampo[3] = retorne_idcampo_md5();
	
	// funcoes
	$funcao[0] = "compartilhar(\"$idcampo[0]\", \"$id_post\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[3]\")";
	
	// eventos
	$evento[0] = "onclick='$funcao[0];'";

	// dialogo
	$dialogo[0] = constroe_dialogo($idioma_sistema[401], $idioma_sistema[402], $idcampo[1]);
	
};

// campos
$campo[0] = "
<div class='campo_compartilhamento_compartilhar classe_cor_4' id='$idcampo[3]'>

<span class='campo_compartilhamento_compartilhar_span_1' id='$idcampo[2]'>
$texto[0]
</span>

<span class='campo_compartilhamento_compartilhar_span_2 span_link' id='$idcampo[0]'>
$numero_compartilhamentos
</span>

</div>
";

// html
$html = "
<div class='campo_compartilhamento' $evento[0]>
$campo[0]
</div>

$dialogo[0]
";

// retorno
return $html;

};

?>