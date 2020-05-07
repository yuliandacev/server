<?php

declare(strict_types=1);

/**
 * @copyright 2020 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @author 2020 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace OC\AppFramework\Bootstrap;

use OC_App;
use OCP\App\AppPathNotFoundException;
use OCP\App\IAppManager;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\ILogger;
use function class_exists;
use function class_implements;
use function contains;
use function in_array;

class Coordinator {

	/** @var IAppManager */
	private $appManager;

	/** @var ILogger */
	private $logger;

	public function __construct(IAppManager $appManager,
								ILogger $logger) {
		$this->appManager = $appManager;
		$this->logger = $logger;
	}

	public function runRegistration(): void {
		$context = new RegistrationContext();
		$appIds = $this->appManager->getInstalledApps();
		foreach ($appIds as $appId) {
			/*
			 * First, we have to enable the app's autoloader
			 */
			try {
				$path = $this->appManager->getAppPath($appId);
				OC_App::registerAutoloading($appId, $path);
			} catch (AppPathNotFoundException $e) {
				// Ignore
				continue;
			}

			/*
			 * Next we check if there is an application class and it implements
			 * the \OCP\AppFramework\Bootstrap\IBootstrap interface
			 */
			$appNameSpace = App::buildAppNamespace($appId);
			$applicationClassName = $appNameSpace . '\\AppInfo\\Application';
			if (class_exists($applicationClassName) && in_array(IBootstrap::class, class_implements($applicationClassName), true)) {
				/** @var IBootstrap $application */
				$application = \OC::$server->query($applicationClassName);
				$application->register($context);
			}
		}
	}

	public function bootApps(): void {

	}

}
