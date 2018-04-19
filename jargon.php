<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Jargon dictionary</h2>
  <form action="" method="post">
    <div class="form-group">
      <label for="text">Jargon:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter a Jargon" name="jargon">
    </div>
    
    <button type="submit" class="btn btn-default">Search</button>
  </form>
</div>

<?php
    $jargon = $_POST['jargon'];
    echo $jargon;
?>

<?php
/* set error reporting to 1 or lower to avoid DOM warnings */
error_reporting(1);


class UrbanDictionary{
  function __Construct(){
  }
  function lookupAutocompletions($word){
    /* format word */
    $word = str_replace(' ', '+', $word);
    
    /* fetch autocompletions */
    $autocompletions = file_get_contents('http://api.urbandictionary.com/v0/autocomplete?term=' . $word . '&_=' . time());
    
    /* return results(autocompletions) */
    return $autocompletions;
  }
  function lookupDefinition($word){
    /* format word */
    $word = str_replace(' ','-',$word);

    /* load the page DOM */
    $dom = new DomDocument;
    $dom->loadHTML(file_get_contents('http://urbandictionary.com/define.php?term=' . $word));

    /* find all elements with "definition" class in the DOM using XPath */
    $finder = new DomXPath($dom);
    $className = 'definition';
    $definitionArray = $finder->query("//*[contains(@class, '$className')]");

    /* return the first definition */
    return $definitionArray->item(0)->nodeValue;
  }
  function lookupDefinitions(){
  }
}

//initialize UrbanDictionary API
$urbanDic = new UrbanDictionary();

//get the first definition of a word
$var = $urbanDic->lookupDefinition('Hacker');
echo $var;

?>


</body>
</html>
