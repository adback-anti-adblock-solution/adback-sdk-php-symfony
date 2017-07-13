<?php

namespace Adback\ApiClientBundle\Twig;

use Adback\ApiClient\Generator\AnalyticsScriptGenerator;
use Adback\ApiClient\Generator\MessageScriptGenerator;
use Adback\ApiClient\Generator\AutopromoBannerScriptGenerator;

/**
 * Class ScriptExtension
 */
class ScriptExtension extends \Twig_Extension
{
    protected $analyticsGenerator;
    protected $messageGenerator;
    protected $autopromoBannerGenerator;

    /**
     * @param AnalyticsScriptGenerator          $analyticsScriptGenerator
     * @param MessageScriptGenerator            $messageScriptGenerator
     * @param AutopromoBannerScriptGenerator    $autopromoBannerScriptGenerator
     */
    public function __construct(AnalyticsScriptGenerator $analyticsScriptGenerator, MessageScriptGenerator $messageScriptGenerator, AutopromoBannerScriptGenerator $autopromoBannerScriptGenerator)
    {
        $this->analyticsGenerator = $analyticsScriptGenerator;
        $this->messageGenerator = $messageScriptGenerator;
        $this->autopromoBannerGenerator = $autopromoBannerScriptGenerator;
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
     * @return string
     */
    public function generateAutopromoBannerScript()
    {
        return sprintf('<script>%s</script>', $this->autopromoBannerGenerator->generate());
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('adback_generate_scripts', [$this, 'generateScripts'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('adback_generate_autopromo_banner_script', [$this, 'generateAutopromoBannerScript'], ['is_safe' => ['html']]),
        ];
    }
}
