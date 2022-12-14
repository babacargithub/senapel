<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ParutionController;
use App\Http\Requests\AvisRequest;
use App\Models\Avis;
use App\Models\Parution;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AvisCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AvisCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Avis::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/avis');
        CRUD::setEntityNameStrings('avis', 'avis');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupShowOperation()
    {
        CRUD::column('titre');
        CRUD::column('sous_titre');
        $this->crud->addColumn(['name'=>'contenu','type'=>'wysiwyg-render']);
        CRUD::column('autorite');
        CRUD::column('parution_id');
    }

    protected function setupListOperation()
    {
        CRUD::column('titre');
        CRUD::column('sous_titre');
        CRUD::column('autorite');
        CRUD::column('parution_id');

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
        CRUD::setValidation(AvisRequest::class);

        CRUD::field('titre');
        CRUD::field('sous_titre');
        $this->crud->addField(['name'=>'contenu',"type"=>"wysiwyg"]);
        CRUD::field('autorite');
        CRUD::field('publie_dans');
        CRUD::field('parution_id');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
    public function ajouterAvisSurParution(Parution $parution)
    {
        return redirect(backpack_url('avis/create'));
    }
}
