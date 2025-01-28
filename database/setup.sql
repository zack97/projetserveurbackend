CREATE TABLE articles (
    id SERIAL PRIMARY KEY,
    category VARCHAR(50),
    published TIMESTAMP,
    image VARCHAR(255),
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    source VARCHAR(100),
    link VARCHAR(255),
    duree INT
);



ALTER TABLE articles ADD COLUMN featured BOOLEAN DEFAULT 0;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE favorites (
    user_id INT NOT NULL,
    article_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (user_id, article_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE
);





IINSERT INTO articles (category, published, image, title, content, source, link, duree) VALUES
('latest', '2024-06-30', './View/media/doc2.jpg', 
 'Jamaica gets equipment to boost dengue fever diagnostics', 
 'Jamaica\'s capacity to respond to its current dengue outbreak has been bolstered by equipment donated to the Ministry of Health and Wellness by the United States Agency for International Development (USAID). The equipment valued US$250,000 was handed ...', 
 'The Gleaner - NEUTRAL', 'article1.php', 15),

('latest', '2024-06-25', './View/media/doc4.jpg', 
 '50 new trucks for NSWNA to boost garbage collection', 
 'The Government will be ramping up its effort to rid sidewalks of abandoned motor vehicles and other forms of bulky waste with the addition of 50 new garbage trucks to the National Solid Waste Management Authority (NSWMA). The trucks, which were handed ...', 
 'The Gleaner - NEUTRAL', 'article2.php', 20),

('latest', '2024-06-24', NULL, 
 'PM Says Jamaicans Have a Right to Enjoy the Island\'s Beaches', 
 'Jamaicans are being assured by Prime Minister, the Most Hon. Andrew Holness, that they have a right to enjoy the island\'s beaches. Speaking to journalists following a tour of the Little Dunn\'s River attraction in Ocho Rios, St. Ann, on June 21, Mr. Holness ...', 
 'Jamaica Information Service - GOV\'T INSTITUTION', 'article3.php', 30),

('latest', '2024-06-14', './View/media/doc5.jpg', 
 'Opposition wants action to protect Rio Cobre amid another fish kill', 
 'The Opposition is calling for the Government to do more in the fight against the pollution of the Rio Cobre in St Catherine. It says the recurrence of fish kills in the river is a serious matter of concern. The Opposition wants Prime Minister Andrew ...', 
 'The Gleaner - NEUTRAL', 'article4.php', 5),

('latest', '2024-06-12', './View/media/doc6.jpg', 
 'Haitian women arrested in Old Harbour remanded on illegal entry charge', 
 'Two Haitian women charged with illegal entry after being arrested in Old Harbour, St Catherine were today remanded in the parish court. Charged are 38-year-old Luca Vilmere and 37-year-old Dating Officiane. They were ordered to return to court on June 28 ...', 
 'The Gleaner - NEUTRAL', 'article5.php', 10),

('latest', '2024-06-10', NULL, 
 'Government Remains Committed to Youth Empowerment – PM', 
 'Prime Minister, the Most Hon. Andrew Holness, says the Government remains committed to continue delivering on policies conducive to youth empowerment, where young people can self-actualise and achieve their dreams like never before. Speaking to a group of ...', 
 'Jamaica Information Service - GOV\'T INSTITUTION', 'article6.php', 15),

('latest', '2024-06-10', './View/media/doc8.jpg', 
 'NEPA working to confirm source of latest Rio Cobre contamination', 
 'The National Environment and Planning Agency (NEPA) says it appears heavy rains that occurred in the Zephyrton, Linstead, area on Sunday may have resulted in storm water run-off of the likely contaminant which has caused the latest fish kill in the Rio ...', 
 'The Gleaner - NEUTRAL', 'article7.php', 5),

('featured', '2024-05-31 19:15:00', './View/media/f1.jpeg', 
 'New dean for Cummins Memorial Seminary', 
 'Bishop Willie J. Hill, Jr. the Bishop of the Reformed Episcopal Diocese of the Southeast is pleased to announce his appointment of the Rev. Dr. Glenvil Gregory as the new Dean of Cummins Memorial Seminary in Summerville, South Carolina. Following Bishop ...', 
 'Conferences & Trade Fairs', 'featured1.php', 5),

('featured', '2024-05-30 17:39:00', './View/media/f2.jpeg', 
 'Climate Risk and Early Warning Systems initiative builds momentum', 
 'The annual report, called “Building Momentum,” is packed with facts, figures and case studies of how CREWS funding has helped the poorest and most climate-vulnerable people protect their lives and livelihoods in the face of climate danger countries by ...', 
 'Travel & Tourism Industry', 'featured2.php', 15),

('featured', '2024-05-29 14:21:00', './View/media/f3.jpeg', 
 'CTO Bestows Inaugural Women’s Leadership Awards at Caribbean Week in New York', 
 'NEW YORK, UNITED STATES, June 24, 2024 /⁨EINPresswire.com⁩/ -- Tourism marketing professional Beverly Nicholson-Doty from the United States Virgin Islands received the “Secretary-General’s Distinguished Service Award” at the Caribbean Tourism ...', 
 'Travel & Tourism Industry', 'featured3.php', 20);
