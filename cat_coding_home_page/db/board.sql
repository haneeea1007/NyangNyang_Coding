-- // 자유게시판 테이블 생성
create table board (
	num int(11) not null auto_increment,
	id char(15) not null,
	name char(10) not null,
	subject char(200) not null,
	content text not null,
	regist_day char(20) not null,
	hit int(11) not null,
	file_name char(40),
	file_type char(40),
	file_copied char(40),
	primary key(num)
);