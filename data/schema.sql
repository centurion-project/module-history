CREATE TABLE  `history_log` (
  `id` BIGINT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `proxy_id` INT( 11 ) UNSIGNED NOT NULL ,
  `proxy_pk` INT( 11 ) UNSIGNED NOT NULL ,
  `value` MEDIUMBLOB NOT NULL ,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `user_id` INT( 11 ) UNSIGNED NULL ,
  `name` VARCHAR( 255 ) NOT NULL
) ENGINE = INNODB;

ALTER TABLE  `history_log` ADD INDEX ( `proxy_id` );
ALTER TABLE  `history_log` ADD INDEX ( `proxy_pk` );
ALTER TABLE  `history_log` ADD INDEX ( `user_id` );
