USE 'groupe_musique';

CREATE TABLE adjective (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content VARCHAR(39) NOT NULL
);

CREATE TABLE noun (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content VARCHAR(39) NOT NULL
);


INSERT INTO adjectives (content) VALUES
('Silent'),
('Crazy'),
('Midnight'),
('Golden'),
('Electric'),
('Wild'),
('Lonely'),
('Broken'),
('Burning'),
('Frozen');


INSERT INTO noun (content) VALUES
('Wolves'),
('Llamas'),
('Heroes'),
('Dragons'),
('Pirates'),
('Biscuits'),
('Lizards'),
('Monkeys'),
('Soldiers'),
('Giants');
