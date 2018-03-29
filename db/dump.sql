create database slim_project;

use slim_project;


create table appointment_slots
(
	hour_id int(10) auto_increment
		primary key,
	`from` varchar(10) null,
	`to` varchar(10) null,
	constraint id_UNIQUE
		unique (hour_id),
	constraint from_UNIQUE
		unique (`from`),
	constraint to_UNIQUE
		unique (`to`)
)
engine=InnoDB
;

create table appointment_statuses
(
	status_id int auto_increment
		primary key,
	system_name varchar(45) not null,
	status_name varchar(45) not null,
	type tinyint default '0' not null,
	constraint id_UNIQUE
		unique (status_id),
	constraint system_name_UNIQUE
		unique (system_name),
	constraint name_UNIQUE
		unique (status_name)
)
engine=InnoDB
;

create table roles
(
	role_id int auto_increment
		primary key,
	role_name varchar(45) not null,
	system_name varchar(45) not null,
	constraint name_UNIQUE
		unique (role_name),
	constraint system_name_UNIQUE
		unique (system_name)
)
engine=InnoDB
;

create table users
(
	user_id int auto_increment
		primary key,
	user_name varchar(255) null,
	email varchar(255) not null,
	password varchar(255) null,
	role_id int null,
	constraint email_UNIQUE
		unique (email),
	constraint fk_users_1
		foreign key (role_id) references roles (role_id)
			on update cascade on delete set null
)
engine=InnoDB
;

create index fk_users_1_idx
	on users (role_id)
;

create table appointments
(
	appointment_id int auto_increment
		primary key,
	user_id int not null,
	lawyer_id int not null,
	hour_id int not null,
	date date not null,
	status_id int not null,
	description varchar(500) null,
	constraint id_UNIQUE
		unique (appointment_id),
	constraint fk_appointments_4
		foreign key (hour_id) references appointment_slots (hour_id)
			on update cascade,
	constraint fk_appointments_1
		foreign key (status_id) references appointment_statuses (status_id)
			on update cascade
)
engine=InnoDB
;

create index fk_appointments_2_idx
	on appointments (user_id)
;

create index fk_appointments_3_idx
	on appointments (lawyer_id)
;

create index fk_appointments_4_idx
	on appointments (hour_id)
;

create index fk_appointments_1_idx
	on appointments (status_id)
;

alter table appointments
	add constraint fk_appointments_2
foreign key (user_id) references users (user_id)
;

alter table appointments
	add constraint fk_appointments_3
foreign key (lawyer_id) references users (user_id)
;

INSERT INTO slim_project.appointment_slots (hour_id, `from`, `to`) VALUES (1, '9h', '10h');
INSERT INTO slim_project.appointment_slots (hour_id, `from`, `to`) VALUES (2, '10h', '11h');
INSERT INTO slim_project.appointment_slots (hour_id, `from`, `to`) VALUES (3, '11h', '12h');
INSERT INTO slim_project.appointment_slots (hour_id, `from`, `to`) VALUES (4, '12h', '13h');
INSERT INTO slim_project.appointment_slots (hour_id, `from`, `to`) VALUES (5, '14h', '15h');
INSERT INTO slim_project.appointment_slots (hour_id, `from`, `to`) VALUES (6, '16h', '17h');
INSERT INTO slim_project.appointment_slots (hour_id, `from`, `to`) VALUES (7, '18h', '19h');

INSERT INTO slim_project.appointment_statuses (status_id, system_name, status_name, type) VALUES (1, 'awaiting', 'Awaiting Approval', 0);
INSERT INTO slim_project.appointment_statuses (status_id, system_name, status_name, type) VALUES (2, 'modified', 'Modified', 1);
INSERT INTO slim_project.appointment_statuses (status_id, system_name, status_name, type) VALUES (3, 'approved', 'Approved', 1);
INSERT INTO slim_project.appointment_statuses (status_id, system_name, status_name, type) VALUES (4, 'cancel', 'Cancel', 2);

INSERT INTO slim_project.roles (role_id, role_name, system_name) VALUES (1, 'user', 'User');
INSERT INTO slim_project.roles (role_id, role_name, system_name) VALUES (2, 'lawyer', 'Lawyer');

INSERT INTO slim_project.users (user_id, user_name, email, password, role_id) VALUES (2, 'User', 'user@mail.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1);
INSERT INTO slim_project.users (user_id, user_name, email, password, role_id) VALUES (5, 'Lawyer', 'lawyer@mail.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 2);
INSERT INTO slim_project.users (user_id, user_name, email, password, role_id) VALUES (6, 'null', 'melejy@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1);
INSERT INTO slim_project.users (user_id, user_name, email, password, role_id) VALUES (8, 'null', 'fifuluz@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1);
INSERT INTO slim_project.users (user_id, user_name, email, password, role_id) VALUES (10, 'null', 'ximygyje@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1);
INSERT INTO slim_project.users (user_id, user_name, email, password, role_id) VALUES (12, 'null', 'vukubujiwo@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1);
INSERT INTO slim_project.users (user_id, user_name, email, password, role_id) VALUES (14, 'null', 'kehuv@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1);
INSERT INTO slim_project.users (user_id, user_name, email, password, role_id) VALUES (16, 'null', 'sukewomy@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1);


INSERT INTO slim_project.appointments (appointment_id, user_id, lawyer_id, hour_id, date, status_id, description) VALUES (2, 2, 5, 1, '2017-09-08', 3, 'Test appointment');
INSERT INTO slim_project.appointments (appointment_id, user_id, lawyer_id, hour_id, date, status_id, description) VALUES (3, 2, 5, 2, '2018-03-21', 3, '123');
INSERT INTO slim_project.appointments (appointment_id, user_id, lawyer_id, hour_id, date, status_id, description) VALUES (5, 16, 5, 2, '2018-04-02', 2, 'Cookie');
