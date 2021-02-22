INSERT INTO `surveys` (`id`, `created_at`, `updated_at`, `name`, `slug`, `expires_at`, `user_id`, `banner_id`) VALUES
(1, '2021-02-11 04:58:02', '2021-02-11 04:58:02', 'What do Kess Game Pieces Secretly Symbolize?', 'what-do-kess-game-pieces-secretly-symbolize', NULL, 1, NULL),
(2, '2021-02-11 04:53:23', '2021-02-11 04:53:23', 'Should we have National Stroke Insurance? Vote!', 'should-we-have-national-stroke-insurance-vote', NULL, 1, NULL);

INSERT INTO `choices` (`id`, `created_at`, `updated_at`, `name`, `image`, `link_text`, `link_url`, `survey_id`) VALUES
(2, '2021-02-11 04:55:31', '2021-02-22 00:07:04', 'Yes I think it is time!', 'public/images/yes_1607289298_1613934424.jpg', 'Yes I think it is time!', 'https://opinion.us.com/surveys/should-we-have-national-stroke-insurance-vote/results?choice_id=9', 1),
(3, '2021-02-11 04:56:08', '2021-02-22 00:07:13', 'Your bankruptcy is your problem!', 'public/images/broke-4765739_640_1607289397_1613934433.jpg', 'Your bankruptcy is your problem!', 'https://opinion.us.com/surveys/should-we-have-national-stroke-insurance-vote/vote', 1),
(4, '2021-02-11 04:56:31', '2021-02-22 00:07:23', 'I don\'t know and I don\'t care', 'public/images/confused-2681507_640_1607382134_1613934443.jpg', 'I don\'t know and I don\'t care', 'https://opinion.us.com/surveys/should-we-have-national-stroke-insurance-vote/vote', 1),
(5, '2021-02-11 04:58:28', '2021-02-22 00:07:42', 'Conservatives vs Liberals', 'public/images/elephant-2798628_640_1601853455_1613934462.jpg', 'Conservatives vs Liberals', 'https://opinion.us.com/surveys/what-do-kess-game-pieces-secretly-symbolize/vote', 2),
(6, '2021-02-11 04:58:51', '2021-02-22 00:07:51', 'The Union vs the Confederacy', 'public/images/war-3401481_640_1601853579_1613934471.jpg', 'The Union vs the Confederacy', 'https://opinion.us.com/surveys/what-do-kess-game-pieces-secretly-symbolize/vote', 2),
(7, '2021-02-11 04:59:11', '2021-02-22 00:07:58', 'Nato vs the Soviet Union?', 'public/images/checkpoint-charlie-1006111_640_1601853731_1613934478.jpg', 'Nato vs the Soviet Union?', 'https://opinion.us.com/surveys/what-do-kess-game-pieces-secretly-symbolize/vote', 2),
(8, '2021-02-11 04:59:47', '2021-02-22 00:08:09', 'Vikings vs the Britons?', 'public/images/waters-3060940_640_1601853851_1613934489.jpg', 'Vikings vs the Britons?', 'https://opinion.us.com/surveys/what-do-kess-game-pieces-secretly-symbolize/vote', 2),
(9, '2021-02-11 05:00:19', '2021-02-22 00:08:20', 'USA vs China?', 'public/images/dragon-872933_640_1601853982_1613934500.jpg', 'USA vs China?', 'https://opinion.us.com/surveys/what-do-kess-game-pieces-secretly-symbolize/vote', 2),
(10, '2021-02-11 05:00:45', '2021-02-22 00:08:29', 'It is just You vs Me', 'public/images/hearts-5502657_640_1601854826_1613934509.png', 'It is just You vs Me', 'https://opinion.us.com/surveys/what-do-kess-game-pieces-secretly-symbolize/vote', 2);