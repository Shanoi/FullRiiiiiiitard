DROP TABLE IF EXISTS saw.users;
DROP TABLE IF EXISTS saw.items;

CREATE TABLE IF NOT EXISTS saw.users (
  id         INT(10) AUTO_INCREMENT NOT NULL,
  `username` VARCHAR(45)            NOT NULL,
  `pwd`      VARCHAR(255)           NOT NULL,
  `admin`    BOOLEAN                NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

INSERT IGNORE INTO users (`username`, `pwd`, `admin`) VALUES ("Alice", "9AF15B336E6A9619928537DF30B2E6A2376569FCF9D7E773ECCEDE65606529A0", 1);
INSERT IGNORE INTO users (`username`, `pwd`, `admin`) VALUES ("Bob", "NotAVeryObviousPassword", 0);

CREATE TABLE IF NOT EXISTS saw.items (
  id         INT(10) AUTO_INCREMENT NOT NULL,
  `name`     VARCHAR(45)            NOT NULL,
  `price`    VARCHAR(255)           NOT NULL,
  PRIMARY KEY (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

INSERT IGNORE INTO items (`name`, `price`) VALUES ("fan", "100");
INSERT IGNORE INTO items (`name`, `price`) VALUES ("bulb", "50");
