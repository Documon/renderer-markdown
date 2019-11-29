# Markdown renderer for Documon

## Install

1. Require package:

    ```bash
    composer require documon/renderer-markdown
    ```

2. Run Documon `install` command:

    ```bash
    ./documon install "Documon\Renderer\Markdown"
    ```

3. Run `serve` or `build` command:

    ```bash
    ./documon <serve|build> -t markdown README.md
    ```

## Hacking

Install `spatie/phpunit-watcher` globally:

```bash
composer global require spatie/phpunit-watcher
```

Watch modification of source and test cases, then run:

```bash
phpunit-watcher watch
```

Just run test cases:

```bash
vendor/bin/phpunit
```

## License

MIT
