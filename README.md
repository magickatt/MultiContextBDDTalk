# Multi-context BDD Talk

[![Travis CI build status](https://www.travis-ci.org/magickatt/MultiContextBDDTalk.svg?branch=master)](https://www.travis-ci.org/magickatt/MultiContextBDDTalk)
[![Code Climate](https://codeclimate.com/github/magickatt/MultiContextBDDTalk/badges/gpa.svg)](https://codeclimate.com/github/magickatt/MultiContextBDDTalk)
[![Test Coverage](https://codeclimate.com/github/magickatt/MultiContextBDDTalk/badges/coverage.svg)](https://codeclimate.com/github/magickatt/MultiContextBDDTalk/coverage)

Demo for talk on how [Behaviour Driven Development](https://en.wikipedia.org/wiki/Behavior-driven_development) (BDD) can be used to test multiple contexts for modern websites separated into [single page applications](https://en.wikipedia.org/wiki/Single-page_application) and [REST APIs](https://en.wikipedia.org/wiki/Application_programming_interface#Web_APIs)

This demonstrates how you can spin up a front-end and back-end container (which in reality would live in separate repositories) and run behavioural tests against one and both independently

## Installation

For this demo to work you'll need [Docker installed](https://docs.docker.com/engine/installation/)

### Setup Swarm and deploy the Stack

    docker swarm init
    docker stack deploy -c docker-compose.yml bddtalk
    
You should see the following output if this works successfully

    Creating network bddtalk_default
    Creating service bddtalk_testrunner
    Creating service bddtalk_frontend
    Creating service bddtalk_backend

### Use the application

#### Add a host entry

Because the behavioural tests rely on internal DNS within the Docker Swarm, you will need a local hosts file entry to point the Angular application at the REST API

    127.0.0.1 backend

#### Accessing the applications

The container running the single page JavaScript application should be available locally on port 8888 (which is forwarded to port 80 in the container)

[http://localhost:8888](http://localhost:8888)

The container running the REST API should display ~~Swagger~~ Open API documentation locally on port 9999

[http://localhost:9999](http://localhost:9999)
    
### Running the tests

There are scripts to run the tests within their respective containers. If these are non-executable you'll need to allow them to be run
    
    chmod +x bdd-tests.sh

#### Behavioural tests

There is a shortcut script provided which will determine which container is the test runner then run the Behat tests on it

    ./bdd-tests.sh

#### Unit and Integration tests
	
    cd backend && bin/phpspec run && cd -
    cd backend && bin/phpunit --coverage-php data/coverage/phpunit_coverage.cov && cd -


