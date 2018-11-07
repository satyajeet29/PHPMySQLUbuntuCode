<?php

$filename = '/var/www/html/Twitter';
if (is_writable($filename)) {
    echo 'The file is writable';
} else {
    echo 'The file is not writable';
}

?>
