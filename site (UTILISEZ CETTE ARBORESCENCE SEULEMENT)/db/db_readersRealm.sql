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

INSERT INTO `t_book` (`book_id`, `booTitle`, `booExemplary`, `booResumeBook`, `booNbrPage`, `booEditorName`, `booEditionDate`, `booLikeRatio`, `booCoverImage`, `booWriter`, `category_fk`, `user_fk`) VALUES
(NULL, 'Dune, tome 1', '1', 'Sur Dune, la planète des sables, germe l épice qui donne longévité et prescience. 
À cause de l épice, tout l\'empire galactique du Padishah Shaddam IV tourne autour de Dune, âprement convoitée pour les nobles maisons du Landsraad et la Guilde des Navigateurs.
Leto Atreides, Duc et Cousin de l Empereur, a reçu Dune en fief. Pour peu de temps. En 10191, il meurt assassiné.
\r\nLes révérendes Mères surveillent son fils Paul, qui vient d\'avoir quinze ans : il est issu d\'une lignée sélectionnée et a montré dès l\'enfance des dons extraordinaires. 
Serait-il le surhomme prévu par leur programme génétique ?', 630, 'Robert Laffont', '2021-01-21 00:00:00', '0.0', 'uploads/659e4747a305c-Dune1-couverture.jpg', 'Frank Herbert', 3, 1),

(NULL, 'Le silence des agneaux', '1', 'Il s appelle Hannibal Lecter. Il est psychiatre. Emprisonné à vie pour une série de meurtres, 
il est la plus grande autorité du pays en matière de démence criminelle.\r\nPour comprendre les motivations secrètes d\'un psychopathe qui terrifie l\'Amérique, la police a besoin de ses \" intuitions \".
\r\nMais Lecter n\'accepte de communiquer qu\'avec Clarice, jeune agent spécial du FBI. 
Si elle veut bien lui parler d\'elle-même, de son enfance, de ses peurs intimes, peut-être l\'aidera-t-il à trouver le tueur... Ou le tueur à la trouver....', 
384, 'Pocket', '2011-08-01 00:00:00', '0.0', 'uploads/659e4a4c4c88b-Le-silence-des-agneaux.jpg', 'Thomas Harris', 4, 1),

(NULL, 'Simetierre', '1', 'La famille Creed (Louis, médecin, sa femme Rachel, leur fille Ellie, le bébé Gage et leur chat, Church) viennent emménager dans la petite ville de Ludlow, 
dans une grande maison ancienne. Louis fait la connaissance du vieux Jud Crandall, son voisin d\'en face, 
qui lui montre le quartier et particulièrement un petit cimetière aux animaux avec sa pancarte mal orthographiée créé par les enfants de la ville. 
Un jour, le chat se fait écraser. Creed décide de l\'enterrer avant que les enfants ne découvrent le désastre, et demande de l\'aide à Jud. Pendant qu\'ils enterrent le chat, 
le vieil homme lui raconte à demi-mots une légende qui court sur ce cimetière. Puis le chat revient. Vivant. Mais pas tout à fait le même...', 
636, 'Le livre de poche', '2003-09-03 00:00:00', '0.0', 'uploads/659e4b7fcd462-simetierre-couverture.jpg', 'Stephen King', 1, 1),

(NULL, 'Je suis une légende', '1', 'Chaque jour, il doit organiser son existence solitaire dans une cité à l abandon, vidée de ses habitants par une étrange épidémie. 
Un virus incurable qui contraint les hommes à se nourrir de sang et les oblige à fuir les rayons du soleil... Chaque nuit, les vampires le traquent jusqu\'aux portes de sa demeure, 
frêle refuge contre une horde aux visages familiers de ses anciens voisins ou de sa propre femme. Chaque nuit est un cauchemar pour le dernier homme, l\'ultime survivant d\'une espèce désormais légendaire.', 
240, 'Gallimard', '2001-09-05 00:00:00', '0.0', 'uploads/659e4ddc0bc2a-iamalegend.jpg', 'Richard Matheson', 3, 1);