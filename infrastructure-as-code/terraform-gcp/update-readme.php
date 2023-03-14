<?php

$dirs = glob('task-*', GLOB_ONLYDIR);

$objectives = array();

foreach ($dirs as $dir) {
    $readme_file = $dir . '/ReadMe.md';

    if (file_exists($readme_file)) {
        $file_contents = file_get_contents($readme_file);
        $pattern = '/High Level Objectives(.*?)Version Stack/s';
        preg_match($pattern, $file_contents, $matches);

        $lines_between_patterns = explode("\n", $matches[1]);

        $objectives[$dir] = $lines_between_patterns;
    }
}

print_r($objectives);

?>
