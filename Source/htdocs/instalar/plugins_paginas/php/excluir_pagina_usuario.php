<?php

// excluir pagina de usuario
function excluir_pagina_usuario(){

// globals
global $idioma_sistema;

// dados de formulario
$senha = codifica_md5(retorne_campo_formulario_request(15));
$pagina = retorne_idpagina_request();

// valida dados de formulario
if($senha != retorna_senha_usuario_logado()){
	
	// array de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[275]);
	
    // retorno
    return json_encode($array_retorno);	

};

// exclui todos os dados da pagina
excluir_dados_pagina($pagina);

// array de retorno
$array_retorno["dados"] = "
\n
<script language='javascript'>
\n
location.reload();
\n
</script>
\n
";

// retorno
return json_encode($array_retorno);

};

?>