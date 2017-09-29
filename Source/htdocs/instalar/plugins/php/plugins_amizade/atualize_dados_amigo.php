<?php

// atualiza os dados do amigo
function atualize_dados_amigo($uid, $uidamigo, $modo){

// modo true atualiza quando se adiciona uma amizade, aceita etc.
// modo false atualiza quando o usuário atualiza as informações do seu perfil.

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[6];

// valida o modo atualizar
if($modo == true){
	
	// query
	$query = "select *from $tabela where uid='$uid' and uidamigo='$uidamigo';";

	// valida o numero de linhas
	if(retorne_numero_linhas_query($query) == 0){
		
		// retorno nulo
		return null;
		
	};

	// limpando querys
	$query = null;

	// dados do perfil
	$dados_perfil[0] = retorne_dados_perfil_usuario($uidamigo);
	$dados_perfil[1] = retorne_dados_perfil_usuario($uid);

	// separando os dados
	$nome[0] = $dados_perfil[0][NOME];
	$sobrenome[0] = $dados_perfil[0][SOBRENOME];
	$sexo[0] = $dados_perfil[0][SEXO];
	$cidade[0] = $dados_perfil[0][CIDADE];
	$estado[0] = $dados_perfil[0][ESTADO];
	$estuda[0] = $dados_perfil[0][ESTUDA];
	$trabalha[0] = $dados_perfil[0][TRABALHA];

	// separando os dados
	$nome[1] = $dados_perfil[1][NOME];
	$sobrenome[1] = $dados_perfil[1][SOBRENOME];
	$sexo[1] = $dados_perfil[1][SEXO];
	$cidade[1] = $dados_perfil[1][CIDADE];
	$estado[1] = $dados_perfil[1][ESTADO];
	$estuda[1] = $dados_perfil[1][ESTUDA];
	$trabalha[1] = $dados_perfil[1][TRABALHA];

	// querys
	$query[] = "update $tabela set nome='$nome[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set sobrenome='$sobrenome[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set sexo='$sexo[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set cidade='$cidade[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set estado='$estado[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set estuda='$estuda[0]' where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "update $tabela set trabalha='$trabalha[0]' where uid='$uid' and uidamigo='$uidamigo';";

	// querys
	$query[] = "update $tabela set nome='$nome[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set sobrenome='$sobrenome[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set sexo='$sexo[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set cidade='$cidade[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set estado='$estado[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set estuda='$estuda[1]' where uid='$uid' and uid='$uidamigo';";
	$query[] = "update $tabela set trabalha='$trabalha[1]' where uid='$uid' and uid='$uidamigo';";

}else{
	
	// id de usuario logado
	$uid = retorne_idusuario_logado();
	
	// dados do perfil
	$dados_perfil = retorne_dados_perfil_usuario($uid);
	
	// separando os dados
	$nome = $dados_perfil[NOME];
	$sobrenome = $dados_perfil[SOBRENOME];
	$sexo = $dados_perfil[SEXO];
	$cidade = $dados_perfil[CIDADE];
	$estado = $dados_perfil[ESTADO];
	$estuda = $dados_perfil[ESTUDA];
	$trabalha = $dados_perfil[TRABALHA];
	
	// querys
	$query[] = "update $tabela set nome='$nome' where uidamigo='$uid';";
	$query[] = "update $tabela set sobrenome='$sobrenome' where uidamigo='$uid';";
	$query[] = "update $tabela set sexo='$sexo' where uidamigo='$uid';";
	$query[] = "update $tabela set cidade='$cidade' where uidamigo='$uid';";
	$query[] = "update $tabela set estado='$estado' where uidamigo='$uid';";
	$query[] = "update $tabela set estuda='$estuda' where uidamigo='$uid';";
	$query[] = "update $tabela set trabalha='$trabalha' where uidamigo='$uid';";

};

// plugin executa varias query
plugin_executa_varias_query($query);

};

?>