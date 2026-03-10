<?php

declare(strict_types=1);

namespace Adeliom\EasyCommonBundle\Event;

use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class LegacyEventDispatcher
{
    private const DEPRECATION_VERSION = '3.1';

    public static function dispatch(object $event, EventDispatcherInterface $eventDispatcher, string $packageName, string $legacyEventName): object
    {
        $event = $eventDispatcher->dispatch($event);

        if (!self::shouldDispatchLegacyEvent($eventDispatcher, $legacyEventName)) {
            return $event;
        }

        \trigger_deprecation(
            $packageName,
            self::DEPRECATION_VERSION,
            'Listening to the legacy "%s" event name is deprecated; listen to "%s" instead.',
            $legacyEventName,
            $event::class
        );

        return $eventDispatcher->dispatch(clone $event, $legacyEventName);
    }

    public static function dispatchGenericEvent(
        object $event,
        EventDispatcherInterface $eventDispatcher,
        string $packageName,
        string $legacyEventName,
        callable $legacyEventFactory,
        callable $legacyEventSynchronizer
    ): object {
        $event = $eventDispatcher->dispatch($event);

        if (!self::shouldDispatchLegacyEvent($eventDispatcher, $legacyEventName)) {
            return $event;
        }

        \trigger_deprecation(
            $packageName,
            self::DEPRECATION_VERSION,
            'Listening to the legacy "%s" GenericEvent is deprecated; listen to "%s" instead.',
            $legacyEventName,
            $event::class
        );

        $legacyEvent = $legacyEventFactory($event);
        $eventDispatcher->dispatch($legacyEvent, $legacyEventName);
        $legacyEventSynchronizer($event, $legacyEvent);

        return $event;
    }

    private static function shouldDispatchLegacyEvent(EventDispatcherInterface $eventDispatcher, string $legacyEventName): bool
    {
        if (!method_exists($eventDispatcher, 'hasListeners')) {
            return true;
        }

        return $eventDispatcher->hasListeners($legacyEventName);
    }
}
