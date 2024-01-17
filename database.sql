CREATE DATABASE blog_web;

CREATE TABLE user (
    user_id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(user_id)
);

ALTER TABLE `user` ADD `role` INT NOT NULL AFTER `password`; 

CREATE TABLE blog (
    blog_id INT PRIMARY KEY AUTO_INCREMENT,
    blog_title VARCHAR(255) NOT NULL,
    blog_body TEXT NOT NULL,
    blog_image VARCHAR(255) NOT NULL,
    category INT NOT NULL,
    author_id INT NOT NULL,
    publish_date TIMESTAMP DEFAULT current_timestamp()
    
);

CREATE TABLE categories (
    cat_id INT PRIMARY KEY AUTO_INCREMENT,
    cat_name VARCHAR(255) NOT NULL       
);

CREATE TABLE comments (
    comment_id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT,
    user_name VARCHAR(255),
    comment_body TEXT,
    comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES blog(blog_id)
);



INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `role`) 
VALUES (NULL, 'aris', 'aris5774@hotmail.com', SHA1('1234'), '1');