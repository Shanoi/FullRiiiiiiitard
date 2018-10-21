DROP TABLE IF EXISTS saw.users;
DROP TABLE IF EXISTS saw.admins;

CREATE TABLE IF NOT EXISTS saw.users (
  id           INT(10) AUTO_INCREMENT NOT NULL,
  `username` VARCHAR(45)            NOT NULL,
  `pwd`        VARCHAR(255)           NOT NULL,
  `admin`      BOOLEAN                NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;


INSERT IGNORE INTO users (id, `username`, `pwd`, `admin`) VALUES (0, "Alice", "0000", 1);
INSERT IGNORE INTO users (id, `username`, `pwd`, `admin`) VALUES (1, "Bob", "PASSWORD", 0);
