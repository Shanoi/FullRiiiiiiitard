
DROP TABLE IF EXISTS saw.users;

CREATE TABLE IF NOT EXISTS saw.users (
  id int(10) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS saw.admins;

CREATE TABLE IF NOT EXISTS saw.admins (
  id int(10) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT IGNORE INTO admins (id, `first_name`, `last_name`) VALUES (0, "Alice", "Manager");
INSERT IGNORE INTO users (id, `first_name`, `last_name`) VALUES (0, "Bob", "Random");
