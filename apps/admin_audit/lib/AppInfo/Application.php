<?php

declare(strict_types=1);

/**
 * @copyright Copyright (c) 2017 Joas Schilling <coding@schilljs.com>
 *
 * @author Arthur Schiwon <blizzz@arthur-schiwon.de>
 * @author Bjoern Schiessle <bjoern@schiessle.org>
 * @author Christoph Wurst <christoph@winzerhof-wurst.at>
 * @author GrayFix <grayfix@gmail.com>
 * @author Joas Schilling <coding@schilljs.com>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Roeland Jago Douma <roeland@famdouma.nl>
 * @author Tiago Flores <tiago.flores@yahoo.com.br>
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
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\AdminAudit\AppInfo;

use OC\Files\Filesystem;
use OC\Files\Node\File;
use OC\Group\Manager;
use OC\User\Session;
use OCA\AdminAudit\Actions\AppManagement;
use OCA\AdminAudit\Actions\Auth;
use OCA\AdminAudit\Actions\Console;
use OCA\AdminAudit\Actions\Files;
use OCA\AdminAudit\Actions\GroupManagement;
use OCA\AdminAudit\Actions\Security;
use OCA\AdminAudit\Actions\Sharing;
use OCA\AdminAudit\Actions\Trashbin;
use OCA\AdminAudit\Actions\UserManagement;
use OCA\AdminAudit\Actions\Versions;
use OCP\App\ManagerEvent;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\Authentication\TwoFactorAuth\IProvider;
use OCP\Console\ConsoleEvent;
use OCP\IGroupManager;
use OCP\ILogger;
use OCP\IPreview;
use OCP\IUserSession;
use OCP\Share;
use OCP\Util;
use Symfony\Component\EventDispatcher\GenericEvent;

class Application extends App implements IBootstrap {

	/** @var ILogger */
	protected $logger;

	public function __construct() {
		parent::__construct('admin_audit');
	}

	public function register(IRegistrationContext $context): void {
		$context->registerEventListener('a', 'b');
	}

	public function boot(IBootContext $context): void {
		// TODO: Implement boot() method.
	}
}
