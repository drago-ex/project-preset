<?php

declare(strict_types=1);

namespace App\UI;


use App\Core\Settings\Settings;
use Drago\Application\UI\ExtraTemplate;


abstract class BaseTemplate extends ExtraTemplate
{
	public string $lang;
	public Settings $settings;
}
