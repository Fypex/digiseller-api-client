<?php

namespace Fypex\DigisellerClient\Filters;

class ProductsFilter
{

    private $id_seller = 0;
    private $order_col = 'cntsell';
    private $order_dir = 'desc';
    private $rows = 10;
    private $page = 1;
    private $currency;
    private $lang = "ru-RU";

    /**
     * @return int
     */
    public function getIdSeller(): int
    {
        return $this->id_seller;
    }

    /**
     * @param int $id_seller
     */
    public function setIdSeller(int $id_seller): void
    {
        $this->id_seller = $id_seller;
    }

    /**
     * @return string
     */
    public function getOrderCol(): string
    {
        return $this->order_col;
    }

    /**
     * @param string $order_col
     */
    public function setOrderCol(string $order_col): void
    {
        $this->order_col = $order_col;
    }

    /**
     * @return string
     */
    public function getOrderDir(): string
    {
        return $this->order_dir;
    }

    /**
     * @param string $order_dir
     */
    public function setOrderDir(string $order_dir): void
    {
        $this->order_dir = $order_dir;
    }

    /**
     * @return int
     */
    public function getRows(): int
    {
        return $this->rows;
    }

    /**
     * @param int $rows
     */
    public function setRows(int $rows): void
    {
        $this->rows = $rows;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     */
    public function setLang(string $lang): void
    {
        $this->lang = $lang;
    }


}
