<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ParutionController;
use App\Http\Requests\AppelRequest;
use App\Models\Appel;
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
 * Class AppelCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AppelCrudController extends CrudController
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
        CRUD::setModel(Appel::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/appel');
        CRUD::setEntityNameStrings('appel', 'appels');
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
        CRUD::column('date_appel');
        CRUD::column('date_limite');
        CRUD::column('publie_dans');
        CRUD::column('autorite');
        CRUD::column('parution_id');
        CRUD::column('categorie_appel_id');
    }

    protected function setupListOperation()
    {
        CRUD::column('autorite');
        CRUD::column('titre');
        CRUD::column('date_limite');
        CRUD::column('publie_dans');

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
        CRUD::setValidation(AppelRequest::class);

        CRUD::field('titre');
        CRUD::field('sous_titre');
        CRUD::field('date_appel');
        CRUD::field('date_limite');
        CRUD::field('publie_dans');
        CRUD::field('autorite');
        CRUD::field('parution_id');
        $this->crud->addField(['name'=>'categorie_appel_id',"type"=>"select",'entity'=>'CategorieAppel','attribute'=>'nom']);
        $this->crud->addField(['name'=>'contenu',"type"=>"wysiwyg"]);

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

    public function ajouterAppelsSurParution(Parution $parution)
    {
//        return redirect(backpack_url('appel/create'));
        return view('admin.base_admin');
    }
}
