<?php

namespace App\Services;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class MaizzleConverter
{
    protected $maizzlePath;
    protected $nodePath;

    public function __construct()
    {
        $this->maizzlePath = base_path('maizzle/renderMaizzle.js');
        $this->nodePath = config('mailifyflow.node_path');
    }

    /**
     * Creates and returns a new instance of the class.
     *
     * @return self The newly created instance.
     */
    public static function make(): self
    {
        return new self();
    }

    /**
     * Converts the given title, preheader, body class, and content to HTML using the Maizzle rendering script.
     *
     * @param string $title The title of the page.
     * @param string $preheader The preheader text.
     * @param string $bodyClass The body class of the page.
     * @param string $content The content to be converted.
     * @throws ProcessFailedException If the process fails to run.
     * @return string The converted HTML content.
     */
    public function convert(string $title, string $preheader, string $bodyClass, string $content)
    {
        // Create a new process to execute the script
        $process = new Process([$this->nodePath, $this->maizzlePath, $title, $preheader, $content, $bodyClass]);

        try {

            if (config('mailifyflow.node_path') == null) {
                throw new \Exception('Node.js path not set in config/mailifyflow.php');
            }

            // Execute the process
            $process->mustRun();

            // Get the output
            $output = $process->getOutput();

            // Extract HTML content
            $html = $this->extractHtml($output);

            return $html;
        } catch (ProcessFailedException $exception) {
            return $exception->getMessage();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Extract HTML content from output.
     *
     * @param string $output
     * @return string
     */
    private function extractHtml($output)
    {
        // Find the position of the closing HTML tag
        $htmlEndPos = strpos($output, '</html>');

        // Extract HTML content
        $html = substr($output, 0, $htmlEndPos + 7);

        return $html;
    }
}
