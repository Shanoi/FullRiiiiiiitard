DROP TABLE IF EXISTS saw.users;
DROP TABLE IF EXISTS saw.admins;

CREATE TABLE IF NOT EXISTS saw.users (
  id           INT(10)     NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name`  VARCHAR(45) NOT NULL,
  `password`  VARCHAR(255) NOT NULL,
  `admin`      BOOLEAN     NOT NULL,
  PRIMARY KEY (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;


INSERT IGNORE INTO users (id, `first_name`, `last_name`, `password`, `admin`) VALUES (0, "Alice", "Manager", "0000",  1);
INSERT IGNORE INTO users (id, `first_name`, `last_name`, `password`, `admin`) VALUES (0, "Bob", "Random", "PASSWORD", 0);
