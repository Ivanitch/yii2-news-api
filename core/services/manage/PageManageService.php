<?php

namespace core\services\manage;

use core\entities\Meta;
use core\entities\Page;
use core\forms\manage\PageForm;
use core\repositories\PageRepository;
use yii\helpers\Inflector;

class PageManageService
{
    private $repository;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(PageForm $form): Page
    {
        $parent = $this->repository->get($form->parentId);
        $page = Page::create(
            $form->title,
            $form->slug ?: Inflector::slug($form->title),
            $form->content,
            new Meta(
                $form->meta->title,
                $form->meta->keywords,
                $form->meta->description
            )
        );
        $page->appendTo($parent);
        $this->repository->save($page);
        return $page;
    }

    public function edit($id, PageForm $form): void
    {
        $page = $this->repository->get($id);
        $this->assertIsNotRoot($page);
        $page->edit(
            $form->title,
            $form->slug ?: Inflector::slug($form->title),
            $form->content,
            new Meta(
                $form->meta->title,
                $form->meta->keywords,
                $form->meta->description
            )
        );
        if ($form->parentId !== $page->parent->id) {
            $parent = $this->repository->get($form->parentId);
            $page->appendTo($parent);
        }
        $this->repository->save($page);
    }

    public function moveUp($id): void
    {
        $page = $this->repository->get($id);
        $this->assertIsNotRoot($page);
        if ($prev = $page->prev) {
            $page->insertBefore($prev);
        }
        $this->repository->save($page);
    }

    public function moveDown($id): void
    {
        $page = $this->repository->get($id);
        $this->assertIsNotRoot($page);
        if ($next = $page->next) {
            $page->insertAfter($next);
        }
        $this->repository->save($page);
    }

    public function remove($id): void
    {
        $page = $this->repository->get($id);
        $this->assertIsNotRoot($page);
        $this->repository->remove($page);
    }

    private function assertIsNotRoot(Page $page): void
    {
        if ($page->isRoot()) {
            throw new \DomainException('Unable to manage the root page.');
        }
    }
}