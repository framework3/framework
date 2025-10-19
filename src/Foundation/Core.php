<?php

namespace Framework3;

class Core {

    /**
     * @var float $start The time the application started
     */
    public float $start = 0.0;

    /**
     * @var int $level The logging output level
     */
    public int $level = 0;

    /**
     * @var string $id A unique identifier for this request
     */
    public string $id = '';

    /**
     * @var resource|null $logFileHandle A file handle to the log file
     */
    private $logFileHandle;

    public Environment $environment;

    public function __construct()
    {

        $this->start = microtime(true);

        // Determine the logging output level to STDOUT/STDERR
        $this->level = getenv('F3_LEVEL')
                       ? (int) getenv('F3_LEVEL')
                       : 0;

        // Assign a unique identifier to this request
        $this->id = str_replace('.', '', uniqid('f3', true));

        // TODO: Check for file path writeability
        $this->logFileHandle = (is_string(getenv('F3_LOG')))
            ? fopen(getenv('F3_LOG'), 'a') :
            null;

        // Next, we already have some input just from the environment itself
        $this->environment = new Environment();

    }

    /**
     * @param string $message The message to log
     * @param int $level The log level (0-4)
     * @return void
     */
    public function trace(string $message, int $level = 4): void
    {

        // How long since the application started?
        $since = round(microtime(true) - F3_START, 6);

        // What terminal color scheme are we using? We'll assign colors to each level
        $color = match ($level) {
            0 => "\033[32m", // 0/SUCCESS/green
            1 => "\033[31m", // 1/ERROR/red
            2 => "\033[33m", // 2/WARN/yellow
            3 => "\033[34m", // 3/INFO/blue
            4 => "\033[35m", // 4/DEBUG/magenta
        };

        $label = match ($level) {
            0 => 'SUCCESS',
            1 => 'ERROR',
            2 => 'WARN',
            3 => 'INFO',
            4 => 'DEBUG'
        };

        $consoleMessage = $color . '[' . number_format($since, 6) . '] ' . $message . "\033[0m" . PHP_EOL;
        $logMessage = '[' . number_format($since, 6) . ']['.$label.'] ' . $message . PHP_EOL;

        // Now we have to decide what to do with this message. If F3_LEVEL is <= $level, write to stdout:
        if ($this->level <= $level) {

            // To accommodate STDERR, we'll only write it out there if the level matches
            if ($level === 1) {
                fputs(STDERR, $consoleMessage);
            } else {
                fputs(STDOUT, $consoleMessage);
            }

        }

        // If we have a log file, write it out there as well
        if ($this->logFileHandle !== null) {
            fwrite($this->logFileHandle, $logMessage);
        }

    }
}
