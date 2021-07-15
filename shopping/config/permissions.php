<?php


return [
    'access' => [
        'category_list' => 'Category_List',
        'category_add' => 'Category_Add',
        'category_edit' => 'Category_Edit',
        'category_delete' => 'Category_Delete',

        'product_list' => 'Product_List',
        'product_add' => 'Product_Add',
        'product_edit' => 'Product_Edit',
        'product_delete' => 'Product_Delete'
    ],

    'module_parent' => [
        'Category',
        'Menu',
        'Product',
        'Slides',
        'Setting',
        'User',
        'Role',
    ],

    'module_children' => [
        'List',
        'Add',
        'Edit',
        'Delete'
    ]

];
