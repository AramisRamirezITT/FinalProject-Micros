create database finalproject;

use finalproject;

create table users(
    id_us       int(255) auto_increment not null ,
    username    varchar(100) not null ,
    password    varchar(255) not null ,
    level       int(255) DEFAULT 0,
    status      int(255)  not null ,
    CONSTRAINT pk_users PRIMARY KEY (id_us)

)ENGINE=InnoDB;

CREATE TABLE events (
    id_event int(255) auto_increment not null ,
    value VARCHAR(30) NOT NULL,
    location VARCHAR(30) NOT NULL,
    id_user int(255) not null,
    reading_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status int(10) NOT NULL,
    CONSTRAINT pk_events  PRIMARY KEY (id_event),
    CONSTRAINT fk_user FOREIGN KEY (id_user) REFERENCES users(id_us)
)ENGINE=InnoDB;


# create table devices (
#     id_device   int(255) auto_increment not null ,
#     device      varchar(255) not null,
#     status      bool not null,
#     CONSTRAINT pk_devices  PRIMARY KEY (id_device)
# )ENGINE=InnoDB;
#
#
# create table events (
#   id_event      int(255) auto_increment not null ,
#   value         float(10) not null,
#   time          date not null,
#   id_device     int(255) not null,
#   id_user       int(255) not null,
#   CONSTRAINT pk_events  PRIMARY KEY (id_event),
#   CONSTRAINT fk_user FOREIGN KEY (id_user) REFERENCES users(id_us),
#   CONSTRAINT fk_event FOREIGN KEY (id_event) REFERENCES devices(id_device)
# )ENGINE=InnoDB;

use finalproject;
SELECT * FROM users WHERE  username =  "hello" ;