<?php

namespace myfinance\repositories\factories;

class AccountingEntryRepositoryFactory {

    public static function create(\myfinance\FinanceContext $context) {
        if ($context->getDb() instanceof \myfinance\db\MysqlDB) {
            return new \myfinance\repositories\MysqlAccountingEntryRepository($context);
        } else {
            return new \myfinance\repositories\DummyAccountingEntryRepository($context);
        }
    }

}
