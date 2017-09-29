<?php

// exclui imagens por chave
function exclui_imagens_chave($chave){

// globals
global $tabela_banco;

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorno nulo
    return null;
	
};

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query[0] = "select *from $tabela_banco[4] where uid='$idusuario' and chave='$chave';";
$query[1] = "delete from $tabela_banco[4] where uid='$idusuario' and chave='$chave';";

// dados de imagem
$dados_imagem = plugin_executa_query($query[0]);

// contador
$contador = 0;

// excluindo as imagens
for($contador == $contador; $contador <= $dados_imagem["linhas"]; $contador++){
	
	// exclui os comentarios
    excluir_todos_comentarios($dados_imagem["dados"][$contador]["id"], $tabela_banco[4]);

	// exclui as curtidas de publicacao, imagens etc
    exclui_curtidas_publicacao($dados_imagem["dados"][$contador]["id"], $tabela_banco[4]);

	// remove a notificacao
	remove_notifica(null, $dados_imagem["dados"][$contador]["id"], $tabela_banco[4], true);

    // exclui imagem do servidor
    exclui_arquivo_unico($dados_imagem["dados"][$contador][URL_ROOT_GRANDE]);
    exclui_arquivo_unico($dados_imagem["dados"][$contador][URL_ROOT_MINIATURA]);
	exclui_arquivo_unico($dados_imagem["dados"][$contador][URL_ROOT_THUMBNAIL]);

};

// executa query
plugin_executa_query($query[1]);

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

};

?>