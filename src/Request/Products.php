<?php

namespace Fypex\DigisellerClient\Request;

use Fypex\DigisellerClient\Denormalizer\Products\Products as ProductsDenormalizer;
use Fypex\DigisellerClient\Digiseller;
use Fypex\DigisellerClient\DigisellerClient;
use Fypex\DigisellerClient\Exception\GeneralException;
use Fypex\DigisellerClient\Filters\ProductsFilter;
use Fypex\DigisellerClient\Models\ProductResponseModel;
use Http\Client\HttpClient;
use Psr\Http\Client\ClientExceptionInterface;

class Products extends DigisellerClient
{

    private $get_products = '/seller-goods';

    public function __construct(?HttpClient $client = null)
    {
        $this->get_products = Digiseller::DEFAULT_URL.$this->get_products;
        parent::__construct($client);

    }

    /**
     * @param ProductsFilter|null $filter
     * @return array<ProductResponseModel>
     * @throws ClientExceptionInterface
     * @throws GeneralException
     */
    public function getProducts(ProductsFilter $filter = null): array
    {

        $body = json_encode([
            "id_seller" => $filter->getIdSeller(),
            "order_col" => $filter->getOrderCol(),
            "order_dir" => $filter->getOrderDir(),
            "rows" => $filter->getRows(),
            "page" => $filter->getPage(),
            "currency" => $filter->getCurrency(),
            "lang" => $filter->getLang(),
        ]);

        $request = $this->messageFactory->createRequest(
            'POST',
            $this->get_products,
            $this->getHeaders(),
            $body
        );



        $response = $this->client->sendRequest($request);
        $data = $this->handleResponse($response);


        return (new ProductsDenormalizer())->denormalize($data);

    }

}

