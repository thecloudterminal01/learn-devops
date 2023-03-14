<?php
// Define the header row of the table
$header_row = "| S.No | Stack | Tasks | High Level Objective |\n|------|-------|-------|----------------------|";

// Initialize an empty array to store the rows of the table
$rows = array();

// Loop through all the task-* folders
foreach (glob("task-*") as $task_folder) {
    // Read the contents of the ReadMe.md file
    $file_contents = file_get_contents("$task_folder/ReadMe.md");

    // Extract the high level objectives using a regular expression
    $pattern = '/\*\*High Level Objectives\*\*(.*?)\*\*Keywords\*\*/s';
    preg_match($pattern, $file_contents, $matches);
    $lines_between_patterns = explode("\n", $matches[1]);

    // Store the high level objectives as a list item
    $high_level_objective = implode("<br>", $lines_between_patterns);

    // Get the task name from the folder name
    $task_name = basename($task_folder);

    // Create a row of the table
    $row = "| ? | ? | [$task_name]($task_folder) | $high_level_objective |";

    // Add the row to the array of rows
    array_push($rows, $row);
}

// Combine the header row and the rows array into a single string
$table = $header_row . "\n" . implode("\n", $rows);

// Print the table
echo $table;
file_put_contents("ReadMe.md", $table);

?>
