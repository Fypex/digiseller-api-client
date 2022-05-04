<?php

namespace Fypex\DigisellerClient\Request;

use Fypex\DigisellerClient\Credentials\DigisellerCredentials;
use Fypex\DigisellerClient\Denormalizer\Products\Products as ProductsDenormalizer;

use Fypex\DigisellerClient\Denormalizer\Products\UploadKeysDenormalizer;
use Fypex\DigisellerClient\Digiseller;
use Fypex\DigisellerClient\DigisellerClient;
use Fypex\DigisellerClient\Exception\GeneralException;
use Fypex\DigisellerClient\Filters\ProductsFilter;
use Fypex\DigisellerClient\Models\Key;
use Fypex\DigisellerClient\Models\ProductResponseModel;
use Fypex\DigisellerClient\Models\UploadKeysResponseModel;
use Http\Client\HttpClient;
use Psr\Http\Client\ClientExceptionInterface;
use function Couchbase\defaultDecoder;

class Products extends DigisellerClient
{

    private $get_products = '/seller-goods';
    private $upload_products = 'product/content/add/text?token={token}';


    public function __construct(DigisellerCredentials $credentials, ?HttpClient $client = null)
    {
        $this->get_products = Digiseller::DEFAULT_URL.$this->get_products;
        parent::__construct($credentials, $client);

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

    /**
     * @param int $product_id
     * @param Key[] $keys
     * @return UploadKeysResponseModel
     */
    public function uploadKeys(int $product_id, array $keys): UploadKeysResponseModel
    {

        $params = [
            "product_id" => $product_id,
            "content" => []
        ];

        foreach ($keys as $key){
            array_push($params['content'], $key->toArray());
        }

        $request = $this->messageFactory->createRequest(
            'POST',
            Digiseller::DEFAULT_URL.str_replace('{token}', $this->token, $this->upload_products),
            $this->getHeaders(),
            json_encode($params)
        );

        $response = $this->client->sendRequest($request);
        $data = $this->handleResponse($response);

        return (new UploadKeysDenormalizer())->denormalize($data);

    }

}

