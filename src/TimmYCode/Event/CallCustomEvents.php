<?php

namespace TimmYCode\Event;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use TimmYCode\Event\Custom\ContainerCloseEvent;
use TimmYCode\Event\Custom\ContainerOpenEvent;
use TimmYCode\SpyOne;
use TimmYCode\Utils\PlayerUtil;

class CallCustomEvents implements Listener
{

	public function sentPackagesListener(DataPacketSendEvent $event) {
		foreach ($event->getPackets() as $packet) {

			if(str_ends_with(get_class($packet), "ContainerOpenPacket")) {

				foreach ($event->getTargets() as $target) {
					$ev = new ContainerOpenEvent($target->getPlayer(), PlayerUtil::getPosition($target->getPlayer()));
					$ev->call();
					return !$ev->isCancelled();
				}
			}

			if(str_ends_with(get_class($packet), "ContainerClosePacket")) {
				foreach ($event->getTargets() as $target) {
					$ev = new ContainerCloseEvent($target->getPlayer(), PlayerUtil::getPosition($target->getPlayer()));
					$ev->call();
					return !$ev->isCancelled();
				}
			}

			/*if(!str_ends_with(get_class($packet), "TextPacket")) {
			SpyOne::getInstance()->getServer()->broadcastMessage(get_class($packet));
			}*/
		}
	}

}
