<?php

// constroe o campo depoimentos de perfil
function constroe_campo_depoimentos_perfil(){

// globals
global $idioma_sistema;

// id de usuario
$idusuario = retorne_idusuario_request();

// nome de usuario
$nome_usuario = retorne_nome_usuario_logado();

// nome de amigo
$nome_amigo = retorne_nome_usuario(true, $idusuario);

// dono de perfil
$dono_perfil = retorne_usuario_dono_perfil($idusuario);

// valida desabilitou depoimentos
if(retorna_configuracao_privacidade(8, $idusuario) == true){
	
    // valida usuario dono do perfil
	if($dono_perfil == true){
		
		// retorno
		return(constroe_caixa(false, $nome_usuario.$idioma_sistema[185]));
		
	}else{
		
		// retorno
		return(constroe_caixa(false, $nome_amigo.$idioma_sistema[186]));
		
	};

};

// campo visualizar
$campo_visualizar = campo_visualizar_depoimentos(true);

// valida usuario dono do perfil, ou se e amigo
if($dono_perfil == true or retorne_usuario_amigo($idusuario) == false){
	
	// retorno
    return $campo_visualizar;
	
};

// placeholders
$placeholder[0] = $nome_usuario.$idioma_sistema[183].$nome_amigo;

// campos com ids
$idcampo[0] = codifica_md5("id_campo_textarea_escreve_depoimento".data_atual());
$idcampo[1] = codifica_md5("id_campo_mensagem_escreve_depoimento".data_atual());

// eventos
$evento[0] = "onclick='escrever_depoimento(\"$idcampo[0]\", \"$idcampo[1]\", \"$idusuario\");'";

// campos
$campo[0] = constroe_visualizador_emoticons(true, false, true, $idcampo[0]);

// adiciona separador de emoticons
$campo[0] = "
<div class='classe_depoimentos_perfil_basico_separador'>
$campo[0]
</div>
";

// campos
$campo[1] = constroe_campo_div_editavel(true, $idcampo[0], null, null, $evento, $placeholder[0]);

// html
$html = "
<div class='classe_depoimentos_perfil_basico'>
$campo_visualizar

<div class='classe_depoimentos_perfil_basico_mensagem' id='$idcampo[1]'></div>

<div class='classe_depoimentos_perfil_basico_escreve'>
$campo[1]
</div>

<div class='classe_depoimentos_perfil_basico_envia'>
$campo[0]
<input type='button' value='$idioma_sistema[184]' $evento[0]>
</div>

</div>
";

// retorno
return $html;

};

?>