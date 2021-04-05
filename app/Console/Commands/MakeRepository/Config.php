<?php

return [
    //Stub name             //Storage path
    'blade_index'           => 'resources/views/dashboard/DummyTable/index.blade',
    'blade_create'          => 'resources/views/dashboard/DummyTable/create.blade',
    'blade_edit'            => 'resources/views/dashboard/DummyTable/edit.blade',
    'controller'            => 'app/Http/Controllers/Dashboard/DummyClassController',
    'form_constructor'      => 'resources/views/dashboard/DummyTable/forms/_constructor.blade',
    'form_default'          => 'resources/views/dashboard/DummyTable/forms/default.blade',
    'localization'          => 'resources/lang/es/sections/DummyTable',
    'migration'             => 'database/migrations/' . date('Y_m_d_His') . '_create_DummyTable_table',
    'model'                 => 'app/Models/DummyClass/DummyModel',
    'model_events'          => 'app/Models/DummyClass/DummyClassEvents',
    'model_helpers'         => 'app/Models/DummyClass/DummyClassHelpers',
    'model_presenters'      => 'app/Models/DummyClass/DummyClassPresenters',
    'model_relationships'   => 'app/Models/DummyClass/DummyClassRelationships',
    'model_scopes'          => 'app/Models/DummyClass/DummyClassScopes',
    'policy'                => 'app/Policies/DummyModelPolicy',
    'request'               => 'app/Http/Requests/DummyClassRequest',
    'table'                 => 'app/Tables/DummyModelTable',
    'test_dusk_access'      => 'tests/Browser/Feature/DummyClass/AccessTest',
    'test_dusk_create'      => 'tests/Browser/Feature/DummyClass/CreateTest',
    'test_dusk_update'      => 'tests/Browser/Feature/DummyClass/UpdateTest',
    'test_dusk_delete'      => 'tests/Browser/Feature/DummyClass/DeleteTest',
    'test_dusk_show'        => 'tests/Browser/Feature/DummyClass/ShowTest',
];
