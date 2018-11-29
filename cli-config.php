<?php
require_once join(DIRECTORY_SEPARATOR, [__DIR__, '/src/Core/ORM/EntityManager.php']);

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$instance = \Core\ORM\EntityManager::getEntityManager();

return ConsoleRunner::createHelperSet($instance->getManager());