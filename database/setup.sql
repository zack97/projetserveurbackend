CREATE DATABASE france24;

USE france24;

CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    date_published DATE,
    author VARCHAR(100)
);


INSERT INTO articles (title, content, image_path, date_published, author)
VALUES 
(
    "Les cyberattaques engendrés par la guerre russo-ukrainienne ont coûté deux milliards d'euros aux organisations françaises en 2022",
    "Deux milliards d’euros. C’est le coût colossal des cyberattaques réussies sur les systèmes d’information des organisations françaises, selon une estimation réalisée par le cabinet d’études économiques Asterès pour le compte du CRiP, une association regroupant 13 000 responsables d’infrastructure et de technologie. Ce chiffrage, “le premier en France”, selon Asterès, porte sur les intrusions dans les systèmes, les attaques par rançongiciel et celles par déni de service. Il inclut les dépenses liées à la résolution d’une attaque, les paiements de rançons et les interruptions de production. Il exclut les entreprises de moins de 250 salariés, ainsi que les communes de moins de 10 000 habitants.",
    "media/cyberattaque-france.jpg",
    "2022-12-01",
    "Author Name"
);



CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    birthdate DATE,
    address VARCHAR(255),
    postal_code VARCHAR(20),
    city VARCHAR(100),
    country VARCHAR(100),
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE favoris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    article_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (article_id) REFERENCES articles(id)
);
