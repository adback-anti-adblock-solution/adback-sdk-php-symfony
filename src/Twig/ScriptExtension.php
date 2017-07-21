<?php

namespace Adback\ApiClientBundle\Twig;

use Adback\ApiClient\Generator\AnalyticsScriptGenerator;
use Adback\ApiClient\Generator\MessageScriptGenerator;
use Adback\ApiClient\Generator\AutopromoBannerScriptGenerator;
use Adback\ApiClient\Generator\ProductScriptGenerator;

/**
 * Class ScriptExtension
 */
class ScriptExtension extends \Twig_Extension
{
    protected $productGenerator;
    protected $messageGenerator;
    protected $analyticsGenerator;
    protected $autopromoBannerGenerator;

    /**
     * @param AnalyticsScriptGenerator       $analyticsScriptGenerator
     * @param MessageScriptGenerator         $messageScriptGenerator
     * @param AutopromoBannerScriptGenerator $autopromoBannerScriptGenerator
     * @param ProductScriptGenerator         $productScriptGenerator
     */
    public function __construct(
        AnalyticsScriptGenerator $analyticsScriptGenerator,
        MessageScriptGenerator $messageScriptGenerator,
        AutopromoBannerScriptGenerator $autopromoBannerScriptGenerator,
        ProductScriptGenerator $productScriptGenerator
    ) {
        $this->productGenerator = $productScriptGenerator;
        $this->messageGenerator = $messageScriptGenerator;
        $this->analyticsGenerator = $analyticsScriptGenerator;
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
     * @return string
     */
    public function generateProductScript()
    {
        return sprintf('<script>%s</script>', $this->productGenerator->generate());
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('adback_generate_scripts', [$this, 'generateScripts'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('adback_generate_autopromo_banner_script', [$this, 'generateAutopromoBannerScript'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('adback_generate_product_script', [$this, 'generateProductScript'], ['is_safe' => ['html']]),
        ];
    }
}
