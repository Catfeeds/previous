ALTER TABLE `jh_order`
ADD COLUMN `coupon_id`  int(10) NULL DEFAULT 0 COMMENT '�����Ż�ȯID' AFTER `closed`,
ADD COLUMN `coupon`  decimal(8,2) NULL DEFAULT 0.00 COMMENT '�����Ż�ȯ�ֿ۽��' AFTER `coupon_id`;