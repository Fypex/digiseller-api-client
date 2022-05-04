<?php

namespace Fypex\DigisellerClient\Models;

class ProductResponseModel extends Model
{

    protected $id;
    protected $name;
    protected $description;
    /**
     * @var mixed
     */
    protected $add_info;
    /**
     * @var mixed
     */
    protected $currency;
    /**
     * @var mixed
     */
    protected $cnt_sell;
    /**
     * @var mixed
     */
    protected $price;
    /**
     * @var mixed
     */
    protected $cnt_sell_hidden;
    /**
     * @var mixed
     */
    protected $cnt_return;
    /**
     * @var mixed
     */
    protected $cnt_return_hidden;
    /**
     * @var mixed
     */
    protected $cnt_goodresponses;
    /**
     * @var mixed
     */
    protected $cnt_goodresponses_hidden;
    /**
     * @var mixed
     */
    protected $cnt_badresponses;
    /**
     * @var mixed
     */
    protected $cnt_badresponses_hidden;
    /**
     * @var mixed
     */
    protected $price_usd;
    /**
     * @var mixed
     */
    protected $price_rur;
    /**
     * @var mixed
     */
    protected $price_eur;
    /**
     * @var mixed
     */
    protected $price_uah;
    /**
     * @var mixed
     */
    protected $in_stock;
    /**
     * @var int
     */
    protected $num_in_stock;
    /**
     * @var mixed
     */
    protected $commiss_agent;
    /**
     * @var mixed
     */
    protected $release_date;
    /**
     * @var mixed
     */
    protected $has_discount;
    /**
     * @var mixed
     */
    protected $sale_info;


    public function __construct($data)
    {

        $this->id = $data['id_goods'];
        $this->name = $data['name_goods'];
        $this->description = $data['info_goods'];
        $this->add_info = $data['add_info'];
        $this->price = $data['price'];
        $this->currency = $data['currency'];
        $this->cnt_sell = $data['cnt_sell'];
        $this->cnt_sell_hidden = $data['cnt_sell_hidden'];
        $this->cnt_return = $data['cnt_return'];
        $this->cnt_return_hidden = $data['cnt_return_hidden'];
        $this->cnt_goodresponses = $data['cnt_goodresponses'];
        $this->cnt_goodresponses_hidden = $data['cnt_goodresponses_hidden'];
        $this->cnt_badresponses = $data['cnt_badresponses'];
        $this->cnt_badresponses_hidden = $data['cnt_badresponses_hidden'];

        $this->price_usd = new Price($data['price_usd']);
        $this->price_rur = new Price($data['price_rur']);
        $this->price_eur = new Price($data['price_eur']);
        $this->price_uah = new Price($data['price_uah']);

        $this->in_stock = $data['in_stock'];
        $this->num_in_stock = $data['num_in_stock'] ?? 0;

        $this->commiss_agent = $data['commiss_agent'];
        $this->has_discount = $data['has_discount'];
        $this->release_date = $data['release_date'];
        $this->sale_info = new ProductSaleInfoModel($data['sale_info']);

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getAddInfo()
    {
        return $this->add_info;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getCntSell()
    {
        return $this->cnt_sell;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getCntSellHidden()
    {
        return $this->cnt_sell_hidden;
    }

    /**
     * @return mixed
     */
    public function getCntReturn()
    {
        return $this->cnt_return;
    }

    /**
     * @return mixed
     */
    public function getCntReturnHidden()
    {
        return $this->cnt_return_hidden;
    }

    /**
     * @return mixed
     */
    public function getCntGoodresponses()
    {
        return $this->cnt_goodresponses;
    }

    /**
     * @return mixed
     */
    public function getCntGoodresponsesHidden()
    {
        return $this->cnt_goodresponses_hidden;
    }

    /**
     * @return mixed
     */
    public function getCntBadresponses()
    {
        return $this->cnt_badresponses;
    }

    /**
     * @return mixed
     */
    public function getCntBadresponsesHidden()
    {
        return $this->cnt_badresponses_hidden;
    }

    /**
     * @return mixed
     */
    public function getPriceUsd(): Price
    {
        return $this->price_usd;
    }

    /**
     * @return mixed
     */
    public function getPriceRur(): Price
    {
        return $this->price_rur;
    }

    /**
     * @return mixed
     */
    public function getPriceEur(): Price
    {
        return $this->price_eur;
    }

    /**
     * @return mixed
     */
    public function getPriceUah(): Price
    {
        return $this->price_uah;
    }

    /**
     * @return mixed
     */
    public function getInStock()
    {
        return $this->in_stock;
    }

    /**
     * @return int
     */
    public function getNumInStock(): int
    {
        return $this->num_in_stock;
    }
    /**
     * @return mixed
     */
    public function getCommissAgent()
    {
        return $this->commiss_agent;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->release_date;
    }

    /**
     * @return mixed
     */
    public function getHasDiscount()
    {
        return $this->has_discount;
    }

    /**
     * @return mixed
     */
    public function getSaleInfo(): ProductSaleInfoModel
    {
        return $this->sale_info;
    }


}
