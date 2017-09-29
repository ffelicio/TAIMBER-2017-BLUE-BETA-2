<?php

// constroe o link de pesquisa
function constroe_link_pesquisa($valor_campo, $campo_tabela, $valor_campo_original){

// globals
global $variavel_campo;

// valida valor de campo e campo de tabela
if($valor_campo == null or $campo_tabela == null){

    // retorno nulo
    return null;    
	
};

// valida se é um host valido
if(retorna_host_valido_dados_site($valor_campo) == true){
	
	// converte url de host para link
	return converte_url_link($valor_campo);
	
};

// url de pagina inicial
$link[0] = PAGINA_INICIAL."?$variavel_campo[2]=106&$variavel_campo[7]=$valor_campo&$variavel_campo[8]=$campo_tabela&$variavel_campo[6]=0";

// html
$html = "
<span class='span_classe_link_pesquisa classe_cor_5'>
<a href='$link[0]' title='$valor_campo'>$valor_campo</a>
</span>
";

// retorno
return $html;

};

?>