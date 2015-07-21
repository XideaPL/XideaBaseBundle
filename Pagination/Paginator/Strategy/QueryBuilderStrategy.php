<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BaseBundle\Pagination\Paginator\Strategy;

use Xidea\Bundle\BaseBundle\Pagination\PaginatorStrategyInterface;
use Doctrine\DBAL\Query\QueryBuilder as DoctrineQueryBuilder;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class QueryBuilderStrategy implements PaginatorStrategyInterface
{
    /*
     * @var int
     */
    protected $total = 0;

    /**
     * @inheritDoc
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @inheritDoc
     */
    public function paginate($target, $offset, $limit)
    {
        $sql = $target->getSQL();

        $qb = clone $target;
        $qb
            ->resetQueryParts()
            ->select('count(*) as xpc')
            ->from('(' . $sql . ')', 'xidea_pagination_count')
        ;
        $this->total = $qb
            ->execute()
            ->fetchColumn(0)
        ;

        if ($this->total) {
            $qb = clone $target;
            $qb
                ->setFirstResult($offset)
                ->setMaxResults($limit)
            ;

            return $qb
                ->execute()
                ->fetchAll()
            ;
        }
        
        return array();
    }

    /**
     * @inheritDoc
     */
    public function support($target)
    {
        return $target instanceof DoctrineQueryBuilder;
    }

}
