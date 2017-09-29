<?php

// remove codificação html
function remove_html($html){

// remove codificação html
$html = addslashes($html);
$html = strip_tags($html);

// se for e-mail converte para minusculo
if(verifica_se_email_valido($html) == true){

    // converte para minusculo
    $html = converte_minusculo($html);

};

// retorna
return $html;

};


?>
