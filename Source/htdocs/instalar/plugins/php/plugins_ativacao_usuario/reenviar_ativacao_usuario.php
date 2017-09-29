<?php

// reenvia a ativacao do usuario
function reenviar_ativacao_usuario(){

// globals
global $tabela_banco;
global $idioma_sistema;
global $variavel_campo;

// url de inicio
$url_inicio = PAGINA_INDEX_INICIO;

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// valida usuario logado ja ativou a conta
if(retorne_usuario_logado_ativou_conta() == true){
	
	// mensagem
	$mensagem[0] = mensagem_sucesso($nome_usuario.$idioma_sistema[429]);
	
	$html = "
	<div class='classe_campo_reenviar_ativador_usuario'>
	$mensagem[0]
	</div>	
	";

	// retorna a mensagem
	return $html;
	
};

// uid
$uid = retorne_idusuario_logado();

// data de hoje
$data_hoje = retorne_data_dia_mes_ano();

// tabela
$tabela = $tabela_banco[30];

// query
$query = "select *from $tabela where uid='$uid';";

// dados de query
$dados_query = plugin_roda_query($query);

// separa os dados
$dados = $dados_query["dados"][0];

// separando os dados
$id = $dados["id"];
$uid = $dados[UID];
$chave = $dados[CHAVE];
$tentativas = $dados[TENTATIVAS];
$data = $dados[DATA];

// valida chave
if($chave == retorna_chave_request()){
	
	// dados compilados de usuario
	$dados_compilados_usuario_logado = atualiza_retorna_dados_usuario_logado_sessao();
	
	// dados do perfil de usuario logado
	$dados_perfil_logado = $dados_compilados_usuario_logado[$tabela_banco[1]];

	// query
	$query = "delete from $tabela where uid='$uid' and chave='$chave';";
	
	// removendo chave
	plugin_roda_query($query);
	
	// valida sexo de usuario
	if(retorne_sexo_usuario($dados_perfil_logado) == true){
        
		// mensagem
		$mensagem[0] = mensagem_sucesso($nome_usuario.$idioma_sistema[434]);
	
	}else{
		
        // mensagem
		$mensagem[0] = mensagem_sucesso($nome_usuario.$idioma_sistema[435]);	
	
	};

	// html
	$html = "
	<div class='classe_campo_reenviar_ativador_usuario'>
	$mensagem[0]
	</div>	
	";

	// retorna a mensagem
	return $html;	

};

// valida numero de tentativas
if($tentativas > NUMERO_REENVIAR_ATIVACAO_DIA and $data == $data_hoje){
	
	// mensagem
	$mensagem[0] = mensagem_erro($nome_usuario.$idioma_sistema[428]);
	
	$html = "
	<div class='classe_campo_reenviar_ativador_usuario'>
	$mensagem[0]
	</div>	
	";

	// retorna a mensagem
	return $html;

};

// valida as datas
if($data == $data_hoje){
	
	// atualiza o numero de tentativas
	$tentativas++;
	
}else{
	
	// zera o numero de tentativas
	$tentativas = 0;
	
};

// query
$query = "update $tabela set tentativas='$tentativas', data='$data_hoje' where uid='$uid';";

// atualizando
plugin_roda_query($query);

// links
$url[0] = "<a href='$url_inicio?$variavel_campo[2]=100&$variavel_campo[3]=$chave' title='$idioma_sistema[426]'>$idioma_sistema[431]</a>";

// mensagem
$mensagem[0] = "
$nome_usuario$idioma_sistema[432]
<br>
<br>
$url[0]
";

// assunto da mensagem
$assunto_mensagem = $idioma_sistema[433].NOME_SISTEMA;

// envia o link para o email com o codigo
enviar_email(retorna_email_usuario_logado(), $assunto_mensagem, $mensagem[0]);

// mensagem
$mensagem[1] = mensagem_sucesso($nome_usuario.$idioma_sistema[430]);
	
$html = "
<div class='classe_campo_reenviar_ativador_usuario'>
$mensagem[1]
</div>	
";

// retorna a mensagem
return $html;

};

?>