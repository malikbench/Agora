#!/bin/bash

echo "Updating your schema with possibly newly created entities..."
php bin/console doctrine:schema:update --force
echo "Update finished"