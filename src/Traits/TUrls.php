<?php


namespace Fypex\DigisellerClient\Traits;


trait TUrls
{

    private $get_products = '/seller-goods';
    private $upload_products = 'product/content/add/text?token={token}';
    private $product_description = 'products/{product_id}/data';
    private $toggle_product = 'product/edit/base/{product_id}?token={token}';
    private $delete_content = 'product/content/delete/all?productid={product_id}&token={token}';

}
