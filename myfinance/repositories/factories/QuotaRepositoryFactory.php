<?php

namespace myfinance\repositories\factories;

class QuotaRepositoryFactory {

    public static function create(\myfinance\FinanceContext $context) {
        if ($context->getDb() instanceof \myfinance\db\MysqlDB) {
            return new \myfinance\repositories\MysqlQuotaRepository($context);
        } else {
            return new \myfinance\repositories\DummyQuotaRepository($context);
        }
    }

}
