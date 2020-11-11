<?php

namespace core\services\manage;

use core\entities\User\User;
use core\forms\manage\User\UserCreateForm;
use core\forms\manage\User\UserEditForm;
use core\repositories\UserRepository;
use core\services\RoleManager;
use core\services\TransactionManager;
/**
 * Class UserManageService
 * @package core\services\manage
 *
 *
 */
class UserManageService
{
    private $repository;
    private $roles;
    private $transaction;

    public function __construct(UserRepository $repository, RoleManager $roles, TransactionManager $transaction)
    {
        $this->repository = $repository;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
        return $user;
    }

    public function edit($id, UserEditForm $form)
    {
        /**
         * @var $user User
         */
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email
        );
        $this->transaction->wrap(function () use ($user, $form) {
            $this->repository->save($user);
            $this->roles->assign($user->id, $form->role);
        });
    }

    public function remove($id)
    {
        /**
         * @var $user User
         */
        $user = $this->repository->get($id);
        $this->repository->remove($user);
    }

    public function assignRole($id, $role)
    {
        /**
         * @var $user User
         */
        $user = $this->repository->get($id);
        $this->roles->assign($user->id, $role);
    }
}