<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ChildrenCostumeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ChildrenCostumeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ChildrenCostumeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ChildrenCostume::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/children-costume');
        CRUD::setEntityNameStrings('children costume', 'children costumes');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('assigned_at');
        CRUD::column('costume_id');
        CRUD::column('created_at');
        CRUD::column('updated_at');
        CRUD::column('user_id');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
    CRUD::setValidation(ChildrenCostumeRequest::class);

    $costumeId = request()->query('costume_id');

    CRUD::field('assigned_at')->default(now());
    CRUD::field('costume_id')->default($costumeId);
    CRUD::addField([
        'label' => 'Children',
        'type' => 'select_multiple',
        'name' => 'children',
        'entity' => 'children',
        'attribute' => 'name', 
        'model' => 'App\Models\User',
        'allows_null' => false,
        'options' => function ($query) {
            return $query->where('role_id', 1)->get(['id', 'name']);
        },
    ]);
    }
}