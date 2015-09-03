<?php

namespace myfinance\repositories\factories;

class BudgetaryItemRepositoryFactory {

    public static function create(\myfinance\FinanceContext $context) {
        if ($context->getDb() instanceof \myfinance\db\MysqlDB) {
            return new \myfinance\repositories\MysqlBudgetaryItemRepository($context);
        } else {
            return new \myfinance\repositories\DummyBudgetaryItemRepository($context);
        }
    }

}
