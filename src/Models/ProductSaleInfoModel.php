<?php

namespace Fypex\DigisellerClient\Models;

class ProductSaleInfoModel extends Model
{

    /**
     * @var mixed
     */
    protected $common_base_price;
    /**
     * @var mixed
     */
    protected $common_price_usd;
    /**
     * @var mixed
     */
    protected $common_price_rur;
    /**
     * @var mixed
     */
    protected $common_price_eur;
    /**
     * @var mixed
     */
    protected $common_price_uah;
    /**
     * @var mixed
     */
    protected $sale_end;
    /**
     * @var mixed
     */
    protected $sale_percent;

    public function __construct($data)
    {
        $this->common_base_price = $data['common_base_price'];
        $this->common_price_usd = $data['common_price_usd'];
        $this->common_price_rur = $data['common_price_rur'];
        $this->common_price_eur = $data['common_price_eur'];
        $this->common_price_uah = $data['common_price_uah'];
        $this->sale_end = $data['sale_end'];
        $this->sale_percent = $data['sale_percent'];
    }

    public function getCommonBasePrice()
    {
        return $this->common_base_price;
    }

    /**
     * @return mixed
     */
    public function getCommonPriceUsd()
    {
        return $this->common_price_usd;
    }

    /**
     * @return mixed
     */
    public function getCommonPriceRur()
    {
        return $this->common_price_rur;
    }

    /**
     * @return mixed
     */
    public function getCommonPriceEur()
    {
        return $this->common_price_eur;
    }

    /**
     * @return mixed
     */
    public function getCommonPriceUah()
    {
        return $this->common_price_uah;
    }

    /**
     * @return mixed
     */
    public function getSaleEnd()
    {
        return $this->sale_end;
    }

    /**
     * @return mixed
     */
    public function getSalePercent()
    {
        return $this->sale_percent;
    }

}
