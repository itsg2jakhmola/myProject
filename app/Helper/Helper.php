<?php

function current_page($uri = "/"){
	return strstr(request()->path(), $uri);
}

?>