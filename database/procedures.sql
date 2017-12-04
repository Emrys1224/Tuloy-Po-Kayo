DELIMITER $$

DROP PROCEDURE IF EXIST add_account$$

CREATE PROCEDURE add_account(
    IN  `_firstname`	VARCHAR(50),
    IN  `_lastname` 	VARCHAR(50),
    IN  `_email` 		VARCHAR(100), 
    IN  `_password` 	VARCHAR(20),
    IN  `_status` 		ENUM('Owner','Anonymous','Student','Worker'),
    OUT `_success`		INT
)
BEGIN
INSERT INTO `account` (
    `firstname`,
    `lastname`,
    `email`,
    `password`,
    `status`
)
VALUES (
    _firstname,
    _lastname,
    _email,
    _password,
    _status
);
END$$

DELIMITER ;



	
