<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Pagination\Sorter\Strategy;

use Xidea\Bundle\BaseBundle\Pagination\SorterStrategyInterface;
use Doctrine\ORM\QueryBuilder as DoctrineORMQueryBuilder;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class QueryBuilderStrategy implements SorterStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function sort($target, $keys, $directions)
    {
        foreach($keys as $key) {
            $target->addOrderBy($key, $directions[$key]);
        }
    }

    /**
     * @inheritDoc
     */
    public function support($target)
    {
        return $target instanceof DoctrineORMQueryBuilder;
    }

}
