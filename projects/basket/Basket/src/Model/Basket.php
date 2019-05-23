<?php

declare(strict_types=1);

namespace App\Basket\Model;

use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

final class Basket extends AggregateRoot
{
    public static function startShoppingSession(
        ShoppingSession $shoppingSession,
        BasketId $basketId)
    {
        // Start new aggregate lifecycle by creating an "empty" instance
        $self = new self();

        // Record the very first domain event of the new aggregate
        // Note: we don't pass the value objects directly to the event but use their
        // primitive counterparts. This makes it much easier to work with the events later
        // and we don't need complex serializers when storing events.
        $self->recordThat(ShoppingSessionStarted::occur($basketId->toString(), [
            'shopping_session' => $shoppingSession->toString()
        ]));

        //Return the new aggregate
        return $self;
    }

    protected function aggregateId(): string
    {
        // TODO: Implement aggregateId() method.
    }

    /**
     * Apply given event
     */
    protected function apply(AggregateChanged $event): void
    {
        // TODO: Implement apply() method.
    }
}
