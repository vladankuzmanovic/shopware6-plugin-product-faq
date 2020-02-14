<?php declare(strict_types=1);

namespace KuzmanProductFaq\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1581688006 extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1581688006;
    }

    public function update(Connection $connection): void
    {
        $connection->exec( "CREATE TABLE IF NOT EXISTS  `kuzman_product_faq` (
            `id`            BINARY(16) NOT NULL,
            `active`        TINYINT(1) NULL DEFAULT '0',
            `email`         VARCHAR(255) NOT NULL,
            `nickname`      VARCHAR(255) NOT NULL,
            `question`      LONGTEXT NOT NULL,
            `answer`        LONGTEXT NULL,
            `products`      VARCHAR(255) NULL,
            `created_at`    DATETIME(3),
            `updated_at`    DATETIME(3),
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
