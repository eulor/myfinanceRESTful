<?php

namespace myfinance\repositories\factories;

class CategoryRepositoryFactory {

    public static function create(\myfinance\FinanceContext $context) {
        if ($context->getDb() instanceof \myfinance\db\MysqlDB) {
            return new \myfinance\repositories\MysqlCategoryRepository($context);
        } else {
            return new \myfinance\repositories\DummyCategoryRepository($context);
        }
    }

}
