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
    protected $manager;

    /*
     * @var ProductFormHandlerInterface
     */
    protected $formHandler;
    
    /*
     * @var string
     */
    protected $createTemplate = 'create';
    
    /*
     * @var string
     */
    protected $createFormTemplate = 'create_form';

    /**
     * 
     * @param ConfigurationInterface $configuration
     * @param mixed $manager
     * @param FormHandlerInterface $formHandler
     */
    public function __construct(ConfigurationInterface $configuration, $manager, FormHandlerInterface $formHandler)
    {
        parent::__construct($configuration);

        $this->manager = $manager;
        $this->formHandler = $formHandler;
    }

    /**
     * 
     * @param mixed $model
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createForm($model = null)
    {
        $form = $this->formHandler->createForm();
        if (null !== $model) {
            $form->setData($model);
        }

        return $form;
    }

    /**
     * 
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $model = $this->createModel();

        if (null !== $response = $this->onPreCreate($model, $request)) {
            return $response;
        }

        $form = $this->createForm($model);
        if ($this->handleForm($form, $request)) {
            if ($this->manager->save($model)) {
                $response = $this->onCreateSuccess($model, $request);

                return $this->onCreateCompleted($model, $request, $response);
            }
        }

        return $this->onCreateView(array(
                    'form' => $form->createView()
        ), $request);
    }

    /**
     * 
     * @param Request $request
     * @return Response
     */
    public function createFormAction(Request $request)
    {
        $form = $this->createForm();

        return $this->onCreateFormView(array(
                    'form' => $form->createView()
        ), $request);
    }

    /**
     * 
     * @param \Symfony\Component\Form\FormInterface $form
     * @param Request $request
     * @return bool
     */
    protected function handleForm($form, Request $request)
    {
        return $this->formHandler->handle($form, $request);
    }
    
    /**
     * 
     * @param array $parameters
     * @param Request|null $request
     * @return Response
     */
    protected function onCreateView(array $parameters = array(), Request $request = null)
    {
        return $this->render($this->createTemplate, $parameters);
    }

    /**
     * 
     * @param array $parameters
     * @param Request|null $request
     * @return Response
     */
    protected function onCreateFormView(array $parameters = array(), Request $request = null)
    {
        return $this->render($this->createFormTemplate, $parameters);
    }

    /**
     * @return mixed
     */
    abstract protected function createModel();

    /**
     * @param mixed $model
     * @param Request $request
     */
    abstract protected function onPreCreate($model, Request $request);

    /**
     * @param mixed $model
     * @param Request $request
     */
    abstract protected function onCreateSuccess($model, Request $request);

    /**
     * @param mixed $model
     * @param Request $request
     * @param Response $response
     */
    abstract protected function onCreateCompleted($model, Request $request, Response $response);
}
