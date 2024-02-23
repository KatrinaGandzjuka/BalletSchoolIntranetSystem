<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Location;

class GroupCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Group::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/group');
        CRUD::setEntityNameStrings('group', 'groups');
    }

    protected function setupListOperation()
    {
        CRUD::column('groupName');
        CRUD::column('age');
        CRUD::addColumn([
            'name' => 'location_id',
            'label' => 'Location',
            'type' => 'select',
            'entity' => 'location',
            'attribute' => 'address',
            'model' => 'App\Models\Location',
        ]);
        CRUD::addColumn([
            'label' => 'Children',
            'type' => 'select_multiple',
            'name' => 'children',
            'entity' => 'children',
            'attribute' => 'name',
            'model' => 'App\Models\User',
            'allows_null' => false,
        ]);
        CRUD::addColumn([
            'label' => 'Teachers',
            'type' => 'select_multiple',
            'name' => 'teachers',
            'entity' => 'teachers',
            'attribute' => 'name',
            'model' => 'App\Models\User',
            'allows_null' => false,
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(GroupRequest::class);

        CRUD::field('groupName');
        CRUD::field('age');
        CRUD::addField([
            'name' => 'location_id',
            'label' => 'Location',
            'type' => 'select',
            'entity' => 'location',
            'attribute' => 'address',
            'model' => 'App\Models\Location',
        ]);
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
        CRUD::addField([
            'label' => 'Teachers',
            'type' => 'select_multiple',
            'name' => 'teachers',
            'entity' => 'teachers',
            'attribute' => 'name', 
            'model' => 'App\Models\User',
            'allows_null' => false,
            'options' => function ($query) {
                return $query->where('role_id', 2)->get(['id', 'name']);
            },
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
