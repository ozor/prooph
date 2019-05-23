<?php
//All prooph components enable strict types
declare(strict_types=1);

namespace Prooph\Tutorial;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

//Require composer's autoloader
require 'vendor/autoload.php';

//Our first message
final class SayHello extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public function to(): string
    {
        return $this->payload['to'];
    }
}

$sayHello = new SayHello(['to' => 'World']);

echo 'Hello ' . $sayHello->to();