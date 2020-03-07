-- // Q&A 게시판 테이블 생성
create table qna (
	num int(10) unsigned not null auto_increment,
	group_num int(10) unsigned not null,
	depth int(10) unsigned not null,
	ord int(10) unsigned not null, 
	id char(15) not null,
	name char(10) not null,
	subject char(200) not null,
	content text not null,
	regist_day char(20) not null,
	hit int(11) unsigned not null,
	primary key(num)
);
