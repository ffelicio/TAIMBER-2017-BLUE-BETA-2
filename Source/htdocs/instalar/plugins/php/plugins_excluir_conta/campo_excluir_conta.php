<?php

// plugins excluir conta
function campo_excluir_conta(){

// globals
global $idioma_sistema;
global $tabela_banco;

// dados compilados do usuario
$dados_compilados_usuario_logado = atualiza_retorna_dados_usuario_logado_sessao();

// dados do perfil logado
$dados_perfil_logado = $dados_compilados_usuario_logado[$tabela_banco[1]];

// nome do usuario
$nome_usuario = retorne_nome_usuario_logado();

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(13, null, false);

// valida o sexo do usuario
if(retorne_sexo_usuario($dados_perfil_logado) == true){

    // mensagem a ser exibida
    $mensagem_exibir = mensagem_erro($imagem_sistema[0]." ".$nome_usuario.$idioma_sistema[155]);

}else{

    // mensagem a ser exibida
    $mensagem_exibir = mensagem_erro($imagem_sistema[0]." ".$nome_usuario.$idioma_sistema[156]);	
	
};

// id de campos
$idcampo[0] = codifica_md5("id_campo_senha_excluir_conta");
$idcampo[1] = codifica_md5("id_campo_mensagem_excluir_conta");
$idcampo[2] = retorne_idcampo_md5();

// eventos
$eventos[0] = "onclick='excluir_conta_usuario(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\");'";

// html
$html = "
<div class='classe_campo_excluir_conta' id='$idcampo[2]'>

<div class='classe_campo_excluir_conta_titulo classe_cor_3'>$idioma_sistema[154]</div>

<div class='classe_campo_excluir_conta_mensagem'>
$mensagem_exibir
</div>

<div class='classe_campo_excluir_conta_mensagem' id='$idcampo[1]'></div>

<div class='classe_campo_excluir_conta_campo_login'>
<input type='password' placeholder='$idioma_sistema[136]' id='$idcampo[0]'>
</div>

<div class='classe_campo_excluir_conta_campo_acao'>
<input type='button' value='$idioma_sistema[153]' $eventos[0]>
</div>

</div>
";

// retorno
return $html;

};

?>