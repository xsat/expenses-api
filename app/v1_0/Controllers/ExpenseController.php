<?php

namespace App\v1_0\Controllers;

use Common\Mapper\ExpenseMapper;
use Common\Model\Expense;
use Common\Validation\ExpenseValidation;
use Nen\Validation\Values;
use stdClass;

/**
 * Class ExpenseController
 */
class ExpenseController extends PrivateController
{
    public function listAction(): void
    {
        $this->response->setJsonContent(new stdClass());
    }

    /**
     * @param int $expense_id
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
            var_dump('not found');
            exit;
        }

        $this->response->setJsonContent([
            'expense_id' => $expense->getExpenseId(),
            'user_id' => $expense->getUserId(),
            'note' => $expense->getNote(),
            'cost' => $expense->getCost(),
            'spent_date' => $expense->getSpentDate(),
        ]);
    }

    public function createAction(): void
    {
        $validation = new ExpenseValidation();
        $values = new Values($this->request->getPut() ?? []);

        if (!$validation->validate($values)) {
            var_dump($validation->getMessages());
            exit;
        }

        $expense = new Expense();
        $expense->setNote($values->getValue('note'));
        $expense->setUserId($this->user->getUserId());
        $expense->setCost($values->getValue('cost'));
        $expense->setSpentDate($values->getValue('spent_date'));

        (new ExpenseMapper($this->connection))->create($expense);

        $this->response->setJsonContent([
            'expense_id' => $expense->getExpenseId(),
            'user_id' => $expense->getUserId(),
            'note' => $expense->getNote(),
            'cost' => $expense->getCost(),
            'spent_date' => $expense->getSpentDate(),
        ]);
    }

    /**
     * @param int $expense_id
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
            var_dump('not found');
            exit;
        }

        $validation = new ExpenseValidation();
        $values = new Values($this->request->getPut() ?? []);

        if (!$validation->validate($values)) {
            var_dump($validation->getMessages());
            exit;
        }

        $expense->setNote(
            $values->getValue('note') ?? $expense->getNote()
        );
        $expense->setCost($values->getValue('cost'));
        $expense->setSpentDate(
            $values->getValue('spent_date') ?? $expense->getSpentDate()
        );

        $mapper->update($expense);

        $this->response->setJsonContent(new stdClass());
    }

    /**
     * @param int $expense_id
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
            var_dump('not found');
            exit;
        }

        $mapper->delete($expense);

        $this->response->setJsonContent(new stdClass());
    }
}
