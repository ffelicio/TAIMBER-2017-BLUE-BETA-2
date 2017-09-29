<?php

// constroe o campo frase de efeito
function constroe_campo_frase_efeito(){

// globals
global $idioma_sistema;
global $tabela_banco;

// id de usuario via requeste
$uid = retorne_idusuario_request();

// usuario dono do perfil
$usuario_dono = retorne_usuario_dono_perfil($uid);

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// array de postagens
$array_dados = $dados_compilados_usuario[$tabela_banco[33]];

// conteudo
$conteudo[0] = $array_dados[CONTEUDO];
$conteudo[1] = $array_dados[CONTEUDO];

// valida usuario dono de perfil
if($usuario_dono == true){

	// nome de usuario logado
	$nome = retorne_nome_usuario_logado();
	
	// valida conteudo
	if($conteudo[0] == null){
		
		$conteudo[0] = $nome.$idioma_sistema[469];
		
	};
	
	// id campo
	$idcampo[0] = retorne_idcampo_md5();
	$idcampo[1] = retorne_idcampo_md5();
	$idcampo[2] = retorne_idcampo_md5();
	$idcampo[3] = retorne_idcampo_md5();
	$idcampo[4] = retorne_idcampo_md5();
	
	// barra de progresso gif
	$progresso[0] = campo_progresso_gif($idcampo[3]);
	
	// funcao
	$funcao[0] = "salvar_frase_efeito(\"$idcampo[0]\", \"$idcampo[3]\", \"$idcampo[4]\");";
	$funcao[1] = "exibe_itens_frase_efeito(\"$idcampo[1]\", \"$idcampo[2]\")";
	$funcao[2] = "oculta_itens_frase_efeito(\"$idcampo[1]\", \"$idcampo[2]\")";
	
	// eventos
	$evento[0] = "onclick='$funcao[0]'";
	$evento[1] = "onclick='$funcao[1]'";
	$evento[2] = "onkeydown='if(event.keyCode == 13){$funcao[0]}'";
	$evento[3] = "ondblclick='$funcao[2]'";
	
	// campos
	$campo[0] = "
	<div class='classe_campo_frase_efeito_entrada' id='$idcampo[1]'>
	
	<div class='classe_campo_frase_efeito_entrada_separa_1'>
	<input type='text' placeholder='$nome$idioma_sistema[467]' id='$idcampo[0]' value='$conteudo[1]' $evento[2]>
	</div>
	
	<div class='classe_campo_frase_efeito_entrada_separa_2'>
	
	<div class='classe_campo_frase_efeito_entrada_separa_progresso'>
	$progresso[0]
	</div>
	
	<span class='botao_padrao' $evento[0] id='$idcampo[4]'>
	$idioma_sistema[468]
	</span>
	
	</div>
	
	</div>
	";

	// converte todas as urls, links, videos etc
	$conteudo[0] = converter_urls_basicas($conteudo[0]);
	
	// campos
	$campo[1] = "
	<div class='classe_campo_frase_efeito_frase' id='$idcampo[2]'>
	$conteudo[0]
	</div>
	";
	
	// campos
	$campo[0] = "
	$campo[1]
	$campo[0]
	";
	
}else{
	
	// converte todas as urls, links, videos etc
	$conteudo[0] = converter_urls_basicas($conteudo[0]);
	
	// campos
	$campo[0] = "
	<div class='classe_campo_frase_efeito_frase'>
	$conteudo[0]
	</div>
	";
	
};

// nao permite exibir este campo em caso de não haver conteudo
if($conteudo[0] == null and $usuario_dono == false){
	
	// retorno nulo
	return null;
	
};

// html
$html = "
<div class='classe_campo_frase_efeito' $evento[1] $evento[3]>
$campo[0]
</div>
";

// retorno
return $html;

};

?>