<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface TemplateConfigurationInterface
{
    /**
     * Returns a template.
     *
     * @return string
     */
    public function getTemplate($name, $format = 'html');
}
