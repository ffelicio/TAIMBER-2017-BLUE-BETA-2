<?php

// constroe o campo de gerenciar imagem
function constroe_campo_gerenciar_imagem($dados, $identificador){

// globals
global $tabela_banco;
global $idioma_sistema;

// separando dados
$id = $dados["id"];
$idusuario = $dados[UID];

// usuario dono do perfil
$usuario_dono = retorne_usuario_dono_perfil($idusuario);

// valida id de imagem
if($id == null or $usuario_dono == false){

    // retorno nulo
    return null;
	
};

// usa os dados compilados de sessao
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// separa os dados do perfil
$dados_perfil[0] = $dados_compilados_usuario[$tabela_banco[2]];
$dados_perfil[1] = $dados_compilados_usuario[$tabela_banco[1]];

// nome do usuario
$nome_usuario = $dados_perfil[1][NOME];

// valida usuario dono do perfil
if($usuario_dono == true){

    // id de dialogo para excluir imagem de album
    $id_dialogo_excluir_imagem = retorne_idcampo_md5();
	
    // dialogo excluir imagem de album
	$dialogo_excluir_imagem = "
	
	<div class='classe_texto_caixa_dialogo'>
	$nome_usuario$idioma_sistema[31]
	</div>
	
	<div class='classe_botao_caixa_dialogo'>
	<input type='button' value='$idioma_sistema[32]' onclick='excluir_imagem_album(\"$identificador[2]\", \"$id\", \"$identificador[0]\");'>
	</div>
	
	";
	
	// adiciona dialogo em excluir imagem
	$dialogo_excluir_imagem = constroe_dialogo($idioma_sistema[33], $dialogo_excluir_imagem, $id_dialogo_excluir_imagem);

	// campos
	$campo[0] = "
	<div class='classe_div_opcao_menu_suspense' onclick='exibe_dialogo(\"$id_dialogo_excluir_imagem\");'>
	<span class='span_link'>$idioma_sistema[481]</span>
	</div>
	";
	
	// campo excluir imagem
	$campo_excluir_imagem = constroe_menu_suspense(false, null, false, null, null, $campo[0]);
	
	// campo excluir imagem
	$campo_excluir_imagem = "
	
	<div class='classe_div_campo_gerenciar_imagem_album_div'>
    $campo_excluir_imagem
    </div>
	
	";
	
};

// html
$html = "
<div class='classe_div_campo_gerenciar_imagem_album'>
$campo_excluir_imagem
</div>

$dialogo_excluir_imagem

";

// retorno
return $html;

};

?>