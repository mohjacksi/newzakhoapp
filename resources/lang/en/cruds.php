<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'auditLog'       => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'appSetting'     => [
        'title'          => 'App Settings',
        'title_singular' => 'App Setting',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'key'                  => 'Key',
            'key_helper'           => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'value_english'        => 'Value English',
            'value_english_helper' => ' ',
            'value_arabic'         => 'Value Arabic',
            'value_arabic_helper'  => ' ',
            'value_kurdish'        => 'Value Kurdish',
            'value_kurdish_helper' => ' ',
        ],
    ],
    'setting'        => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
    ],
    'app'            => [
        'title'          => 'App',
        'title_singular' => 'App',
    ],
    'realEstateType' => [
        'title'          => 'Real Estate Types',
        'title_singular' => 'Real Estate Type',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name_english'        => 'Name English',
            'name_english_helper' => ' ',
            'name_arabic'         => 'Name Arabic',
            'name_arabic_helper'  => ' ',
            'name_kurdish'        => 'Name Kurdish',
            'name_kurdish_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'realEstate'     => [
        'title'          => 'Real Estate',
        'title_singular' => 'Real Estate',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'title_english'              => 'Title English',
            'title_english_helper'       => ' ',
            'title_arabic'               => 'Title Arabic',
            'title_arabic_helper'        => ' ',
            'title_kurdish'              => 'Title Kurdish',
            'title_kurdish_helper'       => ' ',
            'price'                      => 'Price',
            'price_helper'               => ' ',
            'type'                       => 'Type',
            'type_helper'                => ' ',
            'photos'                     => 'Photos',
            'photos_helper'              => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'description_english'        => 'Description English',
            'description_english_helper' => ' ',
            'description_arabic'         => 'Description Arabic',
            'description_arabic_helper'  => ' ',
            'description_kurdish'        => 'Description Kurdish',
            'description_kurdish_helper' => ' ',
        ],
    ],
    'service'        => [
        'title'          => 'Services',
        'title_singular' => 'Service',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'title_english'              => 'Title English',
            'title_english_helper'       => ' ',
            'title_arabic'               => 'Title Arabic',
            'title_arabic_helper'        => ' ',
            'title_kurdish'              => 'Title Kurdish',
            'title_kurdish_helper'       => ' ',
            'description_english'        => 'Description English',
            'description_english_helper' => ' ',
            'description_arabic'         => 'Description Arabic',
            'description_arabic_helper'  => ' ',
            'description_kurdish'        => 'Description Kurdish',
            'description_kurdish_helper' => ' ',
            'icon'                       => 'Icon',
            'icon_helper'                => ' ',
            'photos'                     => 'Photos',
            'photos_helper'              => ' ',
            'phone'                      => 'Phone',
            'phone_helper'               => ' ',
            'whatsapp'                   => 'Whatsapp',
            'whatsapp_helper'            => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
];
