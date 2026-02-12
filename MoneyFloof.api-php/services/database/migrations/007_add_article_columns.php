<?php
if (DatabaseService::tableExists('articles')) {
    $columns = [
        'title'      => 'VARCHAR(100)',
        'description'      => 'TEXT(4000)'
        // 'price'      => '',
        // 'state'     => '',
        // 'delivered'     => '',
        // 'website'     => '',
        // 'tracking_website'     => '',
        // 'partial_payment'     => '',
        // "image" => '',
        // "payment_deadlines" => '', // table
        // "items" => '', // table
        // "is_monthly" => '',
        // 'bought_at'    => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        // 'created_at'    => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        // 'created_by'    => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        // 'modified_at'    => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        // 'modified_by' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
    ];

    DatabaseService::addColumns('articles', $columns);
}