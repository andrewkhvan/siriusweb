<?php

namespace backend\models;

use Yii;
use backend\models\Dashboard;

class Dashboard extends \yii\base\Model
{
    public $investment;      //: 3500
    public $investBonus;     //: 600
    public $directBonus;     //: 4924.99
    public $secondLevelInvestBonus;      //: 2984.19
    public $rankBonus;       //: 3000
    public $totalBonus;      //: 11509.18
    public $balance;     //: -31995.82
    public $investBonusMonth;        //: 400
    public $investBonusWeek;     //: 100
    public $investBonusYear;     //: 4800
    public $rank;        //: 3
    public $registrationDate;        //: "1577836800"
    public $refCount;        //: 13
    public $totalCount;      //: 2451
    public $totalStructInvestment;       //: 498021.89
    public $refBalance;      //: 0
    public $cashOutSum;      //: -40000
    public $cashInSum;       //: 0
    public $cashAwait;       //: 0
    public $turnoverToNextRank;      //: 0
    public $depositUpToNextRank;     //: 0
    public $activeCount;     //: 
    public $wAddress;     //: 
    public $partnerName;
    public $email;

    public function rules()
    {
        return [
            [['investment', 'investBonus', 'directBonus', 'secondLevelInvestBonus', 'rankBonus', 'totalBonus', 'balance', 'investBonusMonth', 'investBonusWeek', 'investBonusYear', 'rank', 'registrationDate', 'refCount', 'totalCount', 'totalStructInvestment', 'refBalance', 'cashOutSum', 'cashInSum', 'cashAwait', 'turnoverToNextRank', 'depositUpToNextRank', 'activeCount', 'wAddress'], 'save'],
        ];
    }

    public function apiLoad($apifunction = 'info', $partnerId = null)
    {
        $result =  Api::request($apifunction, ['partnerId' => $partnerId]);

        $this->investment = $result->Investment;
        $this->investBonus = $result->InvestBonus;
        $this->directBonus = $result->DirectBonus;
        $this->secondLevelInvestBonus = $result->SecondLevelInvestBonus;
        $this->rankBonus = $result->RankBonus;
        $this->totalBonus = $result->TotalBonus;
        $this->balance = $result->Balance;
        $this->investBonusMonth = $result->InvestBonusMonth;
        $this->investBonusWeek = $result->InvestBonusWeek;
        $this->investBonusYear = $result->InvestBonusYear;
        $this->rank = $result->Rank;
        $this->registrationDate = $result->RegistrationDate;
        $this->refCount = $result->RefCount;
        $this->totalCount = $result->TotalCount;
        $this->totalStructInvestment = $result->TotalStructInvestment;
        $this->refBalance = $result->RefBalance;
        $this->cashOutSum = $result->CashOutSum;
        $this->cashInSum = $result->CashInSum;
        $this->cashAwait = $result->CashAwait;
        $this->turnoverToNextRank = $result->TurnoverToNextRank;
        $this->depositUpToNextRank = $result->DepositUpToNextRank;
        $this->activeCount = $result->ActiveCount;
        $this->wAddress = $result->WAddress;
        $this->partnerName = $result->PartnerName;
        $this->email = $result->Email;
    }

    public function getPartnerName()
    {
        if (empty($this->partnerName)) {
            return '(not set)';
        }
        return $this->partnerNmae;
    }

    public function getRankTitle()
    {
        return Yii::t('app', 'Rank').'-'. $this->rank;
    }

    public function getCashInSum()
    {
        return number_format($this->cashInSum, 2, '.', ' ');
    }

    public function getCashOutSum()
    {
        return number_format($this->cashOutSum, 2, '.', ' ');
    }
    public function getCashAwait()
    {
        return number_format($this->cashAwait, 2, '.', ' ');
    }

    public function getInvestBonusMonth()
    {
        return number_format($this->investBonusMonth, 2, '.', ' ');
    }

    public function getInvestBonusWeek()
    {
        return number_format($this->investBonusWeek, 2, '.', ' ');
    }

    public function getInvestBonusYear()
    {
        return number_format($this->investBonusYear, 2, '.', ' ');
    }

    public function getTotalStructInvestment()
    {
        return number_format($this->totalStructInvestment, 2, '.', ' ');
    }

    public function getProgressValue()
    {
        if ($this->investment == 0) {
            return null;
        }

        $percent = $this->investBonus / $this->investment * 100;
        return round($percent);
    }

    public function getTurnoverProgressValue()
    {
        if ($this->turnoverToNextRank == 0) {
            return null;
        }

        $percent = $this->totalStructInvestment / $this->turnoverToNextRank * 100;
        return round($percent);
    }

    public function getDepositProgressValue()
    {
        if ($this->depositUpToNextRank == 0) {
            return null;
        }

        $percent = $this->investment / $this->depositUpToNextRank * 100;
        return round($percent);
    }

    public function labels()
    {
        return [
            'investment' => Yii::t('app', 'Investment'),
            'investBonus' => Yii::t('app', 'InvestBonus'),
            'directBonus' => Yii::t('app', 'DirectBonus'),
            'secondLevelInvestBonus' => Yii::t('app', 'SecondLevelInvestBonus'),
            'rankBonus' => Yii::t('app', 'RankBonus'),
            'totalBonus' => Yii::t('app', 'TotalBonus'),
            'balance' => Yii::t('app', 'Balance'),
            'investBonusMonth' => Yii::t('app', 'InvestBonusMonth'),
            'investBonusWeek' => Yii::t('app', 'InvestBonusWeek'),
            'investBonusYear' => Yii::t('app', 'InvestBonusYear'),
            'rank' => Yii::t('app', 'Rank'),
            'registrationDate' => Yii::t('app', 'RegistrationDate'),
            'refCount' => Yii::t('app', 'RefCount'),
            'totalCount' => Yii::t('app', 'TotalCount'),
            'totalStructInvestment' => Yii::t('app', 'TotalStructInvestment'),
            'refBalance' => Yii::t('app', 'RefBalance'),
            'cashOutSum' => Yii::t('app', 'CashOutSum'),
            'cashInSum' => Yii::t('app', 'CashInSum'),
            'cashAwait' => Yii::t('app', 'CashAwait'),
            'turnoverToNextRank' => Yii::t('app', 'TurnoverToNextRank'),
            'depositUpToNextRank' => Yii::t('app', 'DepositUpToNextRank'),
            'activeCount' => Yii::t('app', 'ActiveCount'),
        ];
    }
}