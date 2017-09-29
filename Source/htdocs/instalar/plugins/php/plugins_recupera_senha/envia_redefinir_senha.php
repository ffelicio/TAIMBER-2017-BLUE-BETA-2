<?php

// envia o modo de redefinir a senha
function envia_redefinir_senha(){

// globals
global $idioma_sistema;
global $tabela_banco;
global $variavel_campo;

// dados de formulario
$email = retorne_campo_formulario_request(33);

// remove espacos em branco
$email = trim($email);

// valia email
if(verifica_se_email_valido($email) == false){
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[8]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// valida email cadastrado
if(retorne_email_cadastrado($email) == false){
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[447].$email.$idioma_sistema[448]);
	
	// retorno
	return json_encode($array_retorno);	
	
};

// tabela
$tabela = $tabela_banco[31];

// url de inicio
$url_inicio = PAGINA_INDEX_INICIO;

// valida usuario logado
if(retorne_usuario_logado() == true){
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[446]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// data de hoje
$data_hoje = retorne_data_dia_mes_ano();

// query
$query = "select *from $tabela where email='$email';";

// dados de query
$dados_query = plugin_roda_query($query);

// separa os dados
$dados = $dados_query["dados"][0];

// separando os dados
$id = $dados["id"];
$tentativas = $dados[TENTATIVAS];
$data = $dados[DATA];
$chave = $dados[CHAVE];

// valida o numero de tentativas
if($tentativas >= NUMERO_REENVIAR_RECUPERA_SENHA_DIA and $data == $data_hoje){
	
	// array retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[441]);
	
	// retorno
	return json_encode($array_retorno);	
	
};

// chave
$chave = codifica_md5($data.retorne_contador_iteracao());

// valida as datas
if($data == $data_hoje){
	
	// atualiza o numero de tentativas
	$tentativas++;
	
}else{
	
	// zera o numero de tentativas
	$tentativas = 1;
	
};

// valida o numero de linhas
if($dados_query["linhas"] == 0){
	
	// query
	$query = "insert into $tabela values(null, '$email', '$chave', '$tentativas', '$data_hoje');";
	
}else{
	
	// query
	$query = "update $tabela set tentativas='$tentativas', data='$data_hoje' where email='$email';";

};

// atualizando registro
plugin_roda_query($query);

// links
$url[0] = "$url_inicio?$variavel_campo[2]=102&$variavel_campo[3]=$chave";

// mensagem
$mensagem[0] = "
$idioma_sistema[445]
<br>
<br>
$url[0]
";

// assunto da mensagem
$assunto_mensagem = $idioma_sistema[437].NOME_SISTEMA;

// envia o link para o email com o codigo
enviar_email($email, $assunto_mensagem, $mensagem[0]);

// array de retorno
$array_retorno["dados"] = mensagem_sucesso($idioma_sistema[442].$email.$idioma_sistema[443]);

// retorno
return json_encode($array_retorno);

};

?>