<?php

namespace myfinance\repositories\factories;

class AccountRepositoryFactory {

    public static function create(\myfinance\FinanceContext $context) {
        return new \myfinance\repositories\MysqlAccountRepository($context);
    }

}
