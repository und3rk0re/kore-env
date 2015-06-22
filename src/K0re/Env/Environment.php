<?php

namespace K0re\Env;

class Environment
{
    /**
     * Establishes environment with:
     * - PHP errors wrapped into exceptions
     * - UTC time zone
     * - UTF-8 as default multibyte encoding
     *
     * @throws \Exception
     */
    public static function SetupDefault()
    {
        $e = new Environment();
        $e->setupExceptions();
        $e->setupMultibyte('UTF-8');
        $e->setupTimezone('UTC');
    }

    public function setupTimezone($timeZone)
    {
        if (!date_default_timezone_set($timeZone)) {
            throw new \Exception("Unable to setup timezone {$timeZone}");
        }
    }

    public function setupMultibyte($encoding)
    {
        if (function_exists('mb_internal_encoding')) {
            if (!mb_internal_encoding($encoding)) {
                throw new \Exception("Unable to setup default encoding {$encoding}");
            }
        }
    }

    public function setupExceptions()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 0);
        set_error_handler(array($this, 'throwOnError'), E_ALL);
    }

    public function throwOnError($errorCode, $errorDescription, $errorFile, $errorLine, array $errorContext = array()) {
        throw new PhpException($errorCode, $errorDescription, $errorFile, $errorLine, $errorContext);
    }
}
