-- // 회원정보 테이블 생성
create table members (
	num int(11) not null auto_increment,
	id char(15) not null,
	pass char(15) not null,
	name char(15) not null,
	birth char(15) not null,
	email char(80) not null,
	phone char(15) not null,
	addnum char(15) not null,
	address char(100) not null,
	animal char(15) not null,
	regist_day char(20) not null,
	level int(11),
	point int(11),
	email_check char(10),
	sms_check char(10),
	primary key(num)
);