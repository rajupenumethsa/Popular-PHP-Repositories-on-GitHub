CREATE DATABASE GitHubProjects;

USE GitHubProjects;

CREATE TABLE Projects (
    id INT NOT NULL AUTO_INCREMENT,
    repository_id INT NOT NULL DEFAULT 0,
    repository_name VARCHAR(255),
    repository_url VARCHAR(255),
    date_created TIMESTAMP,
    last_updated TIMESTAMP,
    description TEXT,
    stars INT,
    PRIMARY KEY (id)
);