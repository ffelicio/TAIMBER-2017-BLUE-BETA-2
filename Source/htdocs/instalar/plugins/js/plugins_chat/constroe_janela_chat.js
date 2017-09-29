
// constroe a janela de chat
function constroe_janela_chat(uid, modo, idcampo_1){

// modo 0 faz verificacao de numero de usuarios abertos
// modo 1 nao faz verificacao de numero de usuarios abertos

// modo mobile
var v_modo_mobile = parseInt(v_variaveis_javascript['modo_mobile']);

// valida modo mobile
if(v_modo_mobile == 1){
	
	// oculta a janela com usuarios do chat
	oculta_exibe_elemento_idcampo(v_variaveis_javascript['id_janela_chat_principal'], null);

	// oculta a janela principal de chat
	oculta_exibe_elemento_idcampo(v_variaveis_javascript['id_janela_principal_chat'], null);
	
};

// aloca e oculta da lista o usuario do chat que foi aberto para uma conversa
if(modo == 1){
	
	// obtendo usuarios ocultos de lista
	for(i = 0; i <= v_array_usuarios_ocultos_chat.length; i++){
		
		// valida elemento de lista
	    if(v_array_usuarios_ocultos_chat[i] != null){
		    
			// impede que uma janela duplicada se abra, se ja tiver sido aberta para conversa
		    if(retorne_elemento_array_existe(v_array_usuarios_abertos_chat, uid) == true){
			
			    // nao pode exibir
			    return null;

		    };

			// exibe usuario de chat que estava oculto
			exibe_elemento_oculto(v_array_usuarios_ocultos_chat[i], 0);

		};
		
	};
	
	// ocultando usuario de chat
	exibe_elemento_oculto(idcampo_1, null);
	
	// atualiza a lista de ocultos
	v_array_usuarios_ocultos_chat[v_variaveis_javascript['contador_lista_janelas_chat_abertos']] = idcampo_1;
	
	// atualiza a lista de uids de usuarios quando abrir uma janela
	v_array_usuarios_abertos_chat[v_variaveis_javascript['contador_lista_janelas_chat_abertos']] = uid;
	
	// atualiza o contador
	v_variaveis_javascript['contador_lista_janelas_chat_abertos']++;
	
	// valida se o contador atingiu o limite
	if(v_variaveis_javascript['contador_lista_janelas_chat_abertos'] >= v_variaveis_javascript['numero_maximo_janelas_chat']){
		
		// zerando o contador...
		v_variaveis_javascript['contador_lista_janelas_chat_abertos'] = 0;
		
	};

};

// retorna se o elemento do array existe
// evita duplicatas de janelas de troca de mensagens do chat
if(retorne_elemento_array_existe(v_usuarios_chat, uid) == false && modo == 0){
	
	// atualiza o array
	v_usuarios_chat[uid] = uid;

}else{

    // valida o modo
    if(modo == 0){
	
        // retorno nulo
        return null;

    };

};

// atualiza variaveis globais
v_variaveis_javascript['uid_usuario_novo_chat'] = uid;

// valida o modo
if(modo == 0){

    // atualiza a janela de usuarios abertos no chat
    executador_acao(null, 49, v_variaveis_javascript['id_janela_usuarios_abertos_chat']);

};

// valida atingiu o numero maximo de janelas de troca de mensagens de chat
if(v_variaveis_javascript['contador_nova_janela_chat'] >= v_variaveis_javascript['numero_maximo_janelas_chat'] && modo == 0){
	
	// retorno nulo
	return null;
	
};

// codigo html de janela de mensagem de chat padrao
var v_html = obtem_valor_campo(v_variaveis_javascript['id_janela_chat_mensagens'], 1);

// atualiza o contador
v_variaveis_javascript['contador_nova_janela_chat']++;

// valida modo mobile
if(v_modo_mobile == 1){
	
	// calcula nova posicao da direita
	v_direita = 0;
	
}else{
	
	// calcula nova posicao da direita
	v_direita = (v_variaveis_javascript['tamanho_nova_janela_chat'] * v_variaveis_javascript['contador_nova_janela_chat']) + v_variaveis_javascript['tamanho_desconto_primeira_janela_chat'];

};

// valida o modo e atualiza variaveis...
if(modo == 0){
	
	// aloca a posicao da janela aberta
	v_janelas_chat_posicoes[v_variaveis_javascript['contador_nova_janela_chat']] = v_direita;
	
	// aloca de quem e o uid da nova janela aberta
	v_janelas_chat_uids[v_variaveis_javascript['contador_nova_janela_chat']] = uid;
	
};

// nova id de janela de chat
var v_nova_id = v_variaveis_javascript['id_nova_janela_chat'] + uid;

// valida o modo
if(modo == 1){
	
	// valida contador de acesso de posicoes de janelas de chat
	if(v_variaveis_javascript['contador_abrir_janela_chat'] > v_variaveis_javascript['numero_maximo_janelas_chat']){
		
		// zera o contador
		v_variaveis_javascript['contador_abrir_janela_chat'] = 1;

	};
	
	// obtendo valores guardados com posicoes e ids de usuarios abertos inicialmente...
	var v_nova_posicao = v_janelas_chat_posicoes[v_variaveis_javascript['contador_abrir_janela_chat']];
	var v_uidamigo = v_janelas_chat_uids[v_variaveis_javascript['contador_abrir_janela_chat']];

	// id de nova janela
	var v_nova_id = v_variaveis_javascript['id_nova_janela_chat'] + v_uidamigo;

	// remove janela antiga com a mesma id
    remove_elemento_id(v_nova_id);	

	// define a nova posicao
	v_direita = v_nova_posicao;

	// atualiza o contador
	v_variaveis_javascript['contador_abrir_janela_chat']++;

};

// adiciona div principal
v_html = "<div class='classe_janela_troca_mensagens classe_chat_cor_1' id='" + v_nova_id + "'>" + v_html + "</div>";

// adiciona div antes da janela de chat principal
$("body").after(v_html);

// agora adiciona nova posicao
$("#" + v_nova_id).css({right: v_direita, display: 'table'});

// atualiza nova uid de nova janela de chat
v_janelas_chat_id[uid] = v_nova_id;

// valida se janela de troca de mensagens foi criada
if(retorna_elemento_id_existe(v_nova_id) == false){

	// atualiza a pagina
	location.reload();

	// retorno nulo
	return null;
	
};

// agora constroe o conteudo...
executador_acao(null, 46, v_nova_id);

};
