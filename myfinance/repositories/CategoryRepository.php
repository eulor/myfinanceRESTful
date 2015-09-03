<?php

namespace myfinance\repositories;

interface CategoryRepository {

    public function get($id);

    public function getAll();

    public function update(\myfinance\model\Category $category);

    public function create(\myfinance\model\Category $category);

    public function delete(\myfinance\model\Category $category);

    public function deleteById($id);
}
