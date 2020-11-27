use xiag;
create table if not exists `poll` (
    `id` int(4) not null auto_increment,
    `uuid` varchar(64) not null default UUID(),
    `poll_question` varchar(256) not null,
    primary key (`id`)
);