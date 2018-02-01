<?php

namespace Adback\ApiClientBundle\Twig;

use Adback\ApiClient\Generator\ScriptGeneratorInterface;

/**
 * Class ScriptExtension
 */
class ScriptExtension extends \Twig_Extension
{
    protected $productGenerator;
    protected $messageGenerator;
    protected $analyticsGenerator;
    protected $iabBannerGenerator;
    protected $autopromoBannerGenerator;

    /**
     * @param ScriptGeneratorInterface $analyticsScriptGenerator
     * @param ScriptGeneratorInterface $messageScriptGenerator
     * @param ScriptGeneratorInterface $autopromoBannerScriptGenerator
     * @param ScriptGeneratorInterface $iabBannerScriptGenerator
     * @param ScriptGeneratorInterface $productScriptGenerator
     */
    public function __construct(
        ScriptGeneratorInterface $analyticsScriptGenerator,
        ScriptGeneratorInterface $messageScriptGenerator,
        ScriptGeneratorInterface $autopromoBannerScriptGenerator,
        ScriptGeneratorInterface $iabBannerScriptGenerator,
        ScriptGeneratorInterface $productScriptGenerator
    ) {
        $this->productGenerator = $productScriptGenerator;
        $this->messageGenerator = $messageScriptGenerator;
        $this->analyticsGenerator = $analyticsScriptGenerator;
        $this->autopromoBannerGenerator = $autopromoBannerScriptGenerator;
        $this->iabBannerGenerator = $iabBannerScriptGenerator;
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
    public function generateIabBannerScript()
    {
        return sprintf('<script>%s</script>', $this->iabBannerGenerator->generate());
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
            new \Twig_SimpleFunction('adback_generate_iab_banner_script', [$this, 'generateIabBannerScript'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('adback_generate_product_script', [$this, 'generateProductScript'], ['is_safe' => ['html']]),
        ];
    }
}
