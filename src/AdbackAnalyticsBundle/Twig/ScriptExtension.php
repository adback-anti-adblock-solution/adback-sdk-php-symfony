<?php

namespace Dekalee\AdbackAnalyticsBundle\Twig;

use Dekalee\AdbackAnalytics\Generator\AnalyticsScriptGenerator;
use Dekalee\AdbackAnalytics\Generator\MessageScriptGenerator;

/**
 * Class ScriptExtension
 */
class ScriptExtension extends \Twig_Extension
{
    protected $analyticsGenerator;
    protected $messageGenerator;

    /**
     * @param AnalyticsScriptGenerator $analyticsScriptGenerator
     * @param MessageScriptGenerator   $messageScriptGenerator
     */
    public function __construct(AnalyticsScriptGenerator $analyticsScriptGenerator, MessageScriptGenerator $messageScriptGenerator)
    {
        $this->analyticsGenerator = $analyticsScriptGenerator;
        $this->messageGenerator = $messageScriptGenerator;
    }

    /**
     * @return string
     */
    public function generateScripts()
    {
        return sprintf('<script>%s</script><script>%s</script>',
            $this->analyticsGenerator->generate(),
            $this->messageGenerator->generate()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('adback_generate_scripts', [$this, 'generateScripts'], ['is_safe' => ['html']]),
        ];
    }
}
