<?php

namespace Fypex\DigisellerClient\Request;

use Fypex\DigisellerClient\Credentials\DigisellerCredentials;
use Fypex\DigisellerClient\Denormalizer\Products\Products as ProductsDenormalizer;

use Fypex\DigisellerClient\Denormalizer\Products\RemoveContentDenormalizer;
use Fypex\DigisellerClient\Denormalizer\Products\UploadKeysDenormalizer;
use Fypex\DigisellerClient\Digiseller;
use Fypex\DigisellerClient\DigisellerClient;
use Fypex\DigisellerClient\Exception\GeneralException;
use Fypex\DigisellerClient\Filters\ProductsFilter;
use Fypex\DigisellerClient\Models\Key;
use Fypex\DigisellerClient\Models\ProductResponseModel;
use Fypex\DigisellerClient\Models\Products\UpdateProduct;
use Fypex\DigisellerClient\Models\RemoveContentResponseModel;
use Fypex\DigisellerClient\Models\UploadKeysResponseModel;
use Fypex\DigisellerClient\Traits\TUrls;
use Http\Client\HttpClient;
use Psr\Http\Client\ClientExceptionInterface;

class Products extends DigisellerClient
{

    use TUrls;

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

    public function updateProduct(UpdateProduct $model): bool
    {

        $params = [
            "enabled" => $model->getEnabled()
        ];

        $uri = Digiseller::DEFAULT_URL.str_replace([
                '{product_id}',
                '{token}'
            ], [
                $model->getProductId(),
                $this->token
            ], $this->toggle_product);

        $request = $this->messageFactory->createRequest(
            'POST',
            $uri,
            $this->getHeaders(),
            json_encode($params)
        );

        $response = $this->client->sendRequest($request);

        $result = $this->handleResponse($response);

        if (empty($result['errors'])) {
            return true;
        }

        return false;
    }

//    public function getDescription($product_id): array
//    {
//
//        $uri = Digiseller::DEFAULT_URL.str_replace('{product_id}', $product_id, $this->product_description);
//
//        $request = $this->messageFactory->createRequest(
//            'GET',
//            $uri,
//            $this->getHeaders(),
//        );
//
//        $response = $this->client->sendRequest($request);
//
//        return $this->handleResponse($response);
//
//    }

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

    /**
     * @param int $product_id
     * @return RemoveContentResponseModel
     * @throws ClientExceptionInterface
     * @throws GeneralException
     */
    public function removeAllContent(int $product_id): RemoveContentResponseModel
    {
        $params = [
            "product_id" => $product_id,
        ];

        $url = Digiseller::DEFAULT_URL.str_replace([
                '{product_id}',
                '{token}',
            ], [
                $product_id,
                $this->token
            ], $this->delete_content);

        $request = $this->messageFactory->createRequest(
            'GET',
            $url,
            $this->getHeaders(),
            json_encode($params)
        );

        $response = $this->client->sendRequest($request);
        $data = $this->handleResponse($response);

        return (new RemoveContentDenormalizer())->denormalize($data);

    }

}

