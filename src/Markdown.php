<?php

namespace Documon\Renderer;

use Documon\RendererInterface;
use Exception;
use Jenssegers\Blade\Blade;
use ParsedownExtra;

class Markdown implements RendererInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * Markdown constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public static function type(): string
    {
        return 'documon-markdown';
    }

    /**
     * @inheritDoc
     */
    public static function template(): string
    {
        return __DIR__ . '/../template';
    }

    /**
     * @inheritDoc
     */
    public static function options(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function serveCommand(): string
    {
        return 'yarn dev';
    }

    /**
     * @return string
     */
    public function buildCommand(): string
    {
        return 'yarn build';
    }

    /**
     * @throws Exception
     * @return void
     */
    public function render(): void
    {
        $content = $this->convert();
        $html = $this->renderHtml($content);
        $this->writeHtml($html);
    }

    /**
     * @throws Exception
     * @return string|string[]|null
     */
    protected function convert()
    {
        $filename = $this->config['filename'];
        $content = file_get_contents($filename);
        $parser = new ParsedownExtra();

        return $parser->text($content);
    }

    /**
     * @param string $content
     *
     * @return string
     */
    protected function renderHtml(string $content): string
    {
        $viewDir = $this->config['template'] . '/views';
        $cacheDir = getcwd() . '/.cache';
        @mkdir($cacheDir);

        $blade = new Blade($viewDir, $cacheDir);

        return $blade->make('index', ['html' => $content])->render();
    }

    /**
     * @param string $html
     */
    protected function writeHtml(string $html): void
    {
        $outputFile = $this->config['work-dir'] . '/src/index.html';
        file_put_contents($outputFile, $html);
    }
}
