CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(40) NOT NULL,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  PRIMARY KEY (id)
);

GRANT ALL PRIVILEGES ON photo_gallery.* TO 'mark_gallery'@'localhost' IDENTIFIED BY 'mysql0MB123';
