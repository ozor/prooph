<?php

declare(strict_types=1);

namespace App\Basket\Model\Event;

use App\Basket\Model\Basket\BasketId;
use App\Basket\Model\Basket\ShoppingSession;
use Prooph\EventSourcing\AggregateChanged;

final class ShoppingSessionStarted extends AggregateChanged
{
    public function basketId(): BasketId
    {
        //Note: Internally, we work with scalar types, but the getter returns the value object
        return BasketId::fromString($this->aggregateId());
    }

    public function shoppingSession(): ShoppingSession
    {
        //Same here, return domain specific value object
        return ShoppingSession::fromString($this->payload['shopping_session']);
    }
}