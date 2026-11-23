University Library Management System
====================================

This is a library management system oriented for universities built in PHP with the Symfony framework.

It features:
- Book metadata management
- Book browsing
- Book inventory management
- 

Book metadata is designed similar to [BookBrainz](https://bookbrainz.org/) schema.

<small>This is part of the Integrative Programming assignment</small>

Requirements
------------

### Development

<small>devcontainers docs still wip</small>

- [Docker & Docker compose](https://docs.docker.com/engine/)
- [PHP 8.6](https://www.php.net/)
- [xdebug](https://xdebug.org/)
- [composer](https://getcomposer.org/)

### Production

- [Docker & Docker compose](https://docs.docker.com/engine/)

Running the application
-----------------------

### Configuration

Copy the [.env.example](.env.example) file into a .env file and change the values to fit the configuration.

### Usage

Run the compose with Docker.

#### Development (with debug flags and hot reload)

```shell
docker compose -f docker-compose.yaml -f docker-compose.dev.yaml up -d
```

#### Production

```shell
docker compose -f docker-compose.yaml -f docker-compose.prod.yaml up -d
```

Contributing
------------

See [CONTRIBUTING.md](./CONTRIBUTING.md) for detailed instructions on setting up a local environment for development and contribution.
