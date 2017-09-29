<?php

// limpa o sub dados do usuario ao se desinscrever da pagina
function limpar_sub_dados_usuario_desinscrever_pagina($chave){

// globals
global $tabela_banco;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query = "select *from $tabela_banco[4] where chave='$chave';";

// dados de imagem
$dados_imagem = plugin_executa_query($query);

// contador
$contador = 0;

// excluindo as imagens
for($contador == $contador; $contador <= $dados_imagem["linhas"]; $contador++){
	
	// exclui os comentarios
    excluir_todos_comentarios_pagina($dados_imagem["dados"][$contador]["id"], $tabela_banco[4]);

	// exclui as curtidas de publicacao, imagens etc
    exclui_curtidas_publicacao_pagina($dados_imagem["dados"][$contador]["id"], $tabela_banco[4]);

};

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

};

?>