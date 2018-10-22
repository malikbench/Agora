#!/bin/bash

echo "Setting up the symfony project"
php composer.phar install
./updateSchema.sh
php bin/console doctrine:database:import Data/GameInfo.sql
php bin/console doctrine:database:import Data/admin.sql
./clearCache.sh
echo "Done !"