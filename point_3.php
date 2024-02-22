<?php
/**
 * Prints the current date and time.
 * This function fetches the current date and time from an external API (http://date.jsontest.com/)
 * using cURL, parses the JSON response, and prints the date and time in a specific format.
 */
function printCurrentDateTime() {
    // Initialize cURL session
    $curl = curl_init('http://date.jsontest.com/');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);

    // Execute cURL session and capture the response
    $response = curl_exec($curl);

    // Close cURL session
    curl_close($curl);

    // Check if the response was received successfully
    if ($response) {
        // Decode the JSON response
        $data = json_decode($response, true);

        // Parse the date and time
        if ($data && isset($data['date']) && isset($data['time'])) {
            $date = DateTime::createFromFormat('m-d-Y H:i:s A', $data['date'] . ' ' . $data['time']);
            if ($date) {
                // Print out the date in the specified format
                echo $date->format('l jS \of F, Y - h:i A') . "\n";
            } else {
                echo "Failed to parse date and time.\n";
            }
        } else {
            echo "Invalid response format.\n";
        }
    } else {
        echo "Failed to retrieve data.\n";
    }
}

/**
 * Showcase:
 *  1. Call the function today 22/02/2024 at 09:11 PM
 *  2. out: Thursday 22nd of February, 2024 - 09:11 PM
 */
printCurrentDateTime();

?>