<?php

declare(strict_types=1);

namespace App\Presentation\Backend;

use App\Core\User\UserAccess;
use App\Presentation\Accessory\RequireLogged;
use App\Presentation\Backend\Accessory\Menu\SidebarBuilder;
use App\Presentation\Backend\Accessory\Menu\SidebarItem;
use App\Presentation\BasePresenter;
use Nette\DI\Attributes\Inject;


/**
 * @property BackendTemplate $template
 */
class BackendPresenter extends BasePresenter
{
	use RequireLogged;

	#[Inject]
	public UserAccess $userAccess;


	protected function beforeRender(): void
	{
		parent::beforeRender();
		$this->template->userAccess = $this->userAccess;
		$this->template->sidebarMenu = $this->getSidebarMenuStructure();
	}


	/** @return array<string, SidebarItem[]> */
	private function getSidebarMenuStructure(): array
	{
		$builder = new SidebarBuilder;

		$builder->addSection('System')
			->addItem('Dashboard', 'Admin:')
			->setIcon('fa-solid fa-mug-hot bell')

			->addItem('Settings', 'Settings:')
			->setIcon('fa-solid fa-globe bell')

			->addItem('Permissions', 'Permission:*')
			->setIcon('fa-solid fa-gear bell')
			->setAllowAny('Backend:Permission', 'roles-read', 'users-read')
			->addSubItem('Roles', 'Permission:roles', ['Backend:Permission', 'roles-read'])
			->addSubItem('Users roles', 'Permission:users', ['Backend:Permission', 'users-read']);

		return $builder->build();
	}
}
