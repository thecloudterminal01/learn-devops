<?php

function createTree($dir, $depth = 0) {
    $tree = "";

    $dirs = array_filter(glob($dir . '/*'), 'is_dir');
    sort($dirs);

    foreach ($dirs as $d) {
        $dirName = basename($d);

        // Exclude directories that match the pattern task-*
        if (preg_match('/^task/', $dirName)) {
            continue;
        }

        $link = str_replace(' ', '-', strtolower($dirName));
        $indent = str_repeat('  ', $depth);

        $tree .= "$indent- [$dirName](#$link)\n";

        if (!empty(glob("$d/*"))) {
            $tree .= createTree($d, $depth + 1);
        }
    }

    return $tree;
}

$tree = createTree("home");

$content = "# Home\n$tree";

// file_put_contents("README.md", $content);
// echo $content;


$stringArray = explode("<br>", $content);

foreach($stringArray as $line) {
    $line=str_replace(' ', '-', $line);
    echo $line;
}

// echo "Done!\n";
