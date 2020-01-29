<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Mail;
use Auth;
/**
 * Class CustomerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }


    public function setup()
    {
        $this->crud->setModel('App\Models\Customer');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/customer');
        $this->crud->setEntityNameStrings('customer', 'customers');
    }

    public function getUserID(){
        return Auth::guard('backpack')->user()->id;
     }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        $this->crud->removeColumn('user_id');
    }

    protected function setupCreateOperation()
    {

        // $user_id = $this->getUserID();

        // $this->crud->addField([
        //     'name'           => 'user_id',
        //     'type'           => 'hidden',
        //     'default' => $user_id
        // ]);

        $this->crud->addField([
            'name'           => 'status',
            'type'           => 'select_from_array',
            'label'          => 'Status',
            'options' => ["Approved" => "Approved", "Disapproved" => "Disapproved"],
            'default' => "Disapproved"
        ]);

        $this->crud->setValidation(CustomerRequest::class);

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

        $this->setupCreateOperation();
        $this->crud->removeField('user_id');
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
