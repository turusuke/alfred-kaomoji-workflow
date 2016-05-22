<?php

require_once __DIR__.'/lib/goutte.phar';
require_once __DIR__.'/lib/workflows.php';

$w = new Workflows();

use Goutte\Client;
$client = new Client();

function getURL($query){
    global $client;

    $query = htmlspecialchars($query ,ENT_QUOTES, 'UTF-8');

    $crawler = $client->request('GET', 'http://kaomojiya.jp/keyword/'.urlencode($query).'/');

    $obj = $crawler->filter('.detailArea ul')->each(function($node){
        $ver  = $node->filter('li.whiteArea')->text();
        return $ver;
    });

    return $obj;
}

$obj = getURL($query);

foreach ($obj as $result) {
    $result = str_replace("`", "\`", $result);
    $w->result( $result, $result, $result, $result, "");
}

echo $w->toxml();

?>