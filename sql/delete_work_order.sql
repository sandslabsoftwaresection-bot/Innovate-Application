DELIMITER $$
CREATE DEFINER=`cpses_sakmv7i715`@`localhost` PROCEDURE `proc_delete_working_order`(IN `v_ids` INT, IN `v_work_order_main_id` INT, OUT `ret` VARCHAR(500))
BEGIN

DELETE from work_order_child_tbl WHERE work_order_id=v_work_order_main_id and work_order_child_id=v_ids;

DELETE from  work_order_tbl WHERE work_order_main_id=v_work_order_main_id;

END$$