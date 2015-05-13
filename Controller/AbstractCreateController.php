<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Form\Handler\FormHandlerInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractCreateController extends AbstractController
{
    /*
     * @var model
     */
    protected $modelManager;

    /*
     * @var ProductFormHandlerInterface
     */
    protected $formHandler;

    public function __construct(ConfigurationInterface $configuration, $modelManager, FormHandlerInterface $formHandler)
    {
        parent::__construct($configuration);

        $this->modelManager = $modelManager;
        $this->formHandler = $formHandler;
    }

    public function getForm($model = null)
    {
        $form = $this->formHandler->createForm();
        if (null !== $model) {
            $form->setData($model);
        }

        return $form;
    }

    public function createAction(Request $request)
    {
        $model = $this->createModel();

        if (null !== $response = $this->onPreCreate($model, $request)) {
            return $response;
        }

        $form = $this->getForm($model);
        if ($this->handleForm($form, $request)) {
            if ($this->modelManager->save($model)) {
                $response = $this->onCreateSuccess($model, $request);

                return $this->onCreateCompleted($model, $request, $response);
            }
        }

        return $this->onCreateView(array(
                    'form' => $form->createView()
        ), $request);
    }

    public function createFormAction(Request $request)
    {
        $form = $this->getForm();

        return $this->onCreateFormView(array(
                    'form' => $form->createView()
        ), $request);
    }

    protected function handleForm($form, Request $request)
    {
        return $this->formHandler->handle($form, $request);
    }
    
    protected function onCreateView(array $parameters = array(), Request $request = null)
    {
        return $this->render($this->getTemplateConfiguration()->getTemplate('create'), $parameters);
    }

    protected function onCreateFormView(array $parameters = array(), Request $request = null)
    {
        return $this->render($this->getTemplateConfiguration()->getTemplate('create_form'), $parameters);
    }

    abstract protected function createModel();

    abstract protected function onPreCreate($model, Request $request);

    abstract protected function onCreateSuccess($model, Request $request);

    abstract protected function onCreateCompleted($model, Request $request, Response $response);
}
