<?php
OpenPayU_Configuration::setEnvironment('secure');

    //set POS ID and Second MD5 Key (from merchant admin panel)
    OpenPayU_Configuration::setMerchantPosId('145227');
    OpenPayU_Configuration::setSignatureKey('13a980d4f851f3d9a1cfc792fb1f5e50');

    //set Oauth Client Id and Oauth Client Secret (from merchant admin panel)
    OpenPayU_Configuration::setOauthClientId('145227');
    OpenPayU_Configuration::setOauthClientSecret('12f071174cb7eb79d4aac5bc2f07563f'); 
?>