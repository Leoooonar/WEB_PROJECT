USE db_readersRealm;

CREATE TABLE t_user (
    user_id INT NOT NULL AUTO_INCREMENT,
    useUsername varchar(50) NOT NULL,
    usePassword varchar(255) NOT NULL,
    useRegistrationDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    useNbrProposedBook INT DEFAULT 0,
    useNbrLike INT DEFAULT 0,
    useIsAdmin tinyint(1) DEFAULT 0,
    PRIMARY KEY (user_id)
);

CREATE TABLE t_category (
    category_id INT NOT NULL AUTO_INCREMENT,
    catCategory varchar(50) NOT NULL,
    PRIMARY KEY (category_id)
);

CREATE TABLE t_book (
    book_id INT NOT NULL AUTO_INCREMENT,
    booTitle varchar(50) NOT NULL,
    booExemplary varchar(100) NOT NULL,
    booResumeBook TEXT NOT NULL,
    booNbrPage INT NOT NULL,
    booEditorName varchar(50) NOT NULL,
    booEditionDate DATETIME NOT NULL,
    booLikeRatio decimal(4,1) DEFAULT NULL,
    booCoverImage varchar(250) NOT NULL,
    booWriter varchar(50) NOT NULL,
    category_fk INT NOT NULL,
    user_fk INT NOT NULL,
    PRIMARY KEY (book_id),
    FOREIGN KEY (category_fk) REFERENCES t_category(category_id),
    FOREIGN KEY (user_fk) REFERENCES t_user(user_id)
);

CREATE TABLE t_rate (
    user_fk INT NOT NULL,
    book_fk INT NOT NULL,
    ratRate tinyint DEFAULT NULL,
    PRIMARY KEY (user_fk, book_fk),
    FOREIGN KEY (user_fk) REFERENCES t_user (user_id),
    FOREIGN KEY (book_fk) REFERENCES t_book (book_id)
);

INSERT INTO `t_category` (`category_id`, `catCategory`) VALUES
(NULL, 'Horreur'),
(NULL, 'Comédie'),
(NULL, 'Science-Fiction'),
(NULL, 'Policier');

INSERT INTO `t_user` (`user_id`, `useUsername`, `usePassword`, `useRegistrationDate`, `useNbrProposedBook`, `useNbrLike`, `useIsAdmin`) VALUES
(NULL, 'admin', '$2y$10$0gcmeB7iFo8Sc34W8QQJnuD5Peu41vD8GGttBw.wsB65DWrJtluSO', '2024-01-09 00:00:00', 0, 0, 1),
(NULL, 'usertest', '$2y$10$G4cOkmYc4mem8aY8gIYjEupi9RXJxEhsB1nqGqwRdODDQ1nYA1oNy', '2024-01-09 00:00:00', 0, 0, 0);