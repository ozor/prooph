<?php

declare(strict_types=1);

namespace App\Basket\Model;

use App\Basket\Model\Event\ShoppingSessionStarted;
use App\Basket\Model\Basket\BasketId;
use App\Basket\Model\Basket\ShoppingSession;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

final class Basket extends AggregateRoot
{
    /**
     * @var BasketId
     */
    private $basketId;

    /**
     * @var ShoppingSession
     */
    private $shoppingSession;

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
        // Return string representation of the globally unique identifier of the aggregate
        return $this->basketId->toString();
    }

    /**
     * Apply given event
     */
    protected function apply(AggregateChanged $event): void
    {
        // A simple switch by event name is the fastest way,
        // but you're free to split things up here and have, for example, methods like
        // private function whenShoppingSessionStarted()
        // To delegate work to them and keep the apply method lean
        switch ($event->messageName()) {
            case ShoppingSessionStarted::class:
                /** @var $event ShoppingSessionStarted */
                $this->basketId = $event->basketId();
                $this->shoppingSession = $event->shoppingSession();
                break;
        }
    }
}
