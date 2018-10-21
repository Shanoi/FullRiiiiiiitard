DROP TABLE IF EXISTS saw.users;

CREATE TABLE IF NOT EXISTS saw.users (
  id           INT(10) AUTO_INCREMENT NOT NULL,
  `first_name` VARCHAR(45)            NOT NULL,
  `pwd`        VARCHAR(255)           NOT NULL,
  `admin`      BOOLEAN                NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;


INSERT IGNORE INTO users (`first_name`, `pwd`, `admin`) VALUES ("Alice", "0000", 1);
INSERT IGNORE INTO users (`first_name`, `pwd`, `admin`) VALUES ("Bob", "PASSWORD", 0);
