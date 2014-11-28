<?php

require_once('ListLexer.php');
require_once('token.php');
//require_once('storage.php');

/*
 *  GET URL FILE
 */
if (empty($argv[1])){
    die ("URL is needed\n");
} else {
    $url = $argv[1];
}
/*
 *  GET FILE
 */

/*
$read = fopen($url, "r") or die("unable to read file\n");
$Data = fread($read, filesize($url));
fclose($read);
*/

$file = file_get_contents($url);
/*
$lexer = new ListLexer(($file));
$token = $lexer->nextToken();
*/

$input = '#ttt Alias #Alias Alias# < <ss <#';
$lexer = new ListLexer($file);
$token = $lexer->nextToken();

$result = array(); // La variable qui va rassembler tous les résultats des token

while($token->type != Lexer::EOF_TYPE) {
    //echo $token . "\n";
    $result[] = $token; // L'opérateur [] lié à un tableau permet de rajouter une "stack" à un tableau
    $token = $lexer->nextToken();
}

$File = $lexer->getFileParsing();
//print_r($file);
?>
