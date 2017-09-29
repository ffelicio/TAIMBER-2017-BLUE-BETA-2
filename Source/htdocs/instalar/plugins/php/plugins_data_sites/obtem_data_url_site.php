<?php

// obtem data de url de site
function obtem_data_url_site($url){

// retorno
return @file_get_contents($url);

};

?>