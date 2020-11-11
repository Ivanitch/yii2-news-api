<?php

namespace core\repositories\News;

use core\entities\News\News;
use core\repositories\NotFoundException;

class NewsRepository
{
    public function get($id): News
    {
        if (!$news = News::findOne($id)) {
            throw new NotFoundException('News is not found.');
        }
        return $news;
    }

    /**
     * @param News $news
     */
    public function save(News $news): void
    {
        if (!$news->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param News $news
     */
    public function remove(News $news): void
    {
        if (!$news->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function existsByMainCategory($id): bool
    {
        return News::find()->andWhere(['category_id' => $id])->exists();
    }
}
