<?php
// Define the header row of the table
$header_row = "| Tasks |Skills  | High Level Objective |\n|-------|-------|----------------------|";

// Initialize an empty array to store the rows of the table
$rows = array();

// Loop through all the task-* folders
foreach (glob("task-*") as $task_folder) {
    // Read the contents of the ReadMe.md file
    $file_contents = file_get_contents("$task_folder/ReadMe.md");

    // Extract the high level objectives using a regular expression
    $pattern_for_objectives = '/\*\*High Level Objectives\*\*(.*?)\*\*Skills\*\*/s';
    if (preg_match($pattern_for_objectives, $file_contents, $matches_for_objectives)) {
        # var_dump($matches_for_objectives);
        echo "\nfound obj";
        $matched_lines_between_pattern_for_objectives = explode("\n", $matches_for_objectives[1]);
        // Store the high level objectives as a list item
//         print_r($matched_lines_between_pattern_for_objectives);
        $objectives = '';
        foreach ($matched_lines_between_pattern_for_objectives as $line) {
            $line = trim($line);
            $line = str_replace('- ', '', $line);
            if (!empty($line)) {
                // Add the line to the objectives string with a comma separator
                $objectives .= ($objectives ? ', ' : '') . $line;
            }
        }
//         print($objectives);
//         $high_level_objective = trim(implode("<br>", $matched_lines_between_pattern_for_objectives),"<br>");
//         print_r(trim($high_level_objective,"<br>"));
    } else {
        echo "\nNo matches found.";
    }
    // print_r($matched_lines_between_pattern_for_objectives);
    // Extract Keywords using a regular expression
    $patter_for_skills= '/\*\*Skills\*\*(.*?)\*\*Version Stack\*\*/s';
    if (preg_match($patter_for_skills, $file_contents, $matches_for_keywords)) {
        echo "found keywords";
        $lines_between_pattern_for_keywords = explode("\n", $matches_for_keywords[1]);
        $skills = '';
        foreach ($lines_between_pattern_for_keywords as $line) {
            $line = trim($line);
            $line = str_replace('- ', '', $line);
            if (!empty($line)) {
                // Add the line to the objectives string with a comma separator
                $skills .= ($skills ? ', ' : '') . $line;
            }
        }
        print_r($skills);
//         $keywords = trim(implode("<br>", $lines_between_pattern_for_keywords),"<br>");
    } else {
        echo "No matches found.";
    }    


    // Get the task name from the folder name
    $task_name = basename($task_folder);
    $task_name = substr($task_name,0,8);

    // Create a row of the table
    $row = "| [$task_name]($task_folder) | $skills  | $objectives |";

    // Add the row to the array of rows
    array_push($rows, $row);
}

// Combine the header row and the rows array into a single string
$table = $header_row . "\n" . implode("\n", $rows);

// Print the table
echo $table;
file_put_contents("ReadMe.md", $table);

# https://github.com/nvuillam/markdown-table-formatter
# npm install markdown-table-formatter -g
exec('markdown-table-formatter');

?>
