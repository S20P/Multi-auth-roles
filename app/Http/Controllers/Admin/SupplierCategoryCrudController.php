<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SupplierCategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SupplierCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SupplierCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\SupplierCategory');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/suppliercategory');
        $this->crud->setEntityNameStrings('suppliercategory', 'supplier_categories');
    }

    protected function setupListOperation()
    {

        $this->crud->setTitle('Supplier Category Management');
        $this->crud->setHeading('Supplier Category Management');
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        
    }

    protected function setupCreateOperation()
    {
      
        $this->crud->setTitle('Supplier Category Management');
        $this->crud->setHeading('Supplier Category Management');
        $this->crud->setSubheading('Add Category','create');

        $this->crud->addField([
            'name'           => 'image',
            'type'           => 'upload',
            'label'          => 'Image/Icon',
            'upload' => true,
            'disk' => 'public',
        ]);
        
        $this->crud->setValidation(SupplierCategoryRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
        
    }

    protected function setupUpdateOperation()
    {

        $this->crud->setTitle('Supplier Category Management');
        $this->crud->setHeading('Supplier Category Management');
        $this->crud->setSubheading('Edit Category','edit');

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
