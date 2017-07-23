#!/bin/bash

# Determine which container in the stack is the test runner container
CONTAINER_NAME=bddtalk_testrunner.1.$(docker service ps -f 'name=bddtalk_testrunner.1' bddtalk_testrunner -q --no-trunc)

# Run the behavioural tests inside the test runner container
docker exec -i $CONTAINER_NAME bash <<'DOCKER_EXEC_COMMAND'
cd /var/backend
bin/behat
exit
DOCKER_EXEC_COMMAND
