-- // 쪽지함 테이블 생성
create table message (
	num int(11) not null auto_increment,
	send_id char(20) not null,
	rv_id char(20) not null,
	subject char(200) not null,
	content text not null,
	regist_day char(20),
	primary key(num)
);