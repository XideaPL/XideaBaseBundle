<?php

namespace Xidea\Bundle\BaseBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Xidea\Component\Base\Loader\ModelLoaderInterface;

class ModelToIdTransformer implements DataTransformerInterface
{

    /**
     * @var ModelLoaderInterface
     */
    private $modelLoader;

    /**
     * @param ModelLoaderInterface $modelLoader
     */
    public function __construct(ModelLoaderInterface $modelLoader)
    {
        $this->modelLoader = $modelLoader;
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

        $model = $this->modelLoader->find($id);

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
