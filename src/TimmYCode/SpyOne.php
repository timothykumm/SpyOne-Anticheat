<?php

namespace TimmYCode;

use TimmYCode\Event\CallCustomEvents;
use TimmYCode\Event\ModuleEventListener;
use TimmYCode\Event\WatchEventListener;
use pocketmine\plugin\PluginBase;

class SpyOne extends PluginBase
{

	const PREFIX = "§0[§bSpy§fOne§0]§b ";
	private static self $instance;

	public function onEnable(): void
	{
		self::$instance = $this;
		$this->getServer()->getPluginManager()->registerEvents(new ModuleEventListener(), $this);
		$this->getServer()->getPluginManager()->registerEvents(new WatchEventListener(), $this);
		$this->getServer()->getPluginManager()->registerEvents(new CallCustomEvents(), $this);
		//$this->getScheduler()->scheduleRepeatingTask(new PunishTask(), 20);
	}

	public static function getInstance(): self {
		return self::$instance;
	}

}
