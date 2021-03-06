<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Form\Factory;

use Symfony\Component\Form\FormFactoryInterface as SfFormFactoryInterface;

/**
 * Description of FormFactory
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class FormFactory implements FormFactoryInterface
{
    private $formFactory;
    private $name;
    private $type;
    private $validationGroups;

    public function __construct(SfFormFactoryInterface $formFactory, $name, $type, array $validationGroups = null)
    {
        $this->formFactory = $formFactory;
        $this->name = $name;
        $this->type = $type;
        $this->validationGroups = $validationGroups;
    }

    public function create()
    {
        return $this->formFactory->createNamed($this->name, $this->type, null, array('validation_groups' => $this->validationGroups));
    }
}
