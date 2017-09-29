<?php

// funcao para alterar o relacionamento
function alterar_relacionamento(){

// globals
global $idioma_sistema;
global $tabela_banco;

// uidamigo
$uidamigo = retorne_campo_formulario_request(13);

// id de usuario logado
$uid = retorne_idusuario_logado();

// relacao
$relacao = retorne_campo_formulario_request(53);

// nome do usuario
$nome_usuario = retorne_nome_usuario(true, $uidamigo);

// informa se esta em um relacionamento serio
if(retorne_usuario_relacionamento_serio($uidamigo, $relacao) == true){
	
	// valida relacionamento
	if(retorne_relacionamento_usuario($relacao, null) == $uidamigo){
		
		// array de retorno
		$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[556]);
		
	}else{
		
		// array de retorno
		$array_retorno["dados"] = mensagem_erro($nome_usuario.$idioma_sistema[555]);

	};
	
	// retorno
	return json_encode($array_retorno);

};

// tabela
$tabela = $tabela_banco[39];

// data atual
$data = data_atual();

// numero de relacionamento com filhos
$numero_relacionamento_filhos = NUMERO_RELACIONAMENTO_FILHOS;

// numero de relacionamento com netos
$numero_relacionamento_netos = NUMERO_RELACIONAMENTO_NETOS;

// valida se o uidamigo é o mesmo do usuario logado
if($uid == $uidamigo){

	// array de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[549]);

	// retorno
	return json_encode($array_retorno);	
	
};

// valida uidamigo
if($uidamigo != null){
	
	// valida se o usuario é amigo
	if(retorne_usuario_amigo($uidamigo) == false){
		
		// valida sexo de usuário
		if(retorne_sexo_usuario(retorne_dados_perfil_usuario($uidamigo)) == true){
			
			// mensagem
			$mensagem = $nome_usuario.$idioma_sistema[547];
			
		}else{

			// mensagem
			$mensagem = $nome_usuario.$idioma_sistema[548];		
			
		};
		
		// array de retorno
		$array_retorno["dados"] = mensagem_erro($mensagem);

		// retorno
		return json_encode($array_retorno);
		
	};

};

// valida relacao
if(retorne_permite_carregar_multiplos_relacionamentos($relacao) == true){
	
	// querys
	$query[] = "delete from $tabela where uid='$uid' and uidamigo='$uidamigo';";
	$query[] = "delete from $tabela where uid='$uidamigo' and uidamigo='$uid';";	
	
}else{

	// querys
	$query[] = "delete from $tabela where uid='$uid' and uidamigo='$uidamigo' and relacao!=$numero_relacionamento_filhos;";
	$query[] = "delete from $tabela where uid='$uidamigo' and uidamigo='$uid' and relacao!=$numero_relacionamento_filhos;";
	$query[] = "delete from $tabela where uid='$uid' and uidamigo='$uidamigo' and relacao=$numero_relacionamento_netos;";
	$query[] = "delete from $tabela where uid='$uidamigo' and uidamigo='$uid' and relacao=$numero_relacionamento_netos;";

};

// definindo relacaoes possiveis
$relacao_1 = $relacao;
$relacao_2 = retorne_numero_compativel_relacao($relacao);

// valida se o uid e o uidamigo foram repassados
if($uid != null and $uidamigo != null){
	
	// 2° adiciona um novo relacionamento
	$query[] = "insert into $tabela values(null, '$uid', '$uidamigo', '$relacao_1', '0', '1', '$uid', '$data');";
	$query[] = "insert into $tabela values(null, '$uidamigo', '$uid', '$relacao_2', '0', '0', '$uid', '$data');";

};

// listando e executando querys
foreach($query as $query_executar){

	// valida query
	if($query_executar != null){
		
		// salvando relacionamento
		plugin_executa_query($query_executar);

	};

};

// valida se o uid e o uidamigo foram repassados
if($uid != null and $uidamigo != null){

	// nome de usuario
	$nome_usuario = retorne_nome_link_usuario(false, $uidamigo);

	// array de retorno
	$array_retorno["dados"] = mensagem_sucesso($nome_usuario.$idioma_sistema[550]);

}else{
	
	// array de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[551]);

};

// retorno
return json_encode($array_retorno);

};

?>