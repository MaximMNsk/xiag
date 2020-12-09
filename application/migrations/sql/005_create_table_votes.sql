use xiag;
create table if not exists `votes` (
    `id` int(6) not null auto_increment,
    `poll_id` int(6) not null,
    `answer_id` int(9) not null,
    `autor` varchar(64) not null,
    `browser_id` varchar(64) not null,
    primary key (`id`)
);