<?php declare(strict_types=1);

namespace KuzmanProductFaq\Core\Api;

use Faker\Factory;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Core\Framework\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes={"api"})
 */
class DemoDataController extends AbstractController
{
    /**
     * @var EntityRepositoryInterface
     */
    protected $productFaqRepository;

    public function __construct(EntityRepositoryInterface $productFaqRepository)
    {
        $this->productFaqRepository = $productFaqRepository;
    }

    /**
     * @Route("/api/v{version}/_action/kuzman_product_faq/generate", name="api.custom.kuman_product_faq.generate", methods={"POST"})
     * @param Context $context
     *
     * @return Response
     */
    public function generate(Context $context): Response
    {
        $faker = Factory::create();
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'id' => Uuid::randomHex(),
                'active' => true,
                'email' => $faker->email,
                'nickname' => $faker->name,
                'question' => $faker->sentences,
                'answer' => $faker->sentences,
                'product' => $faker->randomAscii
            ];
        }

        $this->productFaqRepository->create($data, $context);

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
