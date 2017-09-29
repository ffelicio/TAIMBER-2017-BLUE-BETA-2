<?php

// remove parenteses
function remove_parenteses($texto){
	
// return
return preg_replace("/[^a-z0-9_\s-]/", "", $texto);

};

?>