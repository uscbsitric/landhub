<?php
	echo header("content-type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	echo "<Response>
		  	<Record transcribe='true' transcribeCallback='' />
		  </Response>
		 ";
	//echo @$content; 
?>