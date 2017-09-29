<?php

// limpa os dados de um usuario ao se desinscrever da pagina
function limpar_dados_usuario_desinscrever_pagina($pagina, $uid){

// globals
global $tabela_banco;

// valida usuario dono da pagina
if(retorne_usuario_dono_pagina($uid, $pagina) == true){
	
	// retorno nulo
	return null;
	
};

// tabela de publicacoes
$tabela[0] = $tabela_banco[5];

// query
$query[0] = "select *from $tabela[0] where pagina='$pagina';";

// dados de query
$dados_query = plugin_executa_query($query[0]);

// contador
$contador = 0;

// selecionando publicacoes da pagina
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];

	// valida id de post
    if($id != null){
		
        // exclui os comentarios
        excluir_todos_comentarios_pagina($id, $tabela_banco[5]);

        // exclui as curtidas de publicacao, imagens etc
        exclui_curtidas_publicacao_pagina($id, $tabela_banco[5]);
		
		// limpa o sub dados do usuario ao se desinscrever da pagina
	    limpar_sub_dados_usuario_desinscrever_pagina($dados[CHAVE]);

		// erradica os feeds da pagina
		erradicar_feeds_pagina_usuario(false, $id, $uid, $pagina);

	};

};

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

};

?>