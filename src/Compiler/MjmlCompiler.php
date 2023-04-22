<?php

declare(strict_types=1);

namespace Assoconnect\MJMLBundle\Compiler;

use Symfony\Component\Process\Process;

/**
 * Compiles a MJML file to an HTML file
 */
class MjmlCompiler implements MjmlCompilerInterface
{
    protected $projectDir;

    public function __construct(
        string $projectDir
    ) {
        $this->projectDir = $projectDir;
    }

    public function compile(string $input, string $output)
    {
        $path = $this->projectDir . '/node_modules/.bin/mjml';
        if (!file_exists($path)) {
            throw new \Exception('MJML is not installed. Please run "npm install mjml" in your project directory.');
        }

        $command = [
            $path,
            $input,
            '-o',
            $output,
            '--config.validationLevel=strict',
        ];
        $process = new Process($command);
        $process->mustRun();
    }
}
