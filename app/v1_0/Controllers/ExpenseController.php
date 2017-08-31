<?php

namespace App\v1_0\Controllers;

use Common\Binder\ExpenseBinder;
use Common\Binder\ListBinder;
use Common\Formatter\ExpenseFormatter;
use Common\Formatter\ExpenseListFormatter;
use Common\Mapper\ExpenseMapper;
use Common\Model\Expense;
use Common\Validation\ExpenseValidation;
use Common\Validation\ListValidation;
use Nen\Exception\NotFoundException;
use Nen\Exception\ValidationException;

/**
 * Class ExpenseController
 */
class ExpenseController extends PrivateController
{
    /**
     * @throws ValidationException
     */
    public function listAction(): void
    {
        $validation = new ListValidation();
        $binder = new ListBinder($this->request->getQuery() ?? []);

        if (!$validation->validate($binder)) {
            throw new ValidationException($validation);
        }

        $mapper = new ExpenseMapper($this->connection);

        $this->format(
            new ExpenseListFormatter(
                $mapper->getTotal($binder),
                $mapper->getList($binder),
                $binder
            )
        );
    }

    /**
     * @param int $expense_id
     *
     * @throws NotFoundException
     */
    public function viewAction(int $expense_id): void
    {
        $expense = (new ExpenseMapper($this->connection))->findFirst(
            'expense_id = :expense_id AND user_id = :user_id',
            [
                'expense_id' => $expense_id,
                'user_id' => $this->user->getUserId(),
            ]
        );

        if (!$expense) {
            throw new NotFoundException('Expense not found');
        }

        $this->format(new ExpenseFormatter($expense));
    }

    /**
     * @throws ValidationException
     */
    public function createAction(): void
    {
        $validation = new ExpenseValidation();
        $binder = new ExpenseBinder($this->request->getPut() ?? []);

        if (!$validation->validate($binder)) {
            throw new ValidationException($validation);
        }

        $expense = new Expense();
        $expense->setNote($binder->getNote());
        $expense->setUserId($this->user->getUserId());
        $expense->setCost($binder->getCost());
        $expense->setSpentDate($binder->getSpentDate());

        (new ExpenseMapper($this->connection))->create($expense);

        $this->format(new ExpenseFormatter($expense));
    }

    /**s
     * @param int $expense_id
     *
     * @throws NotFoundException
     * @throws ValidationException
     */
    public function updateAction(int $expense_id): void
    {
        $mapper = new ExpenseMapper($this->connection);
        $expense = $mapper->findFirst(
            'expense_id = :expense_id AND user_id = :user_id',
            [
                'expense_id' => $expense_id,
                'user_id' => $this->user->getUserId(),
            ]
        );

        if (!$expense) {
            throw new NotFoundException('Expense not found');
        }

        $validation = new ExpenseValidation();
        $binder = new ExpenseBinder($this->request->getPut() ?? []);

        if (!$validation->validate($binder)) {
            throw new ValidationException($validation);
        }

        $expense->setNote(
            $binder->getNote() ?? $expense->getNote()
        );
        $expense->setCost($binder->getCost());
        $expense->setSpentDate(
            $binder->getSpentDate() ?? $expense->getSpentDate()
        );

        $mapper->update($expense);

        $this->response();
    }

    /**
     * @param int $expense_id
     *
     * @throws NotFoundException
     */
    public function deleteAction(int $expense_id): void
    {
        $mapper = new ExpenseMapper($this->connection);
        $expense = $mapper->findFirst(
            'expense_id = :expense_id AND user_id = :user_id',
            [
                'expense_id' => $expense_id,
                'user_id' => $this->user->getUserId(),
            ]
        );

        if (!$expense) {
            throw new NotFoundException('Expense not found');
        }

        $mapper->delete($expense);

        $this->response();
    }
}
