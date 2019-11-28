# Kly ComDev GrumPhp Xtension

This package is [GrumPHP](https://github.com/phpro/grumphp) extension contains tasks that runs :
- [Larastan](https://github.com/nunomaduro/larastan).

## Installation
	
	composer require klx/grumphpx --dev


## Usage

Add the extension loader to your `grumphp.yml`

```yaml
parameters:
    extensions:
        - Klx\GrumPhpX\Extension
```

### Larastan
Add the task to your `grumphp.yml`
```yaml
parameters:
    tasks:
        larastan:
            paths:
                - app
                - config
                - tests
            level: 5
```

**paths**
*Default: `[]`*

This parameters is an array of directories to run larastan on.

**level**
*Default: `5`*

Larastan analyse level. You can choose from currently 8 levels: (0 is the loosest and 7 is the strictest)


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Todo
- add tests
- add detail contribution guide [CONTRIBUTING](CONTRIBUTING.md) 
