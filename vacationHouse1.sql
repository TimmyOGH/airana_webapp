create table reservations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vhid int,
  startDate date,
  endDate date,
  guests int
  price DECIMAL(10, 2) NOT NULL;);

create table reviews(
  username varchar(30),
  rating float,
  review_text text);
