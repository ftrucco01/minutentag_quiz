1) Please, fully explain this function: document iterations, conditionals, and the function objective as a whole
<?php
function($p, $o, $ext) {
    $items = [];
    $sp = false;
    $cd = false;

    $ext_p = [];

    foreach ($ext as $i => $e) {
      $ext_p[$e['price']['id']] = $e['qty'];
    }

    foreach ($o['items']['data'] as $i => $item) {
      $product = [
        'id': $item['id']
      ];

      if isset($ext_p[$item['price']['id']]) {
          $qty = $ext_p[$item['price']['id']];
          if ($qty < 1) {
              $product['deleted'] = true;
          } else {
              $product['qty'] = $qty;
          }
          unset($ext_p[$item['price']['id']]);
      } else if ($item['price']['id'] == $p['id']) {
          $sp = true;
      } else {
          $product['deleted'] = true
          $cd = true
      }
      
      $items[] = $product;
    }
    
    if (!$sp) {
      $items[] = [
        'id': $p['id'],
        'qty': 1
      ];
    }
    
    foreach ($ext_p as $i => $details) {
      if ($details['qty'] < 1) {
          continue;
      }

      $items[] = [
        'id': $details['price'],
        'qty': $details['qty']
      ];
    }
    
    return $items;
?>

2) Write a class "LetterCounter" and implement a static method "CountLettersAsString" which receives a string parameter and returns a string that shows how many times each letter shows up in the string by using an asterisk (*).
Example: "Interview" -> "i:**,n:*,t:*,e:**,r:*,v:*,w:*"

3) Write a method that triggers a request to http://date.jsontest.com/, parses the json response and prints out the current date in a readable format as follows: Monday 14th of August, 2023 - 06:47 PM

4) Write a method that triggers a request to http://echo.jsontest.com/john/yes/tomas/no/belen/yes/peter/no/julie/no/gabriela/no/messi/no, parse the json response.
Using that data print two columns of data. The left column should contain the names of the persons that responses 'no',
and the right column should contain the names that responded 'yes'