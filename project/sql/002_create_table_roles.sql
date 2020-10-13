<<<<<<< HEAD
CREATE TABLE IF NOT EXISTS  `Roles`
(
    `id`         int auto_increment not null,
    `name`      varchar(100)       not null unique,
    `description` varchar(100) default '',
    `is_active`  TINYINT(1) default 1,
    `created`    timestamp default current_timestamp,
    `modified`   timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY (`id`)
)
=======
CREATE TABLE IF NOT EXISTS  `Roles`
(
    `id`         int auto_increment not null,
    `name`      varchar(100)       not null unique,
    `description` varchar(100) default '',
    `is_active`  TINYINT(1) default 1,
    `created`    timestamp default current_timestamp,
    `modified`   timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY (`id`)
)
>>>>>>> 1c4ec34f5100522fb3550c3f076eee60e2e835cd
