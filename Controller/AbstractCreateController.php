<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Form\Handler\FormHandlerInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractCreateController extends AbstractController
{
    /*
     * @var object
     */
    protected $objectManager;

    /*
     * @var ProductFormHandlerInterface
     */
    protected $formHandler;

    public function __construct(ConfigurationInterface $configuration, $objectManager, FormHandlerInterface $formHandler)
    {
        parent::__construct($configuration);

        $this->objectManager = $objectManager;
        $this->formHandler = $formHandler;
    }

    public function getForm($object = null)
    {
        $form = $this->formHandler->createForm();
        if (null !== $object) {
            $form->setData($object);
        }

        return $form;
    }

    public function createAction(Request $request)
    {
        $object = $this->createObject();

        if (null !== $response = $this->onPreCreate($object, $request)) {
            return $response;
        }

        $form = $this->getForm($object);
        if ($this->handleForm($form, $request)) {
            if ($this->objectManager->save($object)) {
                $response = $this->onCreateSuccess($object, $request);

                return $this->onCreateCompleted($object, $request, $response);
            }
        }

        return $this->onCreateView(array(
                    'object' => $object
        ), $request);
    }

    public function createFormAction(Request $request)
    {
        $form = $this->getForm();

        return $this->onCreateFormView(array(
                    'form' => $form->createView()
        ), $request);
    }

    protected function handleForm($form, $request)
    {
        return $this->formHandler->handle($form, $request);
    }

    abstract protected function createObject();

    abstract protected function onPreCreate($object, $request);

    abstract protected function onCreateSuccess($object, $request);

    abstract protected function onCreateCompleted($object, $request, $response);

    abstract protected function onCreateView($data, $request);

    abstract protected function onCreateFormView($data, $request);
}
