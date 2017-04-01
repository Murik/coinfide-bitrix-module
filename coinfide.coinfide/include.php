<?php
CModule::AddAutoloadClasses('coinfide.coinfide', array(
	'\Coinfide\Client' => 'lib/Client.php',
    'Coinfide\Entity\Order' => 'lib/entity/order.php',
    'Coinfide\Entity\Base' => 'lib/entity/base.php',
    'Coinfide\Entity\Account' => 'lib/entity/account.php',
    'Coinfide\Entity\Phone' => 'lib/entity/phone.php',
    'Coinfide\Entity\Address' => 'lib/entity/address.php',
    'Coinfide\Entity\OrderItem' => 'lib/entity/orderitem.php',
    'Coinfide\CoinfideException' => 'lib/CoinfideException.php',
    'Coinfide\Entity\Token' => 'lib/entity/token.php',
    'Coinfide\Entity\WrappedOrder' => 'lib/entity/wrappedorder.php'
));