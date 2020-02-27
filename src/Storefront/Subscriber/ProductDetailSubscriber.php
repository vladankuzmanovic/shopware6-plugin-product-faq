<?php declare(strict_types=1);

namespace KuzmanProductFaq\Storefront\Subscriber;

use KuzmanProductFaq\Core\Content\ProductFaq\ProductFaqCollection;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductDetailSubscriber implements EventSubscriberInterface
{
    /**
     * @var SystemConfigService
     */
    private $systemConfigService;

    /**
     * @var EntityRepositoryInterface
     */
    private $productFaqRepository;

    /**
     * ProductDetailSubscriber constructor.
     *
     * @param SystemConfigService $systemConfigService
     * @param EntityRepositoryInterface $productFaqRepository
     */
    public function __construct(
        SystemConfigService $systemConfigService,
        EntityRepositoryInterface $productFaqRepository
    )
    {
        $this->systemConfigService = $systemConfigService;
        $this->productFaqRepository = $productFaqRepository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ProductPageLoadedEvent::class => 'onProductPageLoaded'
        ];
    }

    /**
     * @param ProductPageLoadedEvent $event
     */
    public function onProductPageLoaded(ProductPageLoadedEvent $event): void
    {
        if(!$this->systemConfigService->get('KuzmanProductFaq.config.showInStoreFront')) {
            return;
        }

        $productFaqs = $this->fetchFaqs($event->getContext());
        $event->getPage()->addExtension('kuzman_product_faq', $productFaqs);
    }

    /**
     * Returns product frequently asked question records by certan criteria
     *
     * @param Context $context
     *
     * @return ProductFaqCollection
     * @throws \Shopware\Core\Framework\DataAbstractionLayer\Exception\InconsistentCriteriaIdsException
     */
    private function fetchFaqs(Context $context): ProductFaqCollection
    {
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('active', '1'));
        $criteria->setLimit(5);

        /** @var  ProductFaqCollection $productFaqCollection */
        $productFaqCollection = $this->productFaqRepository->search($criteria, $context)->getEntities();

        return $productFaqCollection;
    }
}
