<?php

declare(strict_types=1);

namespace App\Presentation\Front\Home;

use App\Model\Blog\ArticleRepository;
use App\Presentation\BasePresenter;
use Drago\Attr\AttributeDetectionException;


/** @property-read HomeTemplate $template */
final class HomePresenter extends BasePresenter
{
	/** How many of the latest articles the home page shows. */
	private const int LatestArticles = 6;


	public function __construct(
		private readonly ArticleRepository $articleRepository,
	) {
		parent::__construct();
	}


	/** @throws AttributeDetectionException */
	public function renderDefault(): void
	{
		$this->template->articles = $this->articleRepository
			->getPublishedArticles()
			->limit(self::LatestArticles)
			->recordAll();
	}
}
