DROP TABLE IF EXISTS sawsecure.users;
DROP TABLE IF EXISTS sawsecure.items;

CREATE TABLE IF NOT EXISTS sawsecure.users (
  id         INT(10) AUTO_INCREMENT NOT NULL,
  `username` VARCHAR(45)            NOT NULL,
  `pwd`      VARCHAR(255)           NOT NULL,
  `admin`    BOOLEAN                NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

INSERT IGNORE INTO users (`username`, `pwd`, `admin`) VALUES ("Alice", "9AF15B336E6A9619928537DF30B2E6A2376569FCF9D7E773ECCEDE65606529A0", 1);
INSERT IGNORE INTO users (`username`, `pwd`, `admin`) VALUES ("Bob", "D6122B7AE501C237778C033BD8302CE67A872D486D76438988DD1BFB32D6F98D", 0);
/* NotAVeryObviousPassword */

CREATE TABLE IF NOT EXISTS sawsecure.items (
  id         INT(10) AUTO_INCREMENT NOT NULL,
  `name`     VARCHAR(45)            NOT NULL,
  `price`    VARCHAR(255)           NOT NULL,
  PRIMARY KEY (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

INSERT IGNORE INTO items (`name`, `price`) VALUES ("fan", "100");
INSERT IGNORE INTO items (`name`, `price`) VALUES ("bulb", "50");

DROP TABLE IF EXISTS sawsecure.loginattempt;

CREATE TABLE IF NOT EXISTS sawsecure.loginattempt (
  id          INT(10) AUTO_INCREMENT  NOT NULL,
  `username`  VARCHAR(45)             NOT NULL,
  `attempt`   INT(10)                 NOT NULL,
  PRIMARY KEY (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;


