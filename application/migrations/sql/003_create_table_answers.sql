use xiag;
create table if not exists `answers` (
    `id` int(9) not null auto_increment,
    `parent_id` int(4) not null,
    `answer` varchar(256) not null,
    primary key (`id`)
);