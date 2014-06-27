<?php

namespace Simonsimcity\GetId3Bundle\Wrapper\Write;

use Symfony\Component\Stopwatch\Stopwatch;

class Tags extends \GetId3\Write\Tags
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        Stopwatch $stopwatch
    ) {
        $this->stopwatch = $stopwatch;

        $e = $this->stopwatch->start('Write/Tags::__construct', 'get_id3');
        parent::__construct();
        $e->stop();
    }

    private function call($method, $arguments = array())
    {
        switch ($method) {
            case "WriteTags":
                $name = $method . ": " . $this->filename;
                break;
            default:
                $name = $method;
        }

        $t = $this->stopwatch->start('Write/Tags::' . $name, 'get_id3');

        try {
            $result = call_user_func_array(array($this, "parent::{$method}"), $arguments);
        } catch (\Exception $e) {
            $t->stop();
            throw $e;
        }

        $t->stop();

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function WriteTags()
    {
        return $this->call(__FUNCTION__, func_get_args());
    }
}
