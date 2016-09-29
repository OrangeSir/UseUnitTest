<?php
class Query {

    const USER_NEW = 1;
    const USER_OLD = 2;
    const USER_VIP = 3;

    public $addMoney = 5;

    public function __construct() {
        $this->addMoney = 10;
    }

    public function newMoney() {
        return $this->addMoney+5;
    }

    public function oldMoney() {
        return $this->addMoney+10;
    }

    public function vipMoney() {
        return $this->addMoney+15;
    }

    public function moneyAll($userType1, $userType2) {
        return $this->run($userType1)+$this->run($userType2);
    }

    public function run($userType) {
        switch ($userType) {

            case self::USER_NEW:
                return $this->newMoney();

            case self::USER_OLD:
                return $this->oldMoney();

            case self::USER_VIP:
                return $this->vipMoney();
            
            default:
                return 0;
        }
    }

}