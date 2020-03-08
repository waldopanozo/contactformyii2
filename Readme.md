**Framework**

PHP/Yii2
![ER MODEL](/images/yiiinstallation.png)

**Libraries**
PHPMailer

![ER MODEL](/images/emailcheck.png)

**TABLE**

Only for education purpose.
MySQL



CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `sent` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) 
 ENGINE=InnoDB
 DEFAULT CHARSET=utf8
 COLLATE=utf8_general_ci;

_Sample_


![ER MODEL](/images/sampleinsert.png)

