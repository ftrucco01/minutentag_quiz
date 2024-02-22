<?php
class LetterCounter {
    /**
     * Counts how many times each letter appears in the input string.
     * Returns a string representation showing the count as asterisks, maintaining the original letter order.
     *
     * @param string $input The string to count letters from.
     * @return string The formatted string showing letter counts as asterisks, in order of appearance.
     */
    public static function CountLettersAsString(string $input): string 
    {
        // Convert the string to lowercase to ensure consistent counting
        $lowercaseInput = strtolower($input);
        // Initialize an array to keep track of letter counts
        $letterCounts = [];
        // Initialize an array to remember the order of letters as they appear
        $orderOfLetters = [];
        // Initialize the result string
        $resultString = '';

        // Iterate over each character in the string
        foreach (str_split($lowercaseInput) as $char) {
            // Check if the character is a letter
            if (ctype_alpha($char)) {
                // Increment the letter's count and record the letter's order
                if (!isset($letterCounts[$char])) {
                    $letterCounts[$char] = 1;

                    // Record this letter's appearance order
                    $orderOfLetters[] = $char;
                } else {
                    $letterCounts[$char]++;
                }
            }
        }

        // Build the result string based on the original order
        foreach ($orderOfLetters as $letter) {
            $resultString .= $letter . ':' . str_repeat('*', $letterCounts[$letter]) . ',';
        }

        // Remove the trailing comma
        $resultString = rtrim($resultString, ',');

        return $resultString;
    }
}

/**
 * Showcases
 */
//out: i:**,n:*,t:*,e:**,r:*,v:*,w:*
echo LetterCounter::CountLettersAsString("Interview") . "\n";

//out: p:*,r:**,o:*,g:**,a:*,m:**,i:*,n:*
echo LetterCounter::CountLettersAsString("Programming") . "\n";

//out: m:*,i:****,s:****,p:**
echo LetterCounter::CountLettersAsString("Mississippi");

?>