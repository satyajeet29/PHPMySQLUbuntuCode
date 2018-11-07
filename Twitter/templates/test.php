<?php
	$filename = "confirmationtemplate.html";

	if (file_exists($filename)) {
    						echo "The file $filename exists";

						$file = fopen("confirmationtemplate.html", "r") or die("Unable to open file");

						$template = fread($file, filesize("confirmationtemplate.html"));

						fclose($file);
						echo "</br>";
						echo $template;
				} else {
    						echo "The file $filename does not exist";
					}

$handle = fopen($filename, "r")or die("<br> can't open file");
          fclose($handle);

