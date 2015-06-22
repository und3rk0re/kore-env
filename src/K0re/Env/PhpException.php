<?php

namespace K0re\Env;

/**
 * Class PhpException
 *
 * Base class for all PHP exceptions
 */
class PhpException extends \Exception
{
    private $errorFile;
    private $errorLine;
    private $errorContext;

    /**
     * Constructor
     *
     * @param int    $errorCode
     * @param string $errorDescription
     * @param string $errorFile
     * @param int    $errorLine
     * @param array  $errorContext
     */
    public function __construct($errorCode, $errorDescription, $errorFile, $errorLine, array $errorContext = array())
    {
        parent::__construct(
            sprintf(
                'PHP error [%s] [%s] occurred in %s at line %s',
                $errorCode,
                $errorDescription,
                $errorFile,
                $errorLine
            ),
            $errorCode
        );

        $this->errorContext = $errorContext;
        $this->errorFile    = $errorFile;
        $this->errorLine    = $errorLine;
    }

    /**
     * Returns error context
     *
     * @return array
     */
    public function getErrorContext()
    {
        return $this->errorContext;
    }

    /**
     * Returns error file name
     *
     * @return string
     */
    public function getErrorFileName()
    {
        return $this->errorFile;
    }

    /**
     * Returns error line number
     *
     * @return int
     */
    public function getErrorLine()
    {
        return $this->errorLine;
    }
}
