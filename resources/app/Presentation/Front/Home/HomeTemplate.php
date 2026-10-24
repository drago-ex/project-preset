<?php

declare(strict_types=1);

namespace App\Presentation\Front\Home;

use App\Model\Blog\ArticleEntity;
use App\Model\Blog\CategoryEntity;
use App\Presentation\BaseTemplate;


class HomeTemplate extends BaseTemplate
{
	/** @var ArticleEntity[] the latest published articles */
	public array $articles;

	/** @var array<int, array{name: string, avatar: string}> their authors by the user id */
	public array $authors = [];

	/** @var array<int, CategoryEntity> categories with a published article, by id */
	public array $categories = [];
}
