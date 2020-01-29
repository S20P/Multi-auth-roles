<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SupplierRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Mail;
use Auth;
/**
 * Class SupplierCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SupplierCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    
    public function setup()
    {
        $this->crud->setModel('App\Models\Supplier');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/supplier');
        $this->crud->setEntityNameStrings('supplier', 'suppliers');
    }

    public function getUserID(){
       return Auth::guard('backpack')->user()->id;
    }

    protected function setupListOperation()
    {      

       // CRUD::addColumns(['id', 'user_id','name','email','phone','service_name','business_name','category','service_description','event_type','location','pricing_category','status']); 
        $this->crud->setFromDb();
        $this->crud->removeColumn('user_id');
      // $this->crud->setActionsColumnPriority(10000);
    }

    protected function setupCreateOperation()
    {

    //   $user_id = $this->getUserID();


    //     $this->crud->addField([
    //         'name'           => 'user_id',
    //         'type'           => 'hidden',
    //         'default' => $user_id
    //     ]);

        $this->crud->addField([
            'name'           => 'status',
            'type'           => 'select_from_array',
            'label'          => 'Status',
            'options' => ["Approved" => "Approved", "Disapproved" => "Disapproved"],
            'default' => "Disapproved"
        ]);

        // $this->crud->addField([
        //     'name'           => 'category',
        //     'type'           => 'select',
        //     'label'          => 'Category',
        //     'entity' => 'supplier_categories',
        //     'attribute' => 'name',
        //     'model' => "App\Models\SupplierCategory",
        //     'options'   => (function ($query) {
        //         return $query->orderBy('name', 'ASC')->get();
        //     }),
        // ]);

        $this->crud->addField([
            'name'           => 'image',
            'type'           => 'upload',
            'label'          => 'Image/Icon',
            'upload' => true,
            'disk' => 'public',
        ]);

        $this->crud->setValidation(SupplierRequest::class);

        // TODO: remove setFromDb() and manually define Fields

        $this->crud->setFromDb();
       $this->crud->removeField('user_id');
    }   

    protected function setupUpdateOperation()
    {   
        $this->crud->addField([
            'name'           => 'status',
            'type'           => 'select_from_array',
            'label'          => 'Status',
            'options' => ["Approved" => "Approved", "Disapproved" => "Disapproved"],
            'default' => "Disapproved"
        ]);

        // $this->crud->addField([
        //     'name'           => 'category',
        //     'type'           => 'select',
        //     'label'          => 'Category',
        //     'entity' => 'supplier_categories',
        //     'attribute' => 'name',
        //     'model' => "App\Models\SupplierCategory",
        //     'options'   => (function ($query) {
        //         return $query->orderBy('name', 'ASC')->get();
        //     }),
        // ]);

        $this->crud->addField([
            'name'           => 'image',
            'type'           => 'upload',
            'label'          => 'Image/Icon',
            'upload' => true,
            'disk' => 'public',
        ]);


        $this->crud->removeField('user_id');
        $this->setupCreateOperation();
    }   

    public function update()
    {             
          $response = $this->traitUpdate();
          $Result = $this->crud->entry;  

          $status = $Result->status;
          $email  = $Result->email;
          $name = $Result->name;

          $data = array(
            'name'=>$name, 
            'email'=>$email, 
           );
          
          if($status=="Approved"){

            Mail::send("emails.Profile_approve",$data, function($message) use ($email, $name)
            {
                $message->to($email, $name)->subject('Welcome!');
            });
          } 
        // do something after save
        return $response;
    }
}
