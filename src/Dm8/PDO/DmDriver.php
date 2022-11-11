<?php

namespace LaravelDm8\Dm8\PDO;

use Doctrine\DBAL\Driver\AbstractOracleDriver;
use Illuminate\Database\PDO\Concerns\ConnectsToDatabase;

class DmDriver extends AbstractOracleDriver
{
    use ConnectsToDatabase;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'dm';
    }
}
