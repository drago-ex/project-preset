<?php

declare(strict_types=1);

namespace App\UI\Backend;

use App\Core\Menu\SidebarBuilder;
use App\Core\Menu\SidebarItem;
use App\Core\User\UserAccess;
use App\UI\BasePresenter;
use App\UI\Sign\RequireLogged;
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


	/**
	 * Generates the sidebar menu structure.
	 * @return array<string, SidebarItem[]>
	 */
	private function getSidebarMenuStructure(): array
	{
		$builder = new SidebarBuilder;

		// Sections are optional and serve as titles/separators
		$builder->addSection('System')
			// Simple link with icon
			->addItem('Dashboard', 'Admin:')
			->setIcon('fa-solid fa-mug-hot bell')

			->addItem('Settings', 'Settings:')
			->setIcon('fa-solid fa-globe bell')

			// Complex item with permissions and submenu
			->addItem('Permissions', 'Permission:*')
			->setIcon('fa-solid fa-gear bell')
			->setAllowAny('Backend:Permission', 'roles-read', 'users-read')
			->addSubItem('Roles', 'Permission:roles', ['Backend:Permission', 'roles-read'])
			->addSubItem('Users roles', 'Permission:users', ['Backend:Permission', 'users-read']);

		return $builder->build();
	}
}
