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

// print_r($stringArray);
foreach($stringArray as $line) {
    $hyphenCount=0;
    $line=str_replace(' ', '-', $line);
//     echo $line;
    $parts = explode('[', $line);
    print_r($parts[0]);
    $hyphenCount = substr_count($parts[0], '-');
    echo $hyphenCount;
//     $title = substr($parts[1], 0, strpos($parts[1], ']'));
//     echo str_repeat('#', $hyphenCount / 2) . ' ' . $title;
}

// echo "Done!\n";
