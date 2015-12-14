<?php

namespace Xidea\Bundle\BaseBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Xidea\Base\Model\LoaderInterface;

class ModelToIdTransformer implements DataTransformerInterface
{

    /**
     * @var LoaderInterface
     */
    private $loader;

    /**
     * @param LoaderInterface $loader
     */
    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * Transforms a model to a string (id).
     *
     * @param  object|null $model
     * @return string
     */
    public function transform($model)
    {
        if (null === $model) {
            return null;
        }

        return $model->getId();
    }

    /**
     * Transforms a string (id) to a model.
     *
     * @param  string $id
     *
     * @return object|null
     *
     * @throws TransformationFailedException if model is not found.
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $model = $this->loader->load($id);

        if (null === $model) {
            return null;
            // throw new TransformationFailedException(sprintf(
            // 'An user with id "%s" does not exist!',
            // $id
            // ));
        }

        return $model;
    }

}
