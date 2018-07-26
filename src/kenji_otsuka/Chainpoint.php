<?php

namespace KenjiOtsuka;

class Chainpoint {
  var $serverBaseUrl = '';

  const LIST = [
    "https://a.chainpoint.org/nodes/random",
    "https://b.chainpoint.org/nodes/random",
    "https://c.chainpoint.org/nodes/random"
  ];

  static function pickupServer() {
    $index = rand(0, count(self::LIST) - 1);
    $json = json_decode(file_get_contents(self::LIST[$index]), true);
    return $json[rand(0, count($json) - 1)]['public_uri'];
  }

  function __construct() {
    $this->serverBaseUrl = self::pickupServer();
  }

  function submitData($data) {

  }

  function submit(string $hash) {
    if (empty($this)) $baseUrl = self::pickupServer();
    else $baseUrl = $serverBaseUrl;

    $data = ['hashes' => [$hash]];
    $content = http_build_query($data);
    $options = [
      'http' => [
        'header' => 'Content-type: application/json',
        'method' => 'POST',
        'content' => $content
      ]
    ];
    return json_decode(file_get_contents(
      $urlBase + '/hashes', true, stream_context_create($options)));
  }

  function getProof(string $hashIdNode) {
    if (empty($this)) $baseUrl = self::pickupServer();
    else $baseUrl = $serverBaseUrl;

  }

  function verify(string $proof) {
    if (empty($this)) $baseUrl = self::pickupServer();
    else $baseUrl = $serverBaseUrl;

  }
}

$c = new Chainpoint();
$c->a();
echo $c->pickupServer();
