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
    $hash = hash("sha256", $data);
    if (empty($this)) return self::submit($hash);
    else return $this->submit($hash);
  }

  function submit(string $hash) {
    if (empty($this)) $urlBase = self::pickupServer();
    else $urlBase = $this->serverBaseUrl;

    $options = [
      'http' => [
        'header' => "Content-Type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode(['hashes' => [$hash]])
      ]
    ];

    return json_decode(
      file_get_contents(
        $urlBase . '/hashes', false, stream_context_create($options)
      ),
      true
    );
  }

  function getProof(string $hashIdNode) {
    if (empty($this)) $baseUrl = self::pickupServer();
    else $baseUrl = $this->serverBaseUrl;

    return json_decode(file_get_contents($baseUrl . '/proofs/' . $hashIdNode), true);
  }

  function verify(string $proof) {
    if (empty($this)) $urlBase = self::pickupServer();
    else $urlBase = $this->serverBaseUrl;

    $options = [
      'http' => [
        'header' => "Content-Type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode(['proofs' => [$proof]])
      ]
    ];

    return json_decode(
      file_get_contents(
        $urlBase . '/verify', false, stream_context_create($options)
      ),
      true
    );
  }
}
