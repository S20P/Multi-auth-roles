<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticlesRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ArticlesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArticlesCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Articles');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/articles');
        $this->crud->setEntityNameStrings('articles', 'articles');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {

        $this->crud->addField([
            'name'           => 'image',
            'type'           => 'upload',
            'label'          => 'Image/Icon',
            'upload' => true,
            'disk' => 'public',
        ]);
        $this->crud->setValidation(ArticlesRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {

        $this->crud->addField([
            'name'           => 'image',
            'type'           => 'upload',
            'label'          => 'Image/Icon',
            'upload' => true,
            'disk' => 'public',
        ]);
        $this->setupCreateOperation();
    }
}
