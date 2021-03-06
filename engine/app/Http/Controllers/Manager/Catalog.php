<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Models\Catalog as CatalogModel;

/**
 * Class Catalog
 * @package RecycleArt\Http\Controllers\Manager
 */
class Catalog extends ManagerController
{
    /**
     * @param CatalogModel $catalog
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList(CatalogModel $catalog)
    {
        $list = $catalog->getList();
        return \view('manager.catalog.list', ['categories' => $list]);
    }

    /**
     * @param CatalogModel $catalog
     * @param int          $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form(CatalogModel $catalog, int $id = 0)
    {
        if (empty($id)) {
            return \view('manager.catalog.form');
        }
        $category = $catalog->getById($id);
        if (empty($category)) {
            \abort(404, 'category has not found');
        }
        return \view('manager.catalog.form', ['category' => $category]);
    }

    public function process(CatalogModel $catalog, Request $request)
    {
        $this->validate($request, [
            'name'        => 'required|string',
            'description' => 'string',
        ]);

        $id = $request->post('id', 0);
        $name = $request->post('name');
        $description = $request->post('description');

        if (empty($id)) {
            $catalog->addCategory($name, $description);
            return Redirect::to(route('managerCatalogList'));
        }
        $catalog->updateCategory($id, [
            'name' => $name,
            'description' => $description
        ]);
        return Redirect::to(route('managerCatalogList'));
    }

    /**
     * @param CatalogModel $catalog
     * @param int          $id
     *
     * @return mixed
     */
    public function remove(CatalogModel $catalog, int $id)
    {
        $catalog->removeCategory($id);
        return Redirect::to(route('managerCatalogList'));
    }
}
