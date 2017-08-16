<?php

namespace Msisdn;


use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberToCarrierMapper;
use libphonenumber\PhoneNumberUtil;

class Parser
{
    // Not null in case of mobile number
    public $mno = null;

    // Two letter country code (ISO 3166-1-alpha-2 standard)
    public $country = null;

    public $countryDialingCode = null;
    public $number = null;
    public $isValid = false;

    protected $phoneNumberUtil = null;
    protected $carrierMapperUtil = null;

    public function __construct()
    {
        $this->phoneNumberUtil = PhoneNumberUtil::getInstance();
        $this->carrierMapperUtil = PhoneNumberToCarrierMapper::getInstance();
    }

    /**
     * Takes MSISDN as an input and parse it down to retrieve info about subscriber, carrier and country.
     *
     * @param string #number MSISDN number
     *
     * @return self
     */
    public function parse(string $number)
    {
        try {
            $phoneNumber = $this->phoneNumberUtil->parse($number, null);
        } catch (NumberParseException $e) {
            $this->isValid = false;
            return $this;
        }

        $this->isValid = $this->phoneNumberUtil->isValidNumber($phoneNumber);

        if ($this->isValid) {
            $this->number = $phoneNumber->getNationalNumber();
            $this->country = $this->phoneNumberUtil->getRegionCodeForNumber($phoneNumber);
            $this->countryDialingCode = (int)$phoneNumber->getCountryCode();
            $this->mno = $this->carrierMapperUtil->getNameForNumber($phoneNumber, 'en_US');
        }

        return $this;
    }
}
