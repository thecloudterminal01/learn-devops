<?php

function createTree($dir) {
    $tree = "<ul>\n";

    $dirs = array_filter(glob($dir . '/*'), 'is_dir');
    sort($dirs);

    foreach ($dirs as $d) {
        $dirName = basename($d);

        // Exclude directories that match the pattern task-*
        if (preg_match('/^task-/', $dirName)) {
            continue;
        }

        $link = strtolower($dirName);

        $tree .= "<li><a href=\"#$link\">$dirName</a>";

        if (!empty(glob("$d/*"))) {
            $tree .= createTree($d);
        }

        $tree .= "</li>\n";
    }

    $tree .= "</ul>\n";

    return $tree;
}

$tree = createTree("home");

$content = "# Home\n$tree";

file_put_contents("README.md", $content);

echo "Done!\n";
