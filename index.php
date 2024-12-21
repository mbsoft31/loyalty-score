<?php

require_once './vendor/autoload.php';
/*

CREATE TABLE loyalty_programs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    business_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    rules JSON NOT NULL, -- Contains details like earn/redeem rates, limits, etc.
    start_date DATE NOT NULL,
    end_date DATE NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (business_id) REFERENCES businesses(id) ON DELETE CASCADE
);

*/
/*$programData = [
    "name" => "Points Based Program",
    "description" => "Points Based Program",
    "rules" => [
        "earn_points" => [
            "per_amount_spent" => 10
        ],
        "redeem_points" => [
            "per_amount_discount" => 100,
            "minimum_points_required" => 500
        ],
        "validity" => [
            "start_date" => "2024-01-01",
            "end_date" => "2024-12-31"
        ]
    ],
    "start_date" => "2024-01-01",
    "end_date" => "2024-12-31",
    "is_active" => true,
    "business_id" => 1,
    "id" => 1,
];

// context
$transaction = [
    "amount" => 100,
];

$program = new PointsBasedProgram($programData);

$program->process($transaction);*/

/*$programData = [
    "name" => "Category Specific Program",
    "description" => "Category Specific Program",
    "rules" => [
        "earn_points" => [
            "per_amount_spent" => 5,
            "categories" => [
                "electronics" => 15,
                "groceries" => 10
            ]
        ],
        "redeem_points" => [
            "per_amount_discount" => 100,
            "minimum_points_required" => 500
        ],
        "validity" => [
            "start_date" => "2024-01-01",
            "end_date" => "2024-12-31"
        ]
    ],
    "start_date" => "2024-01-01",
    "end_date" => "2024-12-31",
    "is_active" => true,
    "business_id" => 1,
    "id" => 2,
];

// context
$transaction = [
    "amount" => 100,
    "category" => "electronics"
];

$program = new CategorySpecificProgram($programData);

$program->process($transaction);*/

$programData = [
    "name" => "Cashback Program",
    "description" => "Cashback Program",
    "rules" => [
        "earn_points" => [
            "per_amount_spent" => 2,
        ],
        "redeem_points" => [
            "points_per_amount_cashback" => 100,
            "minimum_points_required" => 1000,
        ],
        "validity" => [
            "start_date" => "2024-01-01",
            "end_date" => "2024-12-31"
        ]
    ],
    "start_date" => "2024-01-01",
    "end_date" => "2024-12-31",
    "is_active" => true,
    "business_id" => 1,
    "id" => 2,
];

// context
$transaction = [
    "amount" => 1000,
    "category" => "electronics"
];

$program = new \Mbsoft\LoyaltyScore\Programs\CashbackProgram($programData);

$program->process($transaction);

