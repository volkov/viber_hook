create table messages (
	id MEDIUMINT NOT NULL AUTO_INCREMENT,
	text TEXT,
	sender_id TEXT,
	sender_name TEXT,
	timestamp timestamp default now(),
	primary key (id)
)

create index messages_ts on messages(timestamp);