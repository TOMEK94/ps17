<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'prestashop.core.language.pack.loader.remote' shared service.

return $this->services['prestashop.core.language.pack.loader.remote'] = new \PrestaShop\PrestaShop\Core\Language\Pack\Loader\RemoteLanguagePackLoader(${($_ = isset($this->services['prestashop.core.foundation.version']) ? $this->services['prestashop.core.foundation.version'] : $this->load('getPrestashop_Core_Foundation_VersionService.php')) && false ?: '_'});
