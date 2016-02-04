<?php

//require './Falconide.php';
//require './Email.php';
require './vendor/autoload.php';

$falconide = new Falconide\Falconide();
$email = new Falconide\Email();
$falconide->setApikey('Your Api Key');
$email->setSubject('Test Mail');
$email->setFromname('Falcon Admin');
$email->setFrom('falconadmin@yourdomainame.com');
$email->setRecipients('narensgh@gmail.com');
$email->setContent('Hi, This is test mail');
$falconide->sendmail($email);