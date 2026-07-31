DELIMITER ;;
CREATE PROCEDURE `proc_generate_invoice`(IN `v_invoice_no` VARCHAR(20), IN `v_sub_total` DECIMAL(18,3), IN `v_vat` DECIMAL(18,3), IN `v_total_amount` DECIMAL(18,3), IN `v_received_amount` DECIMAL(18,3), IN `v_balane_in_due` DECIMAL(18,3), IN `v_main_description` TEXT, IN `v_retention_amount_percentage` DECIMAL(18,3), IN `v_previous_bill_amount` DECIMAL(18,3), IN `v_invoice_date` DATE, IN `v_company_name` VARCHAR(1000), IN `v_po_box` VARCHAR(500), IN `v_telephone_no` VARCHAR(500), IN `v_fax` VARCHAR(500), IN `v_attn` VARCHAR(500), IN `v_quotation_reference` VARCHAR(500), IN `v_LPO_no` VARCHAR(500), IN `v_project_id` INT, IN `v_project_name` VARCHAR(500), IN `v_company_id` INT, IN `v_received_amount_type` VARCHAR(10), IN `v_retention_amount_type` VARCHAR(10), IN `v_discount_type` VARCHAR(10), IN `v_discount_amount` DECIMAL(18,3), OUT `msg` VARCHAR(10))
BEGIN
INSERT into invoice_real_tbl(invoice_temp_no) VALUES (v_invoice_no);

SELECT LAST_INSERT_ID() into  @v_ret_last_insert_ids ;

IF @v_ret_last_insert_ids >=0 and @v_ret_last_insert_ids<=9 THEN
	SET @receipt_no=CONCAT('SI-IN-100',@v_ret_last_insert_ids);
END IF;
IF @v_ret_last_insert_ids >=10 and @v_ret_last_insert_ids<=99 THEN
	SET @receipt_no=CONCAT('SI-IN-10',@v_ret_last_insert_ids);
END IF;
IF @v_ret_last_insert_ids >=100 and @v_ret_last_insert_ids<=909 THEN
	SET @receipt_no=CONCAT('SI-IN-1',@v_ret_last_insert_ids);
END IF;
UPDATE invoice_real_tbl SET invoice_real_no=@receipt_no where invoice_real_id=@v_ret_last_insert_ids;

UPDATE  invoice_main_tbl SET  invoice_date=v_invoice_date, invoice_real_no=@receipt_no, company_name=v_company_name,po_box=v_po_box,telephone_no=v_telephone_no,fax=v_fax,attn=v_attn,quotation_reference=v_quotation_reference,LPO_no=v_LPO_no,project_id=v_project_id,project_name=v_project_name,company_id=v_company_id,sub_total=v_sub_total,vat=v_vat,total_amount=v_total_amount,received_amount=v_received_amount,balane_in_due=v_balane_in_due,description=v_main_description,retention_amount_percentage=v_retention_amount_percentage,previous_bill_amount=v_previous_bill_amount,invoice_status='Invoice Generated',received_amount_type=v_received_amount_type,retention_amount_type=v_retention_amount_type,discount_type=v_discount_type,discount_amount=v_discount_amount where invoice_number=v_invoice_no;

UPDATE  invoice_child_tbl SET invoice_real_no=@receipt_no where invoice_no=v_invoice_no;

SET msg="success";
END ;;
DELIMITER ;