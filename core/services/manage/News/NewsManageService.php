<?php

namespace core\services\manage\News;

use core\entities\Meta;
use core\entities\News\News;
use core\forms\manage\News\News\NewsCreateForm;
use core\forms\manage\News\News\NewsEditForm;
use core\repositories\News\CategoryRepository;
use core\repositories\News\NewsRepository;
use yii\helpers\Inflector;

class NewsManageService
{
    private $news;
    private $categories;

    public function __construct(
        NewsRepository $news,
        CategoryRepository $categories
    )
    {
        $this->news = $news;
        $this->categories = $categories;
    }

    public function create(NewsCreateForm $form): News
    {
        $category = $this->categories->get($form->categories->main);
        $model = News::create(
            $category->id,
            $form->name,
            $form->title,
            $form->content,
            $form->slug ?: Inflector::slug($form->name),
            new Meta(
                $form->meta->title,
                $form->meta->keywords,
                $form->meta->description
            )
        );

        $this->news->save($model);
        return $model;
    }

    public function edit($id, NewsEditForm $form): void
    {
        $model = $this->news->get($id);
        $category = $this->categories->get($form->categories->main);
        $model->edit(
            $form->name,
            $form->title,
            $form->content,
            $form->slug ?: Inflector::slug($form->name),
            new Meta(
                $form->meta->title,
                $form->meta->keywords,
                $form->meta->description
            )
        );

        $model->changeMainCategory($category->id);
        $this->news->save($model);
    }

    public function activate($id): void
    {
        $model = $this->news->get($id);
        $model->activate();
        $this->news->save($model);
    }

    public function draft($id): void
    {
        $model = $this->news->get($id);
        $model->draft();
        $this->news->save($model);
    }

    public function remove($id): void
    {
        $model = $this->news->get($id);
        $this->news->remove($model);
    }
}
