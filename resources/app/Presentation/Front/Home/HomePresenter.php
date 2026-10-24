<?php

declare(strict_types=1);

namespace App\Presentation\Front\Home;

use App\Model\Blog\ArticleAuthors;
use App\Model\Blog\ArticleRepository;
use App\Model\Blog\CategoryEntity;
use App\Model\Blog\CategoryRepository;
use App\Presentation\BasePresenter;
use Drago\Attr\AttributeDetectionException;


/** @property-read HomeTemplate $template */
final class HomePresenter extends BasePresenter
{
	/** How many of the latest articles the home page shows: the newest over the whole row and two rows of three cards. */
	private const int LatestArticles = 7;


	public function __construct(
		private readonly ArticleRepository $articleRepository,
		private readonly ArticleAuthors $articleAuthors,
		private readonly CategoryRepository $categoryRepository,
	) {
		parent::__construct();
	}


	/** @throws AttributeDetectionException */
	public function renderDefault(): void
	{
		$this->template->articles = $articles = $this->articleRepository
			->getPublishedArticles()
			->limit(self::LatestArticles)
			->recordAll();

		$this->template->authors = $this->articleAuthors->forArticles($articles);
		$this->template->categories = array_column($this->categoryRepository->getUsedCategories(), null, CategoryEntity::PrimaryKey);
	}
}
