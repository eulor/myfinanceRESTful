<?php

namespace myfinance\controller;

use myfinance\repositories\CategoryRepository;

class CategoryController {

    private $repository;

    public function __construct(CategoryRepository $repository) {
        $this->repository = $repository;
    }

    public function get($id = null) {
        $categories = array();
        if (is_null($id)) {
            $categories = $this->repository->getAll();
        } else {
            $categories[] = $this->repository->get($id);
        }

        return json_encode($categories);
    }

    /**
     * 
     * @param int $id
     */
    public function delete($id) {
        $this->repository->deleteById($id);
    }

    /**
     * 
     * @param Object $input
     * @return \myfinance\model\Category
     */
    public function put($input) {
        $category = $this->createNewCategoryFromInput($input);
        return $this->repository->update($category);
    }

    /**
     * 
     * @param Object $input
     * @return \myfinance\model\Category
     */
    public function post($input) {
        $category = $this->createNewCategoryFromInput($input);
        return $this->repository->create($category);
    }

    private function createNewCategoryFromInput($input) {
        $category = new \myfinance\model\Category();
        if (isset($input->id)) {
            $category->id = $input->id;
        }
        if (isset($input->type)) {
            $category->type = $input->type;
        }
        if (isset($input->description)) {
            $category->description = $input->description;
        }
        if (isset($input->budgetaryItem)) {
            $category->budgetaryItem = $input->budgetaryItem;
        }
        return $category;
    }

}
