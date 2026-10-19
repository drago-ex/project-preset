<?php

declare(strict_types=1);

namespace App\Presentation;

use App\Core\Settings\SettingsRequire;
use Drago\Datagrid\DataGrid;
use Drago\Localization\TranslatorAdapter;
use Drago\Permission\Authorization;
use Nette\Application\UI\Presenter;


/** @property-read BaseTemplate $template */
abstract class BasePresenter extends Presenter
{
	use TranslatorAdapter;
	use Authorization;
	use SettingsRequire;

	/** Sorting, filtering and paging a grid only reads, so it is checked as "{component}-read". */
	protected function isReadOnlySignal(string $receiver, string $name): bool
	{
		return DataGrid::isReadOnlySignal($receiver, $name);
	}
}
