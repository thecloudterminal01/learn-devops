<?php
$file = "ReadMe.md";

$file_contents = file_get_contents('ReadMe.md');
$pattern = '/High Level Objectives(.*?)Version Stack/s';
preg_match($pattern, $file_contents, $matches);

$lines_between_patterns = explode("\n", $matches[1]);

print_r($lines_between_patterns)

?>