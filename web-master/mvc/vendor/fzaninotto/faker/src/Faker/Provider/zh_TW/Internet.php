<?php

namespace Faker\Provider\zh_TW;

class Internet extends \Faker\Provider\Internet
{
    public function username()
    {
        return \Faker\Factory::create('en_US')->username();
    }

    public function domainWord()
    {
        return \Faker\Factory::create('en_US')->domainWord();
    }
}
