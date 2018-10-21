/*
DROP TABLE IF EXISTS saw.users;
*/

CREATE TABLE IF NOT EXISTS saw.users (
	id int(10) NOT NULL,
	`name` varchar(45) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT IGNORE INTO users (id, `first_name`, `last_name`) VALUES (0, "Alice", "Manager");
INSERT IGNORE INTO users (id, `first_name`, `last_name`) VALUES (1, "Bob", "Random");
