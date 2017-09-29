
<?php
function adiciona_inscrito_pagina(){
global $tabela_banco;
global $idioma_sistema;
$tabela = $tabela_banco[22];
$uid = retorne_idusuario_logado();
$pagina = retorne_idpagina_request();
$titulo_pagina = retorne_titulo_pagina_id($pagina);
if(retorne_usuario_logado() == false){
		return null;
};
if(retorne_id_existe($pagina, $tabela_banco[18]) == false){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[316]);
		return json_encode($array_retorno);
};
$usuario_inscrito = retorne_usuario_inscrito_pagina($uid, $pagina);
if(retorne_configuracao_pagina(retorne_idpagina_request(), 2) == false and $usuario_inscrito == false){
        return null;
};
if(retorne_configuracao_pagina(retorne_idpagina_request(), 3) == false){
        if($usuario_inscrito == false){
                return null;
	};
};
if(retorne_pagina_existe($pagina) == false){
		return null;
};
if(retorne_usuario_dono_pagina($uid, $pagina) == true){
		return null;
};
if($usuario_inscrito == false){
        $query = "insert into $tabela values(null, '$pagina', '$titulo_pagina', '$uid');";
		$adicionou = 1;
}else{
	    $query = "delete from $tabela where pagina='$pagina' and uidamigo='$uid';";
		$adicionou = 0;
		limpar_dados_usuario_desinscrever_pagina($pagina, $uid);
};
plugin_executa_query($query);
$array_retorno["dados"] = campo_inscrever_pagina($pagina, true);
$array_retorno["adicionou"] = $adicionou;
return json_encode($array_retorno);
};
function campo_exibe_inscritos_pagina(){
global $idioma_sistema;
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$pagina = retorne_idpagina_request();
$funcao[0] = "exibir_inscritos_pagina(\"$pagina\", \"$idcampo[0]\", \"$idcampo[1]\", \"1\");";
$campo[0] = constroe_paginador_padrao($idcampo[1], $funcao[0]);
$script[0] = "
<script>
$funcao[0]
</script>
";
$html = "
<div class='classe_titulo_exibe_inscritos_pagina_usuario classe_cor_21 classe_cor_8 classe_cor_4'>
$idioma_sistema[262]
</div>
<div class='classe_exibe_inscritos_pagina_usuario' id='$idcampo[0]'>
</div>
$campo[0]
$script[0]
";
return $html;
};
function campo_formulario_atualizar_pagina($id){
global $idioma_sistema;
global $variavel_campo;
if(retorne_usuario_dono_pagina(retorne_idusuario_request(), $id) == false){
	    return null;
};
$dados = retorne_dados_perfil_pagina($id);
$url_formulario = PAGINA_ACOES;
$array_campos = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CAMPOS);
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CORPO);
$contador = 0;
$evento[0] = "onkeyup='auto_ajustar_campo_textarea(this);'";
foreach($array_campos as $campo){
		if($campo != null){
				$campo_tabela = trata_campo_tabela($array_campos_tabela[$contador + 1], false);
				$valor_campo = $dados[$campo_tabela];
				switch($contador){
			case 1:
						$valor_campo = adiciona_quebra_linha_textarea($valor_campo);
						$campos[0] .= "
			<div class='classe_campo_criar_pagina_usuario_campo'>
			<div class='classe_campo_criar_pagina_usuario_campo_titulo classe_cor_11'>$campo</div>
			<div class='classe_campo_criar_pagina_usuario_campo_campo'>
			<textarea name='$campo_tabela' cols='28' rows='10' placeholder='$campo' $evento[0]>$valor_campo</textarea>
			</div>
			</div>
			";	
			break;
			default:
						$campos[0] .= "
			<div class='classe_campo_criar_pagina_usuario_campo'>
			<div class='classe_campo_criar_pagina_usuario_campo_titulo classe_cor_11'>$campo</div>
			<div class='classe_campo_criar_pagina_usuario_campo_campo'>
			<input type='text' name='$campo_tabela' placeholder='$campo' value='$valor_campo'>
			</div>
			</div>
			";
		};
				$contador++;
	};	
};
$campos[1] = "
<div class='classe_campo_criar_pagina_usuario_campo'>
<input type='submit' value='$idioma_sistema[251]'>
</div>
";
$html = "
<div class='classe_campo_criar_pagina_usuario'>
<form action='$url_formulario' method='post'>
<input type='hidden' name='$variavel_campo[2]' value='54'>
<input type='hidden' name='$variavel_campo[25]' value='$id'>
$campos[0]
$campos[1]
</form>
</div>
";
return $html;
};
function campo_formulario_configuracoes_pagina(){
global $idioma_sistema;
if(retorne_usuario_dono_pagina(retorne_idusuario_logado(), retorne_idpagina_request()) == false){
        return null;
};
$campo[0] = constroe_campo_configuracoes_pagina(retorne_idpagina_request());
$html = "
<div class='classe_campo_configurar_pagina'>
$campo[0]
</div>
";
return $html;
};
function campo_formulario_construir_pagina(){
global $idioma_sistema;
global $variavel_campo;
if(retorne_pode_criar_paginas() == false){
        return null;	
};
$numero_paginas = retorne_numero_paginas_usuario(retorne_idusuario_request());
$url_formulario = PAGINA_ACOES;
$array_campos = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CAMPOS);
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CORPO);
$contador = 0;
foreach($array_campos as $campo){
if($campo != null){
		$campo_tabela = trata_campo_tabela($array_campos_tabela[$contador + 1], false);
		switch($contador){
		case 1:
				$campos[0] .= "
		<div class='classe_campo_criar_pagina_usuario_campo'>
		<div class='classe_campo_criar_pagina_usuario_campo_titulo'>$campo</div>
		<div class='classe_campo_criar_pagina_usuario_campo_campo'><textarea name='$campo_tabela' cols='28' rows='10' placeholder='$campo'></textarea></div>
		</div>
		";	
		break;
		default:
				$campos[0] .= "
		<div class='classe_campo_criar_pagina_usuario_campo'>
		<div class='classe_campo_criar_pagina_usuario_campo_titulo'>$campo</div>
		<div class='classe_campo_criar_pagina_usuario_campo_campo'><input type='text' name='$campo_tabela' placeholder='$campo'></div>
		</div>
		";
	};
		$contador++;
};	
};
$campos[1] = "
<div class='classe_campo_criar_pagina_usuario_campo'>
<input type='submit' value='$idioma_sistema[240]'>
</div>
";
if($numero_paginas == 0){
	    $mensagem[0] = mensagem_sucesso(retorne_nome_usuario_logado().$idioma_sistema[244].NUMERO_MAXIMO_PAGINAS_USUARIO.$idioma_sistema[243]);
}else{
		if($numero_paginas > 1){
				$plural[0] = $idioma_sistema[243];
	}else{
				$plural[0] = $idioma_sistema[245];	
	};
        $mensagem[0] = mensagem_sucesso(retorne_nome_usuario_logado().$idioma_sistema[241].NUMERO_MAXIMO_PAGINAS_USUARIO.$idioma_sistema[242].$numero_paginas.$plural[0]);
};
$html = "
<div class='classe_campo_criar_pagina_usuario'>
$mensagem[0]
<form action='$url_formulario' method='post'>
<input type='hidden' name='$variavel_campo[2]' value='52'>
$campos[0]
$campos[1]
</form>
</div>
";
$html = constroe_conteudo_padrao(true, $html, null);
return $html;
};
function campo_inscrever_pagina($pagina, $modo){
global $idioma_sistema;
global $variavel_campo;
if($modo == true){
		$classe[0] = "classe_inscrever_pagina_2";
}else{
		$classe[0] = "classe_inscrever_pagina";
};
$sexo_usuario = retorne_sexo_usuario_logado();
$pagina_inicial = PAGINA_INICIAL;
$uid = retorne_idusuario_logado();
$usuario_dono = retorne_usuario_dono_pagina($uid, $pagina);
$numero_inscritos = retorne_numero_inscritos_pagina($pagina);
$idcampo[0] = codifica_md5("id_campo_inscreve_pagina_".$pagina.data_atual());
$idcampo[1] = codifica_md5("id_dialogo_cancelar_inscricao_pagina_".$pagina.data_atual());
$evento[0] = "onclick='adiciona_inscrito_pagina(\"$uid\", \"$idcampo[0]\", \"$idcampo[1]\");'";
$evento[1] = "onclick='exibe_dialogo(\"$idcampo[1]\");'";
if(retorne_usuario_inscrito_pagina($uid, $pagina) == true){
        $nome_usuario = retorne_nome_usuario_logado();
	    $campo[2] = "
	<div class='classe_texto_caixa_dialogo'>
	$nome_usuario$idioma_sistema[263]
	</div>
	<div class='classe_botao_caixa_dialogo'>
	<input type='button' value='$idioma_sistema[32]' $evento[0]>
	</div>	
	";
        $campo[2] = constroe_dialogo($idioma_sistema[264], $campo[2], $idcampo[1]);
		$evento[0] = $evento[1];
		if($sexo_usuario == true){
				$campo[0] = "
		<button $evento[0]>$idioma_sistema[257]</button>
		";
	}else{
				$campo[0] = "
		<button $evento[0]>$idioma_sistema[610]</button>
		";
	};
}else{
	    if(retorne_idpagina_request() != null){
	    	    if(retorne_configuracao_pagina(retorne_idpagina_request(), 2) == true and retorne_configuracao_pagina(retorne_idpagina_request(), 3) == true){
	                    $campo[0] = "
	        <button class='botao_inscrito' $evento[0]>$idioma_sistema[256]</button>	
	        ";		    
	    };
    };
};
if($usuario_dono == true){
	    $campo[0] = null;
	$campo[2] = null;
};
if($numero_inscritos > 1){
		$numero_inscritos = retorne_tamanho_resultado($numero_inscritos);
		$texto[0] = $numero_inscritos.$idioma_sistema[259];
}else{
		$texto[0] = $numero_inscritos.$idioma_sistema[260];	
};
if($numero_inscritos == 0){
		$texto[0] = $idioma_sistema[261];
};
$url[0] = "$pagina_inicial?$variavel_campo[25]=$pagina&$variavel_campo[6]=4";
$link[0] = "<a href='$url[0]' title='$texto[0]'>$texto[0]</a>";
$campo[1] = "
<div class='classe_numero_inscritos_pagina borda_div_2'>
$link[0]
</div>
";
$campo[3] = exibe_ultimos_usuarios_inscritos_perfil_pagina();
if(retorne_usuario_logado() == false){
		$campo[0] = null;
};
$campo[0] = "
<div class='campo_botao_inscrever_pagina'>
$campo[0]
</div>
";
$html = "
<div class='$classe[0]' id='$idcampo[0]'>
$campo[0]
$campo[1]
$campo[3]
</div>
$campo[2]
";
if($modo == false){
        $html = constroe_caixa(false, $html);
};
return $html;
};
function carregar_paginas_usuario(){
global $tabela_banco;
$modo = retorne_campo_formulario_request(6);
$uid = retorne_idusuario_request();
$termo_pesquisa = retorne_campo_formulario_request(22);
if($modo == null){
		$modo = 0;
};
if(retorne_zerar_contador_avanco_pesq_pagina($termo_pesquisa.$modo) == true){
		$limit = retorne_limit_query(retorne_campo_formulario_request(2), true);
		$zerou_contador = 1;
}else{
		$limit = retorne_limit_query(retorne_campo_formulario_request(2), false);
		$zerou_contador = 0;
};
switch($modo){
	case 0:
	$query = "select *from $tabela_banco[18] where uid='$uid' and titulo like'%$termo_pesquisa%' order by id desc $limit;";
	$modo_pagina = true;
	break;
	case 1:
	$query = "select *from $tabela_banco[22] where uidamigo='$uid' and titulo like'%$termo_pesquisa%' order by id desc $limit;";
	$modo_pagina = false;
	break;
	case 2:
	$query = "select *from $tabela_banco[18] where titulo like'%$termo_pesquisa%' order by id desc $limit;";
	$modo_pagina = true;	
	break;
};
$contador = 0;
$dados_query = plugin_executa_query($query);
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
		$dados = $dados_query["dados"][$contador];
		if($modo_pagina == true){
	    		$dados_perfil = retorne_dados_perfil_pagina($dados["id"]);
	};
    	$html .= constroe_pagina_miniatura($dados, $dados_perfil, $modo_pagina, true);
};
$array_retorno["dados"] = $html;
$array_retorno["zerou_contador"] = $zerou_contador;
return json_encode($array_retorno);
};
function carrega_lista_albuns_imagens_pagina(){
global $tabela_banco;
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;
$tabela = $tabela_banco[4];
$uid = retorne_idusuario_request();
if(retorne_numero_paginas_usuario($uid) == 0){
		return null;
};
$query = "select *from $tabela where uid='$uid' and pagina!='' order by id desc;";
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$pagina = $dados[PAGINA];
	$chave = $dados[CHAVE];
	$url_host_thumbnail = $dados[URL_HOST_THUMBNAIL];
		if($id != null and $pagina_anterior != $pagina){
				$numero_imagens = retorne_tamanho_resultado(retorne_numero_imagens_album_usuario($uid, $pagina));
				$url[0] = $pagina_inicial."?$variavel_campo[25]=$pagina&$variavel_campo[2]=7";
				$texto[0] = $idioma_sistema[596].retorne_titulo_pagina_id($pagina)." - ($numero_imagens)";
				$link[0] = "<a href='$url[0]' title='$texto[0]'>$texto[0]</a>";		
				$idcampo[0] = retorne_idcampo_md5();
				$propriedade_css[0] = "
		background-image: url(\"$url_host_thumbnail\");
		background-size: cover;
		background-repeat: no-repeat;
		background-position: 50% 50%;
		";
				$css[0] = constroe_css_manual(null, $idcampo[0], $propriedade_css[0]);
				$html .= "
		<div class='classe_separador_albuns_usuario' id='$idcampo[0]'>
		<div class='classe_separador_albuns_usuario_texto'>
		$link[0]
		</div>
		</div>
		$css[0]
		";
				$pagina_anterior = $pagina;
	};
};
return $html;
};
function carrega_recomendacoes_paginas(){
global $tabela_banco;
global $idioma_sistema;
$tabela[0] = $tabela_banco[19];
$tabela[1] = $tabela_banco[22];
$limit = "limit 0, ".NUMERO_RECOMENDACOES_INICIO;
$dados = retorne_dados_perfil_usuario_logado();
$interesses = $dados[INTERESSES];
if($interesses == null){
		return null;
};
$uid = retorne_idusuario_logado();
$interesses = explode(",", $interesses);
$contador = 0;
foreach($interesses as $interesse){
		if($interesse != null){
				$interesse = trim($interesse);
				if($contador > 0){
						$completa = "or";
		};
				$lista_query .= " $completa descricao_da_pagina like '%$interesse%' or titulo_da_pagina like '%$interesse%' ";
				$contador++;
	};
};
$query = "select *from $tabela[1] where uidamigo='$uid';";
$contador = 0;
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
$sub_contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$pagina = $dados[PAGINA];
		if($id != null){
				if($sub_contador > 0){
						$completa = "and";
		}else{
						$completa = null;
		};
				$lista_query_2 .= " $completa id!='$pagina'";
				$sub_contador++;
	};
};
if($linhas > 0){
		$lista_query_2 = "and $lista_query_2";
};
$query = "select *from $tabela[0] where ($lista_query) $lista_query_2 order by id desc $limit;";
$dados_query = plugin_executa_query($query);
$linhas = $dados_query["linhas"];
if($linhas == 0){
		return null;
};
$contador = 0;
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$html .= constroe_pagina_miniatura_sugestao($dados);
};
$html = "
<div class='classe_conteudo_recomendar_pagina'>
$html
</div>
";
return $html;
};
function chama_pagina_usuario($id){
global $variavel_campo;
if($id == null){
		return chama_pagina_inicial();
};
if(retorne_pagina_existe($id) == false){
		return chama_pagina_inicial();
};
$pagina_inicial = PAGINA_INICIAL."?".$variavel_campo[25]."=$id";
header("Location: $pagina_inicial");
};
function constroe_campo_autor_pagina(){
global $idioma_sistema;
$uid = retorne_idusuario_dono_pagina(retorne_idpagina_request());
$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, true, $uid);
if(retorne_sexo_idusuario($uid) == true){
		$texto[0] = $idioma_sistema[589];
}else{
		$texto[0] = $idioma_sistema[590];
};
$html = "
<div class='classe_campo_autor_pagina classe_cor_29'>
<div class='classe_campo_autor_pagina_titulo'>
$texto[0]
</div>
<div class='classe_campo_autor_pagina_usuario'>
$imagem_perfil_usuario
</div>
</div>
";
return $html;
};
function constroe_campo_configuracoes_pagina($pagina){
global $idioma_sistema;
global $tabela_banco;
$uid = retorne_idusuario_logado();
if(retorne_usuario_dono_pagina($uid, $pagina) == false){
		return null;
};
$array_campos = explode(",", $idioma_sistema[271]);
$array_campos_tabela = explode(",", CAMPO_TABELA_CONFIGURACOES_PAGINA_CORPO);
$contador = 0;
$query = "select *from $tabela_banco[23] where pagina='$pagina';";
$dados_query = plugin_executa_query($query);
$dados = $dados_query["dados"][0];
foreach($array_campos as $campo){
if($campo != null){
		$campo_tabela = $array_campos_tabela[$contador + 1];
		$campo_tabela = trata_campo_tabela($campo_tabela, false);
		$campo_elemento_nome = "campo_edita_configuracoes_pagina_$campo_tabela";
		$valor_campo = $dados[$campo_tabela];
		$contador++;
		$descricao = $array_campos[$contador - 1];
		$icampo[0] = codifica_md5($campo_elemento_nome.data_atual());
		if($valor_campo == true){
				$setado = "checked";
	}else{
				$setado = null;
	};
		$eventos[0] = "onclick='salvar_configuracoes_pagina(\"$icampo[0]\", \"2\", \"$contador\", \"$pagina\")';";
		$html .= "
	<div class='classe_separa_campo_formulario_edita_privacidade'>
	<input type='checkbox' id='$icampo[0]' $setado $eventos[0]>
	<span>$descricao</span>
	</div>
	";
};
};
return $html;
};
function constroe_campo_construir_paginas(){
global $idioma_sistema;
global $variavel_campo;
if(retorne_pode_criar_paginas() == false){
        return null;	
};
$pagina_inicial = PAGINA_INICIAL;
$link[0] = "<a href='$pagina_inicial?$variavel_campo[2]=110' title='$idioma_sistema[238]'>$idioma_sistema[238]</a>";
$campos[0] = "
<div class='classe_construir_pagina_perfil_campo_0 classe_cor_4'>
$link[0]
</div>
";
$html = "
<div class='classe_construir_pagina_perfil'>
$campos[0]
</div>
";
return $html;
};
function constroe_campo_excluir_pagina(){
global $idioma_sistema;
$pagina = retorne_idpagina_request();
if(retorne_usuario_dono_pagina(retorne_idusuario_logado(), $pagina) == false){
		return null;
};
$nome_usuario = retorne_nome_usuario_logado();
$mensagem[0] = $nome_usuario.$idioma_sistema[273];
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$evento[0] = "onclick='excluir_pagina_usuario(\"$pagina\", \"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\");'";
$html = "
<div class='classe_div_campo_excluir_pagina_separa'>
$mensagem[0]
</div>
<div class='classe_div_campo_excluir_pagina_separa'>
<div class='classe_div_campo_excluir_pagina_separa_campo' id='$idcampo[1]'></div>
<div class='classe_div_campo_excluir_pagina_separa_entrada'>
<input type='password' placeholder='$idioma_sistema[2]' id='$idcampo[0]'>
</div>
<div class='classe_div_campo_excluir_pagina_separa_botao' id='$idcampo[2]'>
<input type='button' value='$idioma_sistema[274]' $evento[0]>
</div>
</div>
";
return $html;
};
function constroe_campo_visualizar_paginas($modo){
global $idioma_sistema;
global $tabela_banco;
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);
if($modo == true){
        $array_paginas = $dados_compilados_usuario[$tabela_banco[18]];
    $array_paginas_perfil = $dados_compilados_usuario[$tabela_banco[19]];
	    $array_paginas = inverte_array($array_paginas);
    $array_paginas_perfil = inverte_array($array_paginas_perfil);
}else{
        $array_paginas = $dados_compilados_usuario[$tabela_banco[22]];
        $array_paginas = inverte_array($array_paginas);
};
if(count($array_paginas) == 0){
		return null;
};
$contador = 0;
for($contador == $contador; $contador <= count($array_paginas); $contador++){
        if($contador > NUMERO_PAGINAS_EXIBE_PERFIL_BASICO){
				break;
	};
		$paginas .= constroe_pagina_miniatura($array_paginas[$contador], $array_paginas_perfil[$contador], $modo, false);
};
if($paginas != null){
		$html = "
	<div class='classe_campo_visualizar_paginas_perfil'>
	$paginas
	</div>
	";
};
return $html;
};
function constroe_capa_perfil_pagina_usuario(){
global $tabela_banco;
global $idioma_sistema;
$tabela = $tabela_banco[21];
$pagina = retorne_idpagina_request();
$usuario_dono = retorne_usuario_dono_pagina(retorne_idusuario_request(), $pagina);
$query = "select *from $tabela where id='$pagina';";
$dados = retorne_dados_query($query);
$url_host_grande = $dados[URL_HOST_GRANDE];
$topo = $dados[TOPO]."px";
if($usuario_dono == false and $url_host_grande == null){
		return null;
};
if($usuario_dono == true and $url_host_grande == null){
		$url_host_grande = retorne_imagem_sistema(130, null, true);
};
if($url_host_grande != null){
		$classe_id[0] = retorne_idcampo_md5();
		$propriedade_css[0] = "
	background-image: url(\"$url_host_grande\");
	background-size: cover;
	background-repeat: no-repeat;
	background-position: 50% $topo;
	";
		$css[0] = constroe_css_manual(null, $classe_id[0], $propriedade_css[0]);
		$campo[1] = "
	<div class='classe_div_capa_usuario_imagem_pagina' id='$classe_id[0]' title='$idioma_sistema[19]'>
	</div>
	$css[0]
	";
};
if($usuario_dono == true){
		$campo[0] = constroe_opcoes_capa(true, $classe_id[0], $dados);
};
$html = "
<div class='classe_div_capa_usuario_pagina classe_cor_35'>
	$campo[0]
	$campo[1]
</div>
";
return $html;
};
function constroe_carregar_paginas_usuario(){
global $idioma_sistema;
$idcampo[0] = retorna_idcampo_conteudo_geral();
$campo[0] = "
<div class='classe_paginas_criadas_usuario_titulo'>
$idioma_sistema[475]
</div>
";
$campo[1] = "
<div class='classe_paginas_criadas_usuario_lista' id='$idcampo[0]'></div>
";
$campo[2] = constroe_campo_paginar(null);
$html = "
<div class='classe_paginas_criadas_usuario classe_cor_8'>
$campo[0]
$campo[1]
$campo[2]
</div>
";
return $html;
};
function constroe_configurar_pagina(){
global $idioma_sistema;
$conteudo[0] = constroe_opcoes_configuracoes_pagina();
$id = retorne_idpagina_request();
if(retorne_usuario_logado_dono_pagina($id) == false){
		return null;
};
switch(retorne_campo_formulario_request(46)){
	case 1:
		$titulo = $idioma_sistema[397];
		$conteudo[1] = constroe_campo_alterar_url_usuario(true);
	break;
	case 2:
		$titulo = $idioma_sistema[398];
		$conteudo[1] = constroe_imagem_redimensionar(1);
	break;
	case 3:
		$titulo = $idioma_sistema[269];
		$conteudo[1] = campo_formulario_configuracoes_pagina();
	break;
	case 4:
	$titulo = $idioma_sistema[250];
	$conteudo[1] = campo_formulario_atualizar_pagina($id);
	break;
	case 5:
	$titulo = $idioma_sistema[272];
	$conteudo[1] = constroe_campo_excluir_pagina();
	break;
	default:
		$titulo = $idioma_sistema[397];
		$conteudo[1] = constroe_campo_alterar_url_usuario(true);
};
$html = "
<div class='classe_div_titulo_formulario_ed_perfil'>
$titulo
</div>
<div class='classe_div_campos_formulario_ed_perfil'>
<div class='classe_opcoes_configuracoes_perfil cor_borda_div'>
$conteudo[0]
</div>
<div class='classe_conteudo_configuracoes_perfil'>
$conteudo[1]
</div>
</div>
";
return $html;
};
function constroe_imagem_perfil_miniatura_pagina($id){
global $tabela_banco;
$tabela = $tabela_banco[20];
$query = "select *from $tabela where id='$id';";
$dados_perfil = retorne_dados_perfil_pagina($id);
$dados_imagem = plugin_executa_query($query);
$titulo_da_pagina = $dados_perfil[TITULO_DA_PAGINA];
$url_host_miniatura = $dados_imagem["dados"][0][URL_HOST_MINIATURA];
$imagem[0] = "
<img src='$url_host_miniatura' title='$titulo_da_pagina' alt='$titulo_da_pagina'>
";
$imagem[0] = retorne_link_pagina($id, $titulo_da_pagina, $imagem[0]);
$html = "
<div class='classe_div_imagem_perfil_miniatura_div_img'>
$imagem[0]
</div>
";
$html = "
<div class='classe_div_imagem_perfil_miniatura'>
$html
</div>
";
return $html;
};
function constroe_imagem_perfil_pagina(){
global $idioma_sistema;
$id = retorne_idpagina_request();
$imagem[0] = retorne_imagem_perfil_pagina($id, true);
if(retorne_usuario_dono_pagina(retorne_idusuario_request(), $id) == true){
        $campo_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, "if_formulario_upload_img_perfil_pagina", "foto", 53, false, 1);
		$imagem[0] = campo_redimensionar_imagem($imagem[0], 1);
		$campo[0] = "
	<div class='campo_editar_imagem_perfil_upload'>
	$campo_upload
	</div>
	";	
};
$campo_imagem_perfil = "
<div class='classe_perfil_basico_usuario_imagem'>
$imagem[0]
</div>
";
$html = "
<div class='classe_div_imagem_perfil_grande'>
$campo_imagem_perfil
</div>
<div class='classe_opcoes_imagem_perfil_pagina'>
$campo[0]
</div>
";
return $html;
};
function constroe_opcoes_configuracoes_pagina(){
global $titulo_link_pagina;
global $pagina_inicial;
global $idioma_sistema;
global $variavel_campo;
$modo_config = retorne_campo_formulario_request(46);
$contador = 0;
$id = retorne_idpagina_request();
foreach($titulo_link_pagina as $titulo){
		if($titulo != null){
				$contador++;
				$url = $pagina_inicial."?$variavel_campo[25]=$id&&$variavel_campo[6]=2&$variavel_campo[46]=$contador";
				$link = "<a href='$url' title='$titulo'>$titulo</a>";
				if($contador == $modo_config){
						$html .= "<div class='classe_div_opcao_configuracao_selecionada classe_cor_3'>$link</div>";
		}else{
						$html .= "<div class='classe_div_opcao_configuracao_padrao'>$link</div>";
		};
	};
};
return $html;
};
function constroe_paginas_criadas(){
global $tabela_banco;
global $idioma_sistema;
$tabela = $tabela_banco[18];
$uid = retorne_idusuario_logado();
$limit = retorne_limit_query_iniciar(false, null);
$query = "select *from $tabela where uid='$uid' order by id desc $limit;";
$dados_query = plugin_executa_query($query);
$contador = 0;
$linhas = $dados_query["linhas"];
for($contador == $contador; $contador <= $linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	$data = $dados[DATA];
		if($id != null){
				$dados_perfil = retorne_dados_perfil_pagina($id);
				$titulo_da_pagina = $dados_perfil[TITULO_DA_PAGINA];
		$descricao_da_pagina = $dados_perfil[DESCRICAO_DA_PAGINA];
				$imagem_perfil = retorne_imagem_perfil_pagina($id, false);
				$titulo_da_pagina = retorne_link_pagina($id, $titulo_da_pagina, $titulo_da_pagina);
				$data = converte_data_amigavel(true, $data);
				$campo[0] = "
		<div class='classe_pagina_miniatura_conteudo_pesquisa'>
		<div class='classe_pagina_miniatura_titulo'>
		$titulo_da_pagina
		</div>
		<div class='classe_pagina_miniatura_descreve'>
		$descricao_da_pagina
		</div>
		<div class='classe_pagina_miniatura_data classe_cor_2'>
		$idioma_sistema[477]$data
		</div>
		</div>
		";
				$campo[0] = "
		<div class='classe_pagina_miniatura_criada'>
		<div class='classe_pagina_miniatura_imagem'>
		$imagem_perfil
		</div>
		$campo[0]
		</div>
		";
				$html .= $campo[0];
	};
};
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
function constroe_paginas_perfil_basico(){
global $idioma_sistema;
global $variavel_campo;
$uid = retorne_idusuario_request();
$numero_paginas = retorne_numero_paginas_usuario(retorne_idusuario_request());
$numero_paginas_inscritas = retorne_numero_paginas_inscritas_usuario(retorne_idusuario_request());
$classe[0] = "classe_paginas_perfil_basico_titulo classe_cor_29";
if($numero_paginas > 0){
		if($numero_paginas > 1){
				$plural[0] = $idioma_sistema[236];
	}else{
				$plural[0] = $idioma_sistema[246];	
	};
		$numero_paginas = retorne_tamanho_resultado($numero_paginas);
		$titulo_link = $numero_paginas.$plural[0];
		$url = PAGINA_INICIAL."?$variavel_campo[5]=$uid&$variavel_campo[2]=108&$variavel_campo[6]=0";
		$link = "<a href='$url' title='$titulo_link'>$titulo_link</a>";
	    $campos[0] = "
    <div class='$classe[0]'>
    $link
    </div>
    ";
};
if($numero_paginas_inscritas > 0){
		if($numero_paginas_inscritas > 1){
				$plural[1] = $idioma_sistema[266];
	}else{
				$plural[1] = $idioma_sistema[265];	
	};
		$numero_paginas_inscritas = retorne_tamanho_resultado($numero_paginas_inscritas);
		$titulo_link = $numero_paginas_inscritas.$plural[1];
		$url = PAGINA_INICIAL."?$variavel_campo[5]=$uid&$variavel_campo[2]=108&$variavel_campo[6]=1";
		$link = "<a href='$url' title='$titulo_link'>$titulo_link</a>";
	    $campos[4] = "
    <div class='$classe[0]'>
    $link
    </div>
    ";
};
$campos[1] = constroe_campo_visualizar_paginas(true);
$campos[2] = constroe_campo_construir_paginas();
$campos[3] = constroe_campo_visualizar_paginas(false);
$html = "
<div class='classe_paginas_perfil_basico'>
$campos[0]
$campos[1]
$campos[4]
$campos[3]
$campos[2]
</div>
";
return $html;
};
function constroe_pagina_miniatura($dados, $dados_perfil, $modo, $modo_perfil){
global $idioma_sistema;
if($modo == true){
		$id = $dados_perfil["id"];
}else{
	    $id = $dados[PAGINA];
	    $dados_perfil = retorne_dados_perfil_pagina($id);	
};
if($id == null){
	    return null;
};
$titulo_da_pagina = $dados_perfil[TITULO_DA_PAGINA];
$numero_inscritos = retorne_numero_inscritos_pagina($id);
if($numero_inscritos > 1){
		$numero_inscritos = retorne_tamanho_resultado($numero_inscritos).$idioma_sistema[506];
}else{
		$numero_inscritos .= $idioma_sistema[507];
};
$imagem_perfil = retorne_imagem_perfil_pagina($id, false);
$titulo_da_pagina = retorne_link_pagina($id, $titulo_da_pagina, $titulo_da_pagina);
if($modo_perfil == true){
		$campo[0] = "
	<div class='classe_pagina_miniatura_conteudo_pesquisa'>
	<div class='classe_pagina_miniatura_titulo'>
	<div class='classe_pagina_miniatura_titulo_titulo'>
	$titulo_da_pagina
	</div>
	<div class='classe_pagina_miniatura_titulo_inscritos classe_cor_15'>
	$numero_inscritos
	</div>
	</div>
	</div>
	";
}else{
		$campo[0] = "
	<div class='classe_pagina_miniatura_conteudo'>
	<div class='classe_pagina_miniatura_titulo'>
	<div class='classe_pagina_miniatura_titulo_titulo'>
	$titulo_da_pagina
	</div>
	<div class='classe_pagina_miniatura_titulo_inscritos classe_cor_15'>
	$numero_inscritos
	</div>
	</div>
	</div>
	";
};
$html = "
<div class='classe_pagina_miniatura'>
<div class='classe_pagina_miniatura_imagem'>
$imagem_perfil
</div>
$campo[0]
</div>
";
return $html;
};
function constroe_pagina_miniatura_sugestao($dados){
global $idioma_sistema;
$id = $dados["id"];
$uid = $dados[UID];
$titulo_da_pagina = $dados[TITULO_DA_PAGINA];
$descricao_da_pagina = $dados[DESCRICAO_DA_PAGINA];
$web_site = $dados[WEB_SITE];
$telefone = $dados[TELEFONE];
if($id == null or retorne_idpagina_request() != null){
		return null;
};
$imagem_perfil = retorne_imagem_perfil_pagina($id, false);
$titulo_da_pagina = retorne_link_pagina($id, $titulo_da_pagina, $titulo_da_pagina);
$numero_inscritos = retorne_numero_inscritos_pagina($id);
if($numero_inscritos > 1){
		$texto[0] = retorne_tamanho_resultado($numero_inscritos).$idioma_sistema[506];
}else{
		$texto[0] = $numero_inscritos.$idioma_sistema[507];
};
$campo[0] = "
<div class='classe_pagina_miniatura_campo_inscrever'>
<span>
$titulo_da_pagina
</span>
<span class='classe_cor_15'>
$texto[0]
</span>
</div>
";
$html = "
<div class='classe_pagina_miniatura_sugestao'>
<div class='classe_pagina_miniatura_imagem_sugestao'>
$imagem_perfil
</div>
$campo[0]
</div>
";
return $html;
};
function constroe_pagina_usuario(){
global $idioma_sistema;
$modo_mobile = retorne_modo_mobile();
$campo[0] = campo_inscrever_pagina(retorne_idpagina_request(), false);
$campo[1] = constroe_campo_autor_pagina();
if($modo_mobile == false){
		$html[1] .= constroe_campos_perfil_usuario_lateral_direito(true);
		$html[2] = constroe_perfil_topo_pagina();
		$html[3] = constroe_imagem_perfil_pagina();
		$html[2] .= constroe_chat_usuario();
}else{
		$campo_imagem_perfil = constroe_imagem_perfil_pagina();
		$campo_imagem_perfil = "
	<div class='classe_campo_imagem_perfil_pagina_mobile classe_cor_2'>
	$campo_imagem_perfil
	</div>	
	";
		$html[2] .= $campo_imagem_perfil;
	$html[2] .= constroe_perfil_topo_pagina();
	$html[2] .= $campo[0];
		$campo[0] = null;
};
switch(retorne_campo_formulario_request(6)){
	case MODO_RECORTAR_IMAGEM_PAGINA:
	$html[2] = constroe_caixa(true, constroe_imagem_redimensionar(1));
	break;
	case MODO_CONFIG_PAGINA_1:
	$html[2] = constroe_caixa(true, constroe_configurar_pagina());
	break;
	case MODO_CARREGA_USUARIOS_PAGINA:
	$html[2] = constroe_caixa(true, campo_exibe_inscritos_pagina());
	break;
	default:
		$html[2] .= constroe_campo_publicar();
};
switch(retorne_campo_formulario_request(2)){
	case 7:
	$html[2] = constroe_caixa(true, constroe_carregar_imagens());
	break;
};
$html[3] .= $campo[0];
$html[3] .= $campo[1];
$html[4] = constroe_conteudo_rodape();
return $html;
};
function constroe_perfil_topo_pagina(){
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;
$id = retorne_idpagina_request();
$usuario_dono = retorne_usuario_logado_dono_pagina($id);
$dados[0] = retorne_dados_perfil_pagina($id);
$dados[1] = retorne_dados_cadastro_pagina($id);
$titulo_da_pagina = $dados[0][TITULO_DA_PAGINA];
$descricao_da_pagina = converter_urls(false, $dados[0][DESCRICAO_DA_PAGINA]);
$web_site = converte_url_link($dados[0][WEB_SITE]);
$telefone = $dados[0][TELEFONE];
$data = converte_data_amigavel(true, $dados[1][DATA]);
$campo[1] ="
<div class='classe_subtitulo_pagina_usuario classe_cor_2'>
$titulo_da_pagina
</div>
";
$campo[2] = "
<div class='classe_descricao_pagina'>
<div class='classe_descricao_pagina_titulo classe_cor_2 classe_cor_12'>
$idioma_sistema[248]
</div>
<div class='classe_descricao_pagina_descreve'>
$descricao_da_pagina
</div>
</div>
";
$campo[3] = "
<div class='classe_descricao_pagina'>
<div class='classe_descricao_pagina_titulo classe_cor_2 classe_cor_12'>
$idioma_sistema[249]
</div>
<div class='classe_descricao_pagina_descreve'>
$web_site
</div>
</div>
";
if($usuario_dono == true){
		$campo[4] = $pagina_inicial."?$variavel_campo[25]=$id&&$variavel_campo[6]=2";
		$campo[4] = "
	<span class='classe_campo_editar_pagina_span'>
	<a href='$campo[4]' title='$idioma_sistema[269]'>$idioma_sistema[269]</a>
	</span>
	";
};
$campo[5] = "
<div class='classe_descricao_pagina'>
<div class='classe_descricao_pagina_titulo classe_cor_2 classe_cor_12'>
$idioma_sistema[252]
</div>
<div class='classe_descricao_pagina_descreve'>
$telefone
</div>
</div>
";
$campo[6] = "
<div class='classe_descricao_pagina'>
<div class='classe_descricao_pagina_titulo classe_cor_2 classe_cor_12'>
$idioma_sistema[253]
</div>
<div class='classe_descricao_pagina_descreve'>
$data
</div>
</div>
";
$campo[7] = constroe_capa_perfil_pagina_usuario();
$campo[8] = constroe_conteudo_topo_meio();
$campo[9] = constroe_campo_album_perfil_basico();
$campo[9] = "
<div class='classe_campo_imagens_topo_pagina'>
$campo[9]
</div>
";
$campos_perfil = "
<div class='classe_pagina_ultima_visualizacao_usuario'>
$campo[8]
</div>
<div class='classe_campo_editar_pagina'>
$campo[4]
</div>
$campo[9]
$campo[1]
$campo[2]
$campo[3]
$campo[5]
$campo[6]
";
$campos_perfil = constroe_caixa(false, $campos_perfil);
$html = "
$campo[7]
$campos_perfil
";
return $html;
};
function constroe_visualizador_paginas_usuario(){
global $idioma_sistema;
$uid = retorne_idusuario_request();
$modo = retorne_campo_formulario_request(6);
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
$idcampo[2] = retorne_idcampo_md5();
$idcampo[3] = retorne_idcampo_md5();
$funcao[0] = "carregar_paginas_usuario(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\")";
$funcao[1] = "alterar_modo_pesquisa_paginas(\"$idcampo[3]\")";
$evento[0] = "onkeyup='$funcao[0];'";
$numero_paginas_criadas = retorne_tamanho_resultado(retorne_numero_paginas_usuario($uid));
$numero_paginas_inscritas = retorne_tamanho_resultado(retorne_numero_paginas_inscritas_usuario($uid));
$array_options .= $numero_paginas_criadas.$idioma_sistema[236].",";
$array_options .= $numero_paginas_inscritas.$idioma_sistema[266].",";
$array_options .= $idioma_sistema[536];
$array_valores = "0,1,2";
$campo_select_option = gerador_select_option_especial($array_options, $array_valores, $modo, null, $idcampo[3], "$funcao[1], $funcao[0]");
$campo[0] = "
<div class='classe_opcoes_pesquisa_pagina_usuario classe_cor_2'>
<div class='classe_opcoes_pesquisa_pagina_usuario_separa1'>
<input type='text' placeholder='$idioma_sistema[535]' id='$idcampo[2]' $evento[0]>
</div>
<div class='classe_opcoes_pesquisa_pagina_usuario_separa2'>
$campo_select_option
</div>
</div>
";
$campo[1] = constroe_conteudo_padrao(false, null, $idcampo[0]);
$campo[2] = constroe_paginador_padrao($idcampo[1], $funcao[0]);
$script = "
<script>
$funcao[0];
</script>
";
$html = "
$campo[0]
$campo[1]
$campo[2]
$script
";
return constroe_conteudo_padrao(true, $html, null);
};
function criar_pagina(){
global $tabela_banco;
global $variavel_campo;
$id = retorne_idpagina_request();
$tipo_acao = 110;
if(retorne_pode_criar_paginas() == false and retorne_campo_formulario_request(2) == 52){
	    return chama_acao_usuario($tipo_acao);
};
$array_campos = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CAMPOS);
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CORPO);
$contador = 0;
$titulo_pagina = null;
foreach($array_campos as $campo){
		if($campo != null){
				$campo_tabela = trata_campo_tabela($array_campos_tabela[$contador + 1], false);
				$valor_requeste = remove_html($_REQUEST[$campo_tabela]);	
				if($contador == 0){
						$titulo_pagina = $valor_requeste;
		};
				if($valor_requeste == null){
						return chama_acao_usuario($tipo_acao);
		};
				$campos_adicionar .= "\"$valor_requeste\", ";	
				$contador++;
	};
};
$campos_adicionar = substr($campos_adicionar, 0, -2);
$idusuario = retorne_idusuario_logado();
$data = data_atual();
$campos_adicionar = "\"$idusuario\", $campos_adicionar";
if(retorne_campo_formulario_request(2) == 54){
		if(retorne_usuario_dono_pagina($idusuario, $id) == false){
                return chama_pagina_usuario($id);		
	};
		$query[0] = "delete from $tabela_banco[19] where id='$id';";
	$query[1] = "insert into $tabela_banco[19] values(\"$id\", $campos_adicionar);";
	$query[2] = "update $tabela_banco[18] set titulo='$titulo_pagina' where id='$id' and uid='$idusuario';";
	$query[3] = "update $tabela_banco[22] set titulo='$titulo_pagina' where pagina='$id';";
		plugin_executa_query($query[0]);
	plugin_executa_query($query[1]);
	plugin_executa_query($query[2]);
	plugin_executa_query($query[3]);
        atualiza_retorna_dados_usuario_sessao(true, true);
		$url_pagina = PAGINA_INICIAL."?$variavel_campo[25]=$id";
		return chama_pagina_url($url_pagina);
};
$query[0] = "insert into $tabela_banco[18] values(null, '$idusuario', '$titulo_pagina', '$data');";
$query[1] = "select *from $tabela_banco[18] where uid='$idusuario' order by id desc;";
plugin_executa_query($query[0]);
$dados_query = plugin_executa_query($query[1]);
$id = $dados_query["dados"][0]["id"];
$query[2] = "insert into $tabela_banco[19] values(\"$id\", $campos_adicionar);";
if($dados_query["linhas"] > 0){
        plugin_executa_query($query[2]);	
};
atualiza_retorna_dados_usuario_sessao(true, true);
return chama_pagina_usuario($id);
};
function erradicar_feeds_pagina_usuario($modo, $id_post, $uidamigo, $pagina){
global $tabela_banco;
if($pagina == null){
	    return null;
};
$query[0] = "select *from $tabela_banco[22] where pagina='$pagina';";
$dados_query = plugin_executa_query($query[0]);
$numero_linhas = $dados_query["linhas"];
$contador = 0;
for($contador == $contador; $contador <= $numero_linhas; $contador++){
	    $dados = $dados_query["dados"][$contador];
	    $idusuario = $dados[UIDAMIGO];
		$data = data_atual();	
		$query[1] = "insert into $tabela_banco[8] values(null, '$idusuario', '$uidamigo', '$id_post', '$data');";
		$query[2] = "delete from $tabela_banco[8] where uid='$idusuario' and id_post='$id_post';";
		if($modo == true){
	    	    if($idusuario != null){
	        		    plugin_executa_query($query[2]);
		    		    plugin_executa_query($query[1]);
	    };		
	}else{
			    if($idusuario != null){
	        		    plugin_executa_query($query[2]);
	    };
	};
};
};
function excluir_dados_pagina($pagina){
global $tabela_banco;
$uid = retorne_idusuario_logado();
if(retorne_usuario_dono_pagina($uid, $pagina) == false){
		return null;
};
$tabelas[0] = $tabela_banco[18];
$tabelas[1] = $tabela_banco[19];
$tabelas[2] = $tabela_banco[20];
$tabelas[3] = $tabela_banco[21];
$tabelas[4] = $tabela_banco[22];
$tabelas[5] = $tabela_banco[23];
$pasta_excluir[0] = retorne_pasta_usuario($uid, 7, true);
$pasta_excluir[1] = retorne_pasta_usuario($uid, 10, true);
excluir_pastas_subpastas($pasta_excluir[0], false);
excluir_pastas_subpastas($pasta_excluir[1], false);
$query[0] = "select *from $tabela_banco[5] where pagina='$pagina' and uid='$uid';";
$contador = 0;
$dados_query = plugin_executa_query($query[0]);
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
		if($id != null){
				excluir_publicacao_usuario($id, false);
	};
};
foreach($tabelas as $tabela){
		if($tabela != null){
				$query[0] = "delete from $tabela where id='$pagina';";
		$query[1] = "delete from $tabela where pagina='$pagina';";
				plugin_executa_query($query[0]);
		plugin_executa_query($query[1]);
	};
};
};
function excluir_pagina_usuario(){
global $idioma_sistema;
$senha = codifica_md5(retorne_campo_formulario_request(15));
$pagina = retorne_idpagina_request();
if($senha != retorna_senha_usuario_logado()){
		$array_retorno["dados"] = mensagem_erro($idioma_sistema[275]);
        return json_encode($array_retorno);	
};
excluir_dados_pagina($pagina);
$array_retorno["dados"] = "
\n
<script language='javascript'>
\n
location.reload();
\n
</script>
\n
";
return json_encode($array_retorno);
};
function excluir_todos_comentarios_pagina($id_post, $tabela_comentario){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$query = "delete from $tabela_banco[7] where id_post='$id_post' and tabela_comentario='$tabela_comentario' and uid='$uid';";
plugin_executa_query($query);
};
function exclui_curtidas_publicacao_pagina($id_post, $tabela_curtiu){
global $tabela_banco;
$uid = retorne_idusuario_logado();
$query = "delete from $tabela_banco[9] where id_post='$id_post' and tabela_curtiu='$tabela_curtiu' and uid='$uid';";
plugin_executa_query($query);
};
function exibe_ultimos_usuarios_inscritos_perfil_pagina(){
global $tabela_banco;
$pagina = retorne_idpagina_request();
$limit = "limit ".NUMERO_AMIGOS_CAMPO_PERFIL;
$query = "select *from $tabela_banco[22] where pagina='$pagina' order by id desc $limit;";
$dados_query = plugin_executa_query($query);
$contador = 0;
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
    $dados = $dados_query["dados"][$contador];
		$uidamigo = $dados[UIDAMIGO];
		if($uidamigo != null){
        		$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, false, $uidamigo);
		        $perfil_basico_usuario = "
        <div class='classe_div_separa_amigo_visualizar_perfil_pagina'>
        $imagem_perfil_usuario
        </div>
       ";
			    $html .= $perfil_basico_usuario;	
	};
};
return $html;
};
function exibir_inscritos_pagina(){
global $tabela_banco;
$tabela = $tabela_banco[22];
$pagina = retorne_idpagina_request();
if(retorne_campo_formulario_request(6) == 0){
        $limit = retorne_limit_query(retorne_campo_formulario_request(2), false);	
		$zerou_contador = 0;
}else{
        $limit = retorne_limit_query(retorne_campo_formulario_request(2), true);
		$zerou_contador = 1;
};
$query = "select *from $tabela where pagina='$pagina' order by id desc $limit;";
$contador = 0;
$dados_query = plugin_executa_query($query);
$numero_linhas = $dados_query["linhas"];
for($contador == $contador; $contador <= $numero_linhas; $contador++){
		$dados = $dados_query["dados"][$contador];
		$uidamigo = $dados[UIDAMIGO];
		if($uidamigo != null){
	    		$imagem_perfil_usuario = constroe_imagem_perfil_miniatura(false, true, $uidamigo);
		        $perfil_basico_usuario = "
        <div class='classe_div_separa_amigo_visualizar_perfil_pagina_2'>
        $imagem_perfil_usuario
        </div>
       ";
			    $html .= $perfil_basico_usuario;
	};
};
$array_retorno["dados"] = $html;
$array_retorno["zerou_contador"] = $zerou_contador;
return json_encode($array_retorno);
};
function limpar_dados_usuario_desinscrever_pagina($pagina, $uid){
global $tabela_banco;
if(retorne_usuario_dono_pagina($uid, $pagina) == true){
		return null;
};
$tabela[0] = $tabela_banco[5];
$query[0] = "select *from $tabela[0] where pagina='$pagina';";
$dados_query = plugin_executa_query($query[0]);
$contador = 0;
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
		$dados = $dados_query["dados"][$contador];
		$id = $dados["id"];
	    if($id != null){
                excluir_todos_comentarios_pagina($id, $tabela_banco[5]);
                exclui_curtidas_publicacao_pagina($id, $tabela_banco[5]);
			    limpar_sub_dados_usuario_desinscrever_pagina($dados[CHAVE]);
				erradicar_feeds_pagina_usuario(false, $id, $uid, $pagina);
	};
};
atualiza_retorna_dados_usuario_sessao(true, true);
};
function limpar_sub_dados_usuario_desinscrever_pagina($chave){
global $tabela_banco;
$idusuario = retorne_idusuario_logado();
$query = "select *from $tabela_banco[4] where chave='$chave';";
$dados_imagem = plugin_executa_query($query);
$contador = 0;
for($contador == $contador; $contador <= $dados_imagem["linhas"]; $contador++){
	    excluir_todos_comentarios_pagina($dados_imagem["dados"][$contador]["id"], $tabela_banco[4]);
	    exclui_curtidas_publicacao_pagina($dados_imagem["dados"][$contador]["id"], $tabela_banco[4]);
};
atualiza_retorna_dados_usuario_sessao(true, true);
};
function retorna_constroe_pagina(){
if(retorne_idpagina_request() == null){
		return false;
}else{
		return true;
};
};
function retorne_configuracao_pagina($id, $modo){
global $tabela_banco;
$query = "select *from $tabela_banco[23] where pagina='$id';";
$dados_query = plugin_executa_query($query);
if($dados_query["linhas"] == 0){
		return true;
};
switch($modo){
	case 0:
		$retorno = $dados_query["dados"][0][HABILITAR_COMENTARIOS];
	break;
	case 1:
		$retorno = $dados_query["dados"][0][HABILITAR_CURTIDAS];
	break;
	case 2:
		$retorno = $dados_query["dados"][0][HABILITAR_INSCRICOES];
	break;
	case 3:
		$retorno = $dados_query["dados"][0][SOMENTE_AMIGOS_PODEM_SE_INSCREVER];
		if($retorno == 1){
				$dados = retorne_dados_cadastro_pagina($id);
        		if(retorne_usuario_amigo($dados[UID]) == true){
						$retorno = 1;
		}else{
						$retorno = 0;
		};
	}else{
				$retorno = 1;
	};
	break;
};
if($retorno == 1){
		return true;
}else{
		return false;
};
};
function retorne_dados_cadastro_pagina($id){
global $tabela_banco;
$query = "select *from $tabela_banco[18] where id='$id';";
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0];
};
function retorne_dados_perfil_pagina($id){
global $tabela_banco;
$query = "select *from $tabela_banco[19] where id='$id';";
$dados_query = plugin_executa_query($query);
return $dados_query["dados"][0];
};
function retorne_idpagina_postagem($id){
$dados = retorne_dados_publicacao($id);
return $dados[PAGINA];
};
function retorne_idpagina_request(){
$idpagina = retorne_idusuario_amigavel_requeste(1);
if($idpagina == null){
		$idpagina = retorne_campo_formulario_request(25);
};
return $idpagina;
};
function retorne_idusuario_dono_pagina($id){
global $tabela_banco;
$query = "select *from $tabela_banco[18] where id='$id';";
$dados_query = plugin_executa_query($query);
$dados = $dados_query["dados"][0];
return $dados[UID];
};
function retorne_imagem_perfil_pagina($id, $modo){
global $tabela_banco;
$modo_mobile = retorne_modo_mobile();
$dados = retorne_dados_perfil_pagina($id);
$tabela = $tabela_banco[20];
$query = "select *from $tabela where id='$id';";
$dados_query = plugin_executa_query($query);
$dados_query = $dados_query["dados"][0];
$url_host_grande = $dados_query[URL_HOST_GRANDE];
$url_host_miniatura = $dados_query[URL_HOST_MINIATURA];
$url_host_mobile = $dados_query[URL_HOST_MOBILE];
if($url_host_grande == null or $url_host_miniatura == null){
	    $url_host_grande = retorne_imagem_sistema(22, false, true);
    $url_host_miniatura = retorne_imagem_sistema(21, false, true);
};
$titulo_comunidade = $dados[TITULO_DA_PAGINA];
if($modo == true){
		$imagem_perfil = "
	<img src='$url_host_grande' title='$titulo_comunidade' alt='$titulo_comunidade'>
	";
}else{
		$imagem_perfil = "
	<img src='$url_host_miniatura' title='$titulo_comunidade' alt='$titulo_comunidade'>
	";
};
$html = retorne_link_pagina($id, $titulo_comunidade, $imagem_perfil);
return $html;
};
function retorne_link_pagina($id, $titulo, $conteudo){
global $variavel_campo;
if(retorne_somente_nome_amigavel_idusuario(null, 1, $id) == null){
		$url_pagina = PAGINA_INICIAL."?$variavel_campo[25]=$id";
}else{
		$url_pagina = retorne_url_amigavel_usuario(null, 1, $id);
};
$html = "
<a href='$url_pagina' title='$titulo'>$conteudo</a>
";
return $html;
};
function retorne_modo_pagina(){
if(retorne_idpagina_request() != null){
		return true;
}else{
		return false;
};
};
function retorne_nome_link_pagina($id){
$titulo = retorne_titulo_pagina_id($id);
$link = retorne_link_pagina($id, $titulo, $titulo);
$html = "
<span class='span_link classe_nome_link_pagina_span'>
$link
</span>
";
return $html;
};
function retorne_numero_inscritos_pagina($id){
global $tabela_banco;
$tabela = $tabela_banco[22];
$query = "select *from $tabela where pagina='$id';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function retorne_numero_paginas_inscritas_usuario($idusuario){
global $tabela_banco;
$query = "select *from $tabela_banco[22] where uidamigo='$idusuario';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function retorne_numero_paginas_usuario($uid){
global $tabela_banco;
$query = "select *from $tabela_banco[18] where uid='$uid';";
$dados_query = plugin_executa_query($query);
return $dados_query["linhas"];
};
function retorne_numero_publicacoes_pagina($pagina){
global $tabela_banco;
$tabela = $tabela_banco[5];
$query = "select *from $tabela where pagina='$pagina';";
return retorne_numero_linhas_query($query);
};
function retorne_pagina_existe($pagina){
global $tabela_banco;
if($pagina == null){
		return false;
};
$query = "select *from $tabela_banco[18] where id='$pagina';";
$dados_query = plugin_executa_query($query);
if($dados_query["linhas"] == 0){
		return false;
}else{
		return true;
};
};
function retorne_pode_criar_paginas(){
if(retorne_numero_paginas_usuario(retorne_idusuario_logado()) >= NUMERO_MAXIMO_PAGINAS_USUARIO){
        return false;
}else{
		return true;
};
};
function retorne_titulo_pagina_id($id){
$dados = retorne_dados_perfil_pagina($id);
return $dados[TITULO_DA_PAGINA];
};
function retorne_usuario_dono_pagina($uid, $id){
global $tabela_banco;
if(retorne_usuario_logado() == false){
		return false;
};
$query = "select *from $tabela_banco[18] where id='$id' and uid='$uid';";
$dados_query = plugin_executa_query($query);
if($dados_query["linhas"] == 1){
		return true;
}else{
		return false;
};
};
function retorne_usuario_inscrito_pagina($uid, $pagina){
global $tabela_banco;
$tabela = $tabela_banco[22];
$query = "select *from $tabela where pagina='$pagina' and uidamigo='$uid';";
$dados_query = plugin_executa_query($query);
if($dados_query["linhas"] == 1){
		return true;
}else{
		return false;
};
};
function retorne_usuario_logado_dono_pagina($id){
return retorne_usuario_dono_pagina(retorne_idusuario_logado(), $id);
};
function retorne_zerar_contador_avanco_pesq_pagina($termo_pesquisa){
if($termo_pesquisa == null and $_SESSION[SESSAO_NOME_PESQ_PAGINA][retorna_token_pagina_requeste()] != null){
	    $_SESSION[SESSAO_NOME_PESQ_PAGINA][retorna_token_pagina_requeste()] = null;
		return true;
};
if($termo_pesquisa == null){
	    $_SESSION[SESSAO_NOME_PESQ_PAGINA][retorna_token_pagina_requeste()] = null;
	    return false;
};
if($_SESSION[SESSAO_NOME_PESQ_PAGINA][retorna_token_pagina_requeste()] == $termo_pesquisa){
    	return false;
}else{
        $_SESSION[SESSAO_NOME_PESQ_PAGINA][retorna_token_pagina_requeste()] = $termo_pesquisa;
		return true;
};
};
function salvar_configuracoes_pagina(){
global $tabela_banco;
$tabela = $tabela_banco[23];
$valor_campo = retorne_campo_formulario_request(27);
$numero_configuracao = retorne_campo_formulario_request(28);
$pagina = retorne_idpagina_request();
if(retorne_usuario_dono_pagina(retorne_idusuario_logado(), $pagina) == false or retorne_pagina_existe($pagina) == false){
		return null;
};
$array_campos_tabela = explode(",", CAMPO_TABELA_CONFIGURACOES_PAGINA_CORPO);
$campo_tabela = trata_campo_tabela($array_campos_tabela[$numero_configuracao], false);
$query[0] = "select *from $tabela where pagina='$pagina';";
$query[1] = "insert into $tabela values(null, '$pagina', '1', '1', '1', '1');";
$query[2] = "update $tabela set $campo_tabela='$valor_campo' where pagina='$pagina';";
$dados_query = plugin_executa_query($query[0]);
if($dados_query["linhas"] == 0){
    	plugin_executa_query($query[1]);
	plugin_executa_query($query[2]);
}else{
		plugin_executa_query($query[2]);
};
};
function visualizar_paginas_usuario(){
global $tabela_banco;
$modo = retorne_campo_formulario_request(6);
$modo_paginar = retorne_campo_formulario_request(26);
$uid = retorne_idusuario_request();
switch($modo){
	case 2:
    $limit = retorne_limit_query(retorne_tipo_acao_pagina(), true);
	$array_retorno["zerou_contador"] = 1;
	break;
	default:
    $limit = retorne_limit_query(retorne_tipo_acao_pagina(), false);
    $array_retorno["zerou_contador"] = 0;
};
switch($modo_paginar){
	case 0:
		$query = "select *from $tabela_banco[18] where uid='$uid' order by id desc $limit;";
		$modo_pagina = true;
	break;
	case 1:
		$query = "select *from $tabela_banco[22] where uidamigo='$uid' order by id desc $limit;";
		$modo_pagina = false;
	break;
};
$contador = 0;
$dados_query = plugin_executa_query($query);
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
		$dados = $dados_query["dados"][$contador];
		if($modo_pagina == true){
	    		$dados_perfil = retorne_dados_perfil_pagina($dados["id"]);
	};
    	$html .= constroe_pagina_miniatura($dados, $dados_perfil, $modo_pagina, true);
};
$array_retorno["dados"] = $html;
return json_encode($array_retorno);
};
?>
