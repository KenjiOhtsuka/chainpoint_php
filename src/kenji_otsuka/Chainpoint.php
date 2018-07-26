<?php

namespace KenjiOtsuka;

class Chainpoint {
  const LIST = [
    "https://a.chainpoint.org/nodes/random",
    "https://b.chainpoint.org/nodes/random",
    "https://c.chainpoint.org/nodes/random"
  ];

  function pickupServer() {
    $index = rand(0, count(self::LIST) - 1);
    $json = json_decode(file_get_contents(self::LIST[$index]), true);
    return $json[rand(0, count($json) - 1)]['public_uri'];
  }

  function submit(string $hash) {

  }

  function getProof(string $hashIdNode) {

  }

  function verify(string $proof) {

  }
}
