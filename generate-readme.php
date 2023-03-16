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
        $indent = str_repeat('  ', $depth+1);

        $tree .= "$indent- [$dirName](#$link)\n";

        if (!empty(glob("$d/*"))) {
            $tree .= createTree($d, $depth + 1);
        }
    }

    return $tree;
}

$tree = createTree("home");

$content = "- [home](#home)\n$tree";

file_put_contents("README.md", $content);
echo $content;


$stringArray = explode("\n", $content);

foreach($stringArray as $line) {
    $hyphenCount=0;
    $line=str_replace(' ', '-', $line);
    echo "\nLine under consideration $line ";
    $parts = explode('[', $line);
    if (array_key_exists(0,$parts)) {
        $hyphenCount=substr_count($parts[0], '-');
        echo "Hyphencount : $hyphenCount";
        if (array_key_exists(1,$parts)) {
            $title = substr($parts[1], 0, strpos($parts[1], ']'));
            echo " Title : $title";
        }
        else {
            echo "No part1 found";
        }
    }
    else {
        echo "No part0 found";
    }
    



//     echo str_repeat('#', $hyphenCount / 2) . ' ' . $title;
}

// echo "Done!\n";
