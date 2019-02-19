CREATE TABLE `ccs_lot_supplier` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lot_id` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;