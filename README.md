# Multi-context BDD Talk

Demo for talk on how [Behaviour Driven Development](https://en.wikipedia.org/wiki/Behavior-driven_development) (BDD) can be used to test multiple contexts for modern websites separated into [single page applications](https://en.wikipedia.org/wiki/Single-page_application) and [REST APIs](https://en.wikipedia.org/wiki/Application_programming_interface#Web_APIs)

## Installation

### Install Docker

* [Mac](https://docs.docker.com/docker-for-mac/install/)
* [Ubuntu](https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/)
* [Windows](https://docs.docker.com/docker-for-windows/install/)

### Setup Swarm and deploy the Stack

    docker swarm init
    docker stack deploy -c docker-compose.yml bddtalk
    
You should see the following output if this works successfully

    Creating network bddtalk_default
    Creating service bddtalk_frontend
    Creating service bddtalk_backend

### Use the application

The container running the single page JavaScript application should be available locally on port 8888

http://localhost:8888

The container running the REST API should display ~~Swagger~~ Open API documentation locally on port 9999

http://localhost:9999
    
### Running the tests

cd /var/backend/ && bin/phpunit
cd /var/backend/ && bin/phpspec run

#### Behavioural tests

#### Unit and Integration tests


