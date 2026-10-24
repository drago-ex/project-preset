<?php

declare(strict_types=1);

namespace App\Presentation;

use App\Core\Settings\Settings;
use Drago\Application\UI\ExtraTemplate;


abstract class BaseTemplate extends ExtraTemplate
{
	public string $lang;
	public Settings $settings;

	/** @var array<string, string> static pages of the front menu, slug => title */
	public array $menuPages = [];
}
