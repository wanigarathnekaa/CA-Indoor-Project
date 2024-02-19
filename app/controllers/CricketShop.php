<?php
class CricketShop extends Controller
{
    private $shopModel;
    public function __construct()
    {
        $this->shopModel = $this->model('M_CricketShop');
    }
}
?>
