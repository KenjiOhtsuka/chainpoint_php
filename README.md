# Chainpoint library in PHP

This is PHP package for request to Chainpoint.
For Chainpoint, look at [Chainpoint Node HTTP API](https://github.com/chainpoint/chainpoint-node/wiki/Node-HTTP-API).

[Composer Package](https://packagist.org/packages/kenji-otsuka/chainpoint)

## How to Use

First, write `use` statement.

```php
use KenjiOtsuka\Chainpoint;
```

### Create Instance

```php
$c = new Chainpoint();
```

### Submit Hash

Post sha256 hash.

```php
$c->submit('0xXXXXXX...');
```

Or post text, which is internally converted to hash.

```php
$c->submitData("text");
```

### Get Proof

Get hash id node from `submit` result and post it.
This method execution may have to be called for the same `Chainpoint` instanece
as `submit` called for.

```php
$c->getProof($hashIdNode);
```

### Verify

Verify with proof, which is get from above request, `getProof`, result.

```php
// 2 ways are available.
$c->verify($proof);
Chainpoint::verify($proof);
```

## Other

* Ruby [gem](https://rubygems.org/gems/chainpoint) and its [GitHub repository](https://github.com/KenjiOhtsuka/chainpoint_gem).
