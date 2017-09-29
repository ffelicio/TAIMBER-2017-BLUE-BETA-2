<?php

// exclui os dados de amizade
function excluir_dados_amizade($uidamigo, $modo){

// modo true apaga as mensagens
// modo false nao apaga as mensagens

// globals
global $tabela_banco;

// id de usuario
$idusuario = retorne_idusuario_logado();

// listando as tabelas
foreach($tabela_banco as $tabela){

    // valida tabela
    switch($tabela){
		
		case $tabela_banco[0]: // cadastro
		$tabela = null;
		break;
		
		case $tabela_banco[1]: // perfil
		$tabela = null;
		break;
		
		case $tabela_banco[2]: // imagem perfil
		$tabela = null;
		break;
		
		case $tabela_banco[3]: // capa perfil
		$tabela = null;
		break;
		
		case $tabela_banco[4]: // imagem de album
		$tabela = null;
		break;
		
		case $tabela_banco[5]: // publicacoes
		$tabela = null;
		break;
		
		case $tabela_banco[10]: // tabela de bloqueio
		$tabela = null;
		break;
		
		case $tabela_banco[11]: // tabela de visitas
		$tabela = null;
		break;
		
		case $tabela_banco[12]: // tabela de privacidade
		$tabela = null;
		break;
		
		case $tabela_banco[15]: // tabela de mensagens
		// valida o modo apagar mensagens
		if($modo == false){
			$tabela = null;
		};
		break;
		
		case $tabela_banco[16]: // tabela de emoticons
		$tabela = null;
		break;
		
		case $tabela_banco[17]: // tabela de conexao
		$tabela = null;
		break;
		
		case $tabela_banco[18]: // tabela de paginas
		$tabela = null;
		break;
		
		case $tabela_banco[19]: // tabela de perfil de pagina
		$tabela = null;
		break;
		
		case $tabela_banco[20]: // imagem do perfil da pagina
		$tabela = null;
		break;

		case $tabela_banco[21]: // imagem da capa da pagina
		$tabela = null;
		break;

	};
   
    // valida tabela
    if($tabela != null){
    
	    // querys
	    $query[0] = "delete from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";
        $query[1] = "delete from $tabela where uid='$uidamigo' and uidamigo='$idusuario';";
		
		// excluindo registros de amizade
		plugin_executa_query($query[0]);
		plugin_executa_query($query[1]);

	};

};

// limpa a sessao de usuarios abertos de chat
limpa_sessao_usuarios_abertos_chat($uidamigo);

};

?>