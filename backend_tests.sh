#!/bin/bash

# Determine which container in the stack is the back-end container
CONTAINER_NAME=bddtalk_backend.1.$(docker service ps -f 'name=bddtalk_backend.1' bddtalk_backend -q --no-trunc)

# Run the unit tests and integration tests inside the back-end container
docker exec -i $CONTAINER_NAME bash <<'DOCKER_EXEC_COMMAND'
cd /var/backend
echo -e "Running unit tests..."
bin/phpspec run
echo -e "\nRunning integration tests...\n"
bin/phpunit
exit
DOCKER_EXEC_COMMAND
