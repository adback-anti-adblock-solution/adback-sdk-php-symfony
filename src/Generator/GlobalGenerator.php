<?php

namespace Adback\ApiClientBundle\Generator;

use Adback\ApiClient\Generator\ScriptGeneratorInterface;

/**
 * Class GlobalGenerator
 */
class GlobalGenerator
{
    protected $generators = [];

    /**
     * @return string
     */
    public function generate()
    {
        $code = '';

        /** @var ScriptGeneratorInterface $generator */
        foreach ($this->generators as $generator)
        {
            $generated = $generator->generate();
            if (strlen($generated) > 0) {
                $code .= sprintf("<script>%s</script>", $generated);
            }
        }

        return $code;
    }

    /**
     * @param ScriptGeneratorInterface $generator
     */
    public function addGenerator(ScriptGeneratorInterface $generator)
    {
        $this->generators[] = $generator;
    }
}
