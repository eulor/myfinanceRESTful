<?php

namespace myfinance\repositories\factories;

class AccountRepositoryFactory {

    public static function create(\myfinance\FinanceContext $context) {
        if($context->getDb() instanceof \myfinance\db\MysqlDB){
            return new \myfinance\repositories\MysqlAccountRepository($context);
        }else{
            return new \myfinance\repositories\DummyAccountRepository($context);
        }
        
    }

}
