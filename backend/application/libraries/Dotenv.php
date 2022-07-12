<?php
class Dotenv
{
    /**
     * The directory where the .env file can be located.
     *
     * @var string
     */
    protected $path;


    public function __construct( $filepath = null )
    {
        if ( is_null($filepath) ) {
            $fileenv = (file_exists(dirname(FCPATH) . DIRECTORY_SEPARATOR . '.env')) ? dirname(FCPATH) . DIRECTORY_SEPARATOR . '.env' : FCPATH . DIRECTORY_SEPARATOR . '.env';
            $path = $fileenv;
        } else {
            $filepath = str_replace('.env', '', $filepath);
            $path = $filepath . DIRECTORY_SEPARATOR . '.env';
        }

        if (!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        $this->path = $path;
    }

    public function load(): void
    {
        if (!is_readable($this->path)) {
            throw new \RuntimeException(sprintf('%s file is not readable', $this->path));
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}
