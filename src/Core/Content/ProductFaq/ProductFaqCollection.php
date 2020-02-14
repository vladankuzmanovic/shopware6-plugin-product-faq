<?php declare(strict_types=1);

namespace KuzmanProductFaq\Core\Content\ProductFaq;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void              add(ProductFaqEntity $entity)
 * @method void              set(string $key, ProductFaqEntity $entity)
 * @method ProductFaqEntity[]    getIterator()
 * @method ProductFaqEntity[]    getElements()
 * @method ProductFaqEntity|null get(string $key)
 * @method ProductFaqEntity|null first()
 * @method ProductFaqEntity|null last()
 */
class ProductFaqCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return ProductFaqEntity::class;
    }
}
