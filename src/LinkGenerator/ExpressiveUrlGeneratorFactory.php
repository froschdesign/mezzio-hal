<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-hal for the canonical source repository
 * @copyright Copyright (c) 2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-hal/blob/master/LICENSE.md New BSD License
 */

namespace Zend\Expressive\Hal\LinkGenerator;

use Psr\Container\ContainerInterface;
use RuntimeException;
use Zend\Expressive\Helper\ServerUrlHelper;
use Zend\Expressive\Helper\UrlHelper;

class ExpressiveUrlGeneratorFactory
{
    public function __invoke(ContainerInterface $container) : ExpressiveUrlGenerator
    {
        if (! $container->has(UrlHelper::class)) {
            throw new RuntimeException(sprintf(
                '%s requires a %s in order to generate a %s instance; none found',
                __CLASS__,
                UrlHelper::class,
                ExpressiveUrlGenerator::class
            ));
        }

        return new ExpressiveUrlGenerator(
            $container->get(UrlHelper::class),
            $container->has(ServerUrlHelper::class) ? $container->get(ServerUrlHelper::class) : null
        );
    }
}
