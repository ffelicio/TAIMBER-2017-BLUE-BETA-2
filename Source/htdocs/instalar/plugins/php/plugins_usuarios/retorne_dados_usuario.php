<?php

// retorna os dados do usuario
function retorne_dados_usuario($idusuario){

// globals
global $tabela_banco;

// valida pode retornar os dados do usuario por nova consulta no banco de dados
if(retorne_pode_retornar_dados_usuario_nova_consulta(2, $idusuario, null) == false){
	
	// retorna os dados da sessao
	return retorne_pode_retornar_dados_usuario_nova_consulta(3, $idusuario, null);
	
};

// array de retorno
$array_retorno = array();

// id de pagina
$pagina = retorne_idpagina_request();

// pegando todos os dados do usuario
foreach($tabela_banco as $tabela){
    
	// valida tabela
	if($tabela != null){
	    
        // valida algumas tabelas
		switch($tabela){
		    
			case $tabela_banco[4]: // tabela de imagens de album
			// valida pagina
		    if($pagina == null){
				
				// query
				$query = "select *from $tabela where uid='$idusuario' and modo_chat='0' and pagina='';";
			
			}else{
				
				// query
				$query = "select *from $tabela where modo_chat='0' and pagina='$pagina';";
			
			};			
			break;

			case $tabela_banco[5]: // tabela de publicacoes
			$query = null;
			break;
			
		    case $tabela_banco[6]: // tabela de amizade
			$query = "select *from $tabela where uid='$idusuario' order by id asc;";
			break;
			
			case $tabela_banco[7]: // tabela de comentarios
			$query = null;
			break;
			
			case $tabela_banco[8]: // tabela de feeds de usuarios
			$query = null;
			break;
		
			case $tabela_banco[10]: // tabela de bloqueios
			$query = "select *from $tabela where uid='$idusuario' and uidbloqueou='$idusuario';";
			break;

			case $tabela_banco[15]: // tabela de mensagens
			$query = null;
			break;
			
			case $tabela_banco[16]: // tabela de emoticons
			$query = "select *from $tabela order by id asc;";
			break;
			
			case $tabela_banco[20]: // tabela de imagem de perfil de pagina
			$query = "select *from $tabela where id='$pagina';";
			break;	
			
			case $tabela_banco[21]: // tabela de capa de pagina
			$query = "select *from $tabela where id='$pagina';";
			break;		

			case $tabela_banco[22]: // tabela de inscritos de pagina
			$query = "select *from $tabela where uidamigo='$idusuario';";
			break;
			
			case $tabela_banco[23]: // tabela de configuracoes da pagina
			$query = null;
			break;
			
			case $tabela_banco[24]: // tabela de notificacoes
			$query = null;
			break;
			
			case $tabela_banco[25]: // tabela de aniversarios de amigos
			$query = null;
			break;
			
			case $tabela_banco[26]: // tabela de musicas
			$query = null;
			break;
			
			case $tabela_banco[27]: // tabela de videos
			$query = null;
			break;			
			
			case $tabela_banco[28]: // tabela de url amigaveis
			$query = null;
			break;	
			
			case $tabela_banco[29]: // tabela de conteudo de url
			$query = null;
			break;
			
			case $tabela_banco[30]: // tabela de ativacao de usuario
			$query = null;
			break;
			
			case $tabela_banco[35]: // tabela de noticias
			$query = null;
			break;

			case $tabela_banco[37]: // tabela de recomendar amigos
			$query = null;
			break;
			
			case $tabela_banco[38]: // tabela de plano de fundo
			$query = null;
			break;
			
			case $tabela_banco[39]: // tabela de relacionamentos
			$query = null;
			break;
			
			default:
            $query = "select *from $tabela where uid='$idusuario';";
			break;
			
		};

		// array de dados
        $array_dados = plugin_executa_query($query);
	    
		// atualiza o array de retorno
		$array_retorno[] = $array_dados["dados"];
		
	};
	
};

// atualiza os dados de usuario para nao precisar consultar novamente!
// isto reduz o numero de consultas no banco de dados
retorne_pode_retornar_dados_usuario_nova_consulta(0, $idusuario, $array_retorno);

// retorno
return $array_retorno;

};

?>