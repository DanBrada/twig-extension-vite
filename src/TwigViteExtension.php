<?php

namespace DanBrada\TwigVite;


use mindplay\vite\Manifest;
use mindplay\vite\Manifest as ViteManifest;
use Twig\Extension\AbstractExtension as AbstractTwigExtension;
use Twig\Extension\GlobalsInterface as TwigGlobalsInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigViteExtension extends AbstractTwigExtension implements TwigGlobalsInterface
{
    private ViteManifest $manifest;

    public function __construct(
        string         $manifestPath,
        private string $basePath = "/",
        private string $devServer = "http://localhost:5173",
        private bool   $devMode = false
    )
    {
        $this->manifest = new Manifest($this->devMode, $manifestPath, $this->devMode ? $this->devServer . $this->basePath : $this->basePath);
    }

    private function getStyles(string ...$entries): string
    {
        return $this->manifest->createTags($entries)->css;
    }

    private function getScripts(string ...$entries): string
    {
        return $this->manifest->createTags($entries)->js;
    }

    private function getPreloads(string ...$entries): string
    {
        return $this->manifest->createTags($entries)->preload;
    }


    public function getFunctions(): array
    {
        return [
            new TwigFunction("vite_url", [$this->manifest, "getURL"]),
            new TwigFunction("vite_styles", [$this, "getStyles"]),
            new TwigFunction("vite_preloads", [$this, "getPreloads"]),
            new TwigFunction("vite_scripts", [$this, "getScripts"]),
        ];
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter("vite", [$this->manifest, "getURL"])
        ];
    }

    public function getGlobals(): array
    {
        return [
            "vite" => [
                "devMode" => $this->devMode,
                "basePath" => $this->basePath,
                "devServer" => $this->devServer
            ]
        ];
    }
}