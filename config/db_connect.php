<?php

//Tables and their queries
//1. tbl_admin :
$tbl_admin =  "CREATE TABLE  `tbl_admin` ( `id` INT NOT NULL AUTO_INCREMENT , `full_name` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

//2. tbl_category
$tbl_category = "CREATE TABLE  `tbl_category` ( `id` INT NOT NULL AUTO_INCREMENT ,  `title` VARCHAR(100) NOT NULL ,  `image_name` VARCHAR(255) NOT NULL ,  `featured` VARCHAR(10) NOT NULL ,  `active` VARCHAR(10) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;";

//3. tbl_item
$tbl_item = "CREATE TABLE  `tbl_item` ( `id` INT NOT NULL AUTO_INCREMENT ,  `title` VARCHAR(100) NOT NULL ,  `description` TEXT NOT NULL ,  `price` DECIMAL(10,2) NOT NULL ,  `image_name` VARCHAR(255) NOT NULL ,  `category_id` INT(10) NOT NULL ,  `featured` VARCHAR(10) NOT NULL ,  `active` VARCHAR(10) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;";

//4. tbl_order
$tbl_order = "CREATE TABLE  `tbl_order` ( `id` INT(10) NOT NULL AUTO_INCREMENT ,  `item` VARCHAR(150) NOT NULL ,  `price` DECIMAL(10,2) NOT NULL ,  `qty` INT(11) NOT NULL ,  `total` DECIMAL(10,2) NOT NULL ,  `order_date` DATETIME NOT NULL ,  `status` VARCHAR(50) NOT NULL ,  `customer_name` VARCHAR(150) NOT NULL ,  `customer_contact` VARCHAR(20) NOT NULL ,  `customer_email` VARCHAR(150) NOT NULL ,  `customer_address` VARCHAR(255) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;";

//5. tbl_version
$tbl_version = "CREATE TABLE `tbl_version` ( `id` INT(10) NOT NULL AUTO_INCREMENT ,  `version` VARCHAR(10) NOT NULL ,  `feature` TEXT NOT NULL ,  `date` DATETIME NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;";

//6. tbl_contact
$tbl_contact = "CREATE TABLE `tbl_contact` ( `id` INT NOT NULL AUTO_INCREMENT ,  `name` VARCHAR(200) NOT NULL ,  `email` VARCHAR(255) NOT NULL ,  `contact` VARCHAR(255) NOT NULL ,`date` DATETIME NOT NULL ,  `message` TEXT NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;";