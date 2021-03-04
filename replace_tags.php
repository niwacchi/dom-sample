<?php
$source = <<<EOD
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>niwacchi.net</title>
    <link rel="shortcut icon" href="ico/favicon.ico" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
    <style type="text/css">
      body{text-align: center;}
      .jumbotron { text-align:center; }
      .container-narrow { text-align:center; }
      .content-title { text-align:center; }
      .content { text-align:center;padding:5px; }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container-narrow">
      <div class="jumbotron"><h1>niwacchi.net</h1></div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="content">
            <a href="https://niwacchi.hatenablog.com" class="btn btn-default btn-block">Hatena Blog</a>
          </div>
        </div>
      </div>  
      <div class="row">
        <div class="col-xs-12">
          <div class="content">
            <a href="https://twitter.com/niwacchi" class="btn btn-default btn-block">Twitter</a> 
          </div>
        </div>
      </div>  
      <div class="row">
        <div class="col-xs-12">
          <div class="content">
            <a href="http://twilog.org/niwacchi" class="btn btn-default btn-block">Twilog</a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="content">
            <a href="https://github.com/niwacchi" class="btn btn-default btn-block">Github</a>
          </div>
        </div>
      </div>  
      <div class="row" style="display:none">
        <div class="col-xs-12">
          <div class="content">
            <a href="http://niwacchi.net:3000/login" class="btn btn-default btn-block">Wiki</a>
          </div>
        </div>
      </div>
    </div>
    <div style="margin-top:20px;">&copy;2018 niwacchi</div>

    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
EOD;

//echo $source;
$document = new DOMDocument();
$document->loadHTML($source);

$htmlString = '';
$bodyNodeList = $document->getElementsByTagName('body');
foreach ($bodyNodeList as $bodyNode) {
    replaceTags($bodyNode, $document);
}

$htmlString = $document->saveHTML();

echo $htmlString;

/**
 * 
 */
function replaceTags($node, $document) {
    if ($node->childNodes !== null) {
        for ($i = 0; $i < $node->childNodes->length; $i++) {
            $item = $node->childNodes->item($i);
            if ($item->nodeName === 'div') {
                $newElement = $document->createElement('amp-div', $item->nodeValue);
                $node->replaceChild($newElement, $item);
            }

            if ($item->childNodes !== null) {
                for ($j = 0; $j < $item->childNodes->length; $j++) {
                    $childItem = $item->childNodes->item($j);
                    replaceTags($childItem, $document);
                }
            }
        }
    }
}
