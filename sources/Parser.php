<?php

namespace Msisdn;


use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberToCarrierMapper;
use libphonenumber\PhoneNumberUtil;

class Parser
{
    public $mno = null;
    public $country = null;
    public $countryDilingCode = null;
    public $number = null;
    public $isValid = false;

    protected $phoneNumberUtil = null;
    protected $carrierMapperUtil = null;

    public function __construct()
    {
        $this->phoneNumberUtil = PhoneNumberUtil::getInstance();
        $this->carrierMapperUtil = PhoneNumberToCarrierMapper::getInstance();
    }

    public function parse($number)
    {
        try {
            $phoneNumber = $this->phoneNumberUtil->parse($number, null);
        } catch (NumberParseException $e) {
            $this->isValid = false;
            return $this;
        }

        $this->isValid = $this->phoneNumberUtil->isValidNumber($phoneNumber);

        if($this->isValid)
        {
            $this->number = $phoneNumber->getNationalNumber();
            $this->country = $this->phoneNumberUtil->getRegionCodeForNumber($phoneNumber);
            $this->countryDilingCode = (int)$phoneNumber->getCountryCode();
            $this->mno = $this->carrierMapperUtil->getNameForNumber($phoneNumber, 'en_US');
        }

        return $this;
    }
}
