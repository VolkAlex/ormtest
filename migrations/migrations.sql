#модификация таблиц для построения дерева методом рекурсии (1 задание)
ALTER TABLE `orm_test_db`.`route`
ADD COLUMN `parent_id` INT(10) NULL AFTER `id`;
UPDATE `orm_test_db`.`route` SET `parent_id` = '7' WHERE (`id` = '8');
UPDATE `orm_test_db`.`route` SET `parent_id` = '7' WHERE (`id` = '9');

ALTER TABLE `orm_test_db`.`role`
ADD COLUMN `parent_id` INT(10) NULL AFTER `id`;
UPDATE `orm_test_db`.`role` SET `parent_id` = '2' WHERE (`id` = '3');
UPDATE `orm_test_db`.`role` SET `parent_id` = '2' WHERE (`id` = '4');

#модификация таблиц для задания отношений к записям (2 задание)
ALTER TABLE `orm_test_db`.`role`
ADD COLUMN `routes_id` VARCHAR(45) NULL AFTER `name`;
UPDATE `orm_test_db`.`role` SET `routes_id` = '1,2' WHERE (`id` = '1');
UPDATE `orm_test_db`.`role` SET `routes_id` = '1,3,4,5' WHERE (`id` = '2');
UPDATE `orm_test_db`.`role` SET `routes_id` = '6,9' WHERE (`id` = '3');
UPDATE `orm_test_db`.`role` SET `routes_id` = '7,8' WHERE (`id` = '4');
