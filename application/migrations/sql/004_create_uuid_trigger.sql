use xiag;
DELIMITER ;;
CREATE OR REPLACE TRIGGER `xiag_poll_uuid` BEFORE INSERT ON `poll`
 FOR EACH ROW BEGIN
  IF new.uuid IS NULL OR new.uuid = '' THEN
    SET new.uuid = UUID();
  END IF;
END;;
DELIMITER ;