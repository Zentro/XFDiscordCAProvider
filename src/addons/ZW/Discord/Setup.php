<?php

namespace ZW\Discord;

use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	public function install(array $stepParams = [])
	{
		$this->db()->insert('xf_connected_account_provider', [
			'provider_id' => 'discord',
			'provider_class' => 'ZW\Discord:Provider\Discord',
			'display_order' => 100,
			'options' => ''
		], true);		
	}

	public function uninstall(array $stepParams = [])
	{
		$this->db()->delete('xf_connected_account_provider', 'provider_class = ?', 'ZW\Discord:Provider\Discord');
	}
}