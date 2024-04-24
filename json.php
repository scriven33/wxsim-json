<?php

function convert_csv_to_json($csv_filename) {
    $csv_path = dirname(__FILE__) . '/' . $csv_filename;
    $csv_file = fopen($csv_path, 'r');
    if ($csv_file !== false) {
        // Read the headers from the first line
        $headers = fgetcsv($csv_file);

        // Initialize an array to store the data
        $data = array();

        // Read each line of the CSV file until the end
        while (($line = fgetcsv($csv_file)) !== false) {
            // Combine the headers with the current line as key-value pairs
            $row = array();
            foreach ($headers as $index => $header) {
                // Trim the header to remove leading and trailing spaces
                $header = trim($header);
                $row[$header] = trim($line[$index]) ?? null;
            }

            // Append the row to the data array
            $data[] = $row;
        }

        // Close the file
        fclose($csv_file);

        // Convert the data array to JSON
        $json_data = json_encode($data, JSON_PRETTY_PRINT);

        return $json_data;
    } else {
        return null;
    }
}

// Example usage:
$csv_filename = "latest.csv";
$json_data = convert_csv_to_json($csv_filename);
if ($json_data !== null) {
    echo $json_data;
} else {
    echo "Failed to fetch CSV data.";
}
?>
