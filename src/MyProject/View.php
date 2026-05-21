<?php

declare(strict_types=1);

namespace MyProject;

final class View
{
    private string $templatesPath;

    public function __construct()
    {
        $this->templatesPath = dirname(__DIR__, 2) . '/templates';
    }

    /** @param array<string, mixed> $vars */
    public function render(string $template, array $vars = []): void
    {
        extract($vars, EXTR_SKIP);
        $config = require dirname(__DIR__, 2) . '/config/config.php';
        $defaultTitle = $config['default_title'];
        $appName = $config['app_name'];

        ob_start();
        require $this->templatesPath . '/' . $template . '.php';
        $content = ob_get_clean();

        require $this->templatesPath . '/layout.php';
    }
}
