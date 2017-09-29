<?php

// inicia o timer do sistema
function plugin_timer_sistema($modo, $funcoes_inicializar){

// tempo de timer de sistema
switch($modo){
    
	case 1:
	// timer de conexao
	$tempo_timer_sistema = TEMPO_TIMER_CONEXAO;
	break;
	
	case 2:
	// timer de atualizacoes gerais
	$tempo_timer_sistema = TEMPO_TIMER_ATUALIZACOES_GERAIS;
	break;
	
	case 3:
	// timer de atualizacoes de chat
	$tempo_timer_sistema = TEMPO_TIMER_ATUALIZACOES_CHAT;
	break;
	
	case 4:
	// timer de atualizacoes gerais
	$tempo_timer_sistema = TEMPO_TIMER_ATUALIZACOES_GERAIS;
	break;	
	
	case 5:
	// timer de atualizacao de campo info link
	$tempo_timer_sistema = TEMPO_TIMER_INFO_LINK;
	break;
	
	case 6:
	// timer atualizador de resolucao
	$tempo_timer_sistema = TIMER_ATUALIZADOR_RESOLUCAO;
	break;
	
	case 7:
	// timer comum
	$tempo_timer_sistema = TEMPO_TIMER_COMUM;
	break;
	
	case 8:
	// timer atualiza noticia
	$tempo_timer_sistema = TIMER_ATUALIZADOR_NOTICIA;
	break;
	
	case 9:
	// timer atualiza amigos online de mensageiro
	$tempo_timer_sistema = TIMER_ATUALIZADOR_ONLINE_MENSAGEIRO;
	break;
	
};

// contador de iteracao para um novo nome em cada funcao
$contador_iteracao = retorne_contador_iteracao();

// nomes de funcoes e variaveis
$nome_variavel = "variavel_timer".codifica_md5($modo."variavel_timer".$contador_iteracao);
$nome_funcao = "funcao_timer_".codifica_md5("funcao_timer_".$modo.$contador_iteracao);
$nome_timer_carregar_funcoes = "funcoes_carregar_timer_".codifica_md5("funcoes_carregar_timer_".$contador_iteracao.$modo);

// inicia o timer
$html = "
\n
var $nome_variavel = setInterval(function(){ $nome_funcao() }, $tempo_timer_sistema);
\n
function $nome_funcao() {
\n
$nome_timer_carregar_funcoes();
\n
};
\n
";

// funcoes do timer
$html .= "
function $nome_timer_carregar_funcoes(){

// funcoes a serem inicializadas
$funcoes_inicializar

};

";

// adiciona tag de javascript
$html = "
<script language='javascript'>$html</script>
";

// retorno
return $html;

};

?>