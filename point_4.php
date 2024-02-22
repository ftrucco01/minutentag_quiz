<?php

/**
 * Function to retrieve names and their responses from an external API,
 * categorize them based on their responses, and print them in two columns.
 * The left column contains names with the response 'no', and the right column
 * contains names with the response 'yes'.
 */
function printNamesByResponse() {
    // Initialize cURL session
    $curl = curl_init('http://echo.jsontest.com/john/yes/tomas/no/belen/yes/peter/no/julie/no/gabriela/no/messi/no');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);

    // Execute cURL session and capture the response
    $response = curl_exec($curl);

    // Close cURL session
    curl_close($curl);

    // Arrays to hold names based on response
    $yesNames = [];
    $noNames = [];

    // Check if the response was received successfully
    if ($response) {
        // Decode the JSON response
        $data = json_decode($response, true);

        // Check and assign names based on their response
        foreach ($data as $name => $response) {
            if ($response == 'yes') {
                $yesNames[] = $name;
            } elseif ($response == 'no') {
                $noNames[] = $name;
            }
        }

        // Determine the longer array to format the output correctly
        $maxRows = max(count($yesNames), count($noNames));
        
        // Print the names in two columns
        echo "No\t\tYes\n";
        echo "-------------------------\n";
        for ($i = 0; $i < $maxRows; $i++) {
            $no = isset($noNames[$i]) ? $noNames[$i] : '';
            $yes = isset($yesNames[$i]) ? $yesNames[$i] : '';
            echo str_pad($no, 16) . $yes . "\n";
        }
    } else {
        echo "Failed to retrieve data.\n";
    }
}

/**
 * Showcase CLI: 
 * $ php point_4.php: 
 * No              Yes
 * -------------------------
 * julie           belen
 * tomas           john
 * gabriela        
 * peter           
 * messi           
 */
printNamesByResponse();
?>