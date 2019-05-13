


ALTER TABLE messages add lat varchar(30);
ALTER TABLE messages add lang varchar(30);
ALTER TABLE users add facebookProfile varchar(200);
ALTER TABLE users add twitterProfile varchar(200);
ALTER TABLE users add googleProfile varchar(200);
ALTER TABLE users add instagramProfile varchar(200);
ALTER TABLE comments add uploads varchar(30) DEFAULT '';


ALTER TABLE conversation_reply add lat varchar(30);
ALTER TABLE conversation_reply add lang varchar(30);
ALTER TABLE conversation_reply add uploads varchar(50);
ALTER TABLE users add email_activation varchar(300);
ALTER TABLE configurations add language_labels enum('0','1') DEFAULT '0';

ALTER TABLE users add emailNotifications enum('0','1') DEFAULT '1';



ALTER TABLE configurations ADD upload INT;
UPDATE configurations SET upload = '600' WHERE con_id = 1;

ALTER TABLE configurations ADD applicationToken VARCHAR(30) DEFAULT 'MySecretToken';



ALTER TABLE message_like ADD reactionType int(2) DEFAULT 1;

ALTER TABLE conversation add status enum('0','1') default '1';



CREATE TABLE IF NOT EXISTS language_labels (
`labelID` int(11) NOT NULL,
  `commonFriends` varchar(100) DEFAULT NULL,
  `commonGroups` varchar(100) DEFAULT NULL,
  `commonPhotos` varchar(100) DEFAULT NULL,
  `commonCreateGroup` varchar(100) DEFAULT NULL,
  `topMenuHome` varchar(100) DEFAULT NULL,
  `topMenuMessages` varchar(100) DEFAULT NULL,
  `topMenuNotifications` varchar(100) DEFAULT NULL,
  `topMenuSeeAll` varchar(100) DEFAULT NULL,
  `topMenuSettings` varchar(100) DEFAULT NULL,
  `topMenuLogout` varchar(100) DEFAULT NULL,
  `topMenuLogin` varchar(100) DEFAULT NULL,
  `topMenuJoin` varchar(100) DEFAULT NULL,
  `commonAbout` varchar(100) DEFAULT NULL,
  `commonRecentVisitors` varchar(100) DEFAULT NULL,
  `yourPhotos` varchar(100) DEFAULT NULL,
  `photosOfYours` varchar(100) DEFAULT NULL,
  `commonFollowers` varchar(100) DEFAULT NULL,
  `boxName` varchar(100) DEFAULT NULL,
  `boxUpdates` varchar(100) DEFAULT NULL,
  `boxWebcam` varchar(100) DEFAULT NULL,
  `boxLocation` varchar(100) DEFAULT NULL,
  `buttonUpdate` varchar(100) DEFAULT NULL,
  `buttonComment` varchar(100) DEFAULT NULL,
  `buttonFollow` varchar(100) DEFAULT NULL,
  `buttonFollowing` varchar(100) DEFAULT NULL,
  `buttonMessage` varchar(100) DEFAULT NULL,
  `buttonJoinGroup` varchar(100) DEFAULT NULL,
  `buttonUnfollowGroup` varchar(100) DEFAULT NULL,
  `buttonEditGroup` varchar(100) DEFAULT NULL,
  `buttonSaveSettings` varchar(100) DEFAULT NULL,
  `buttonSocialSave` varchar(100) DEFAULT NULL,
  `buttonLogin` varchar(100) DEFAULT NULL,
  `buttonSignUp` varchar(100) DEFAULT NULL,
  `buttonForgotButton` varchar(100) DEFAULT NULL,
  `buttonSetNewPassword` varchar(100) DEFAULT NULL,
  `buttonFacebook` varchar(100) DEFAULT NULL,
  `buttonGoogle` varchar(100) DEFAULT NULL,
  `buttonMicrosoft` varchar(100) DEFAULT NULL,
  `buttonLinkedin` varchar(100) DEFAULT NULL,
  `feedLike` varchar(100) DEFAULT NULL,
  `feedUnLike` varchar(100) DEFAULT NULL,
  `feedLikeThis` varchar(100) DEFAULT NULL,
  `feedShare` varchar(100) DEFAULT NULL,
  `feedUnshare` varchar(100) DEFAULT NULL,
  `feedShareThis` varchar(100) DEFAULT NULL,
  `feedComment` varchar(100) DEFAULT NULL,
  `feedDeleteUpdate` varchar(100) DEFAULT NULL,
  `feedPosted` varchar(100) DEFAULT NULL,
  `settingsTitle` varchar(100) DEFAULT NULL,
  `settingsUsername` varchar(100) DEFAULT NULL,
  `settingsEmail` varchar(100) DEFAULT NULL,
  `settingsName` varchar(100) DEFAULT NULL,
  `settingsPassword` varchar(100) DEFAULT NULL,
  `settingsChangePassword` varchar(100) DEFAULT NULL,
  `settingsOldPassword` varchar(100) DEFAULT NULL,
  `settingsNewPassword` varchar(100) DEFAULT NULL,
  `settingsConfirmPassword` varchar(100) DEFAULT NULL,
  `settingsGroup` varchar(100) DEFAULT NULL,
  `settingsGender` varchar(100) DEFAULT NULL,
  `settingsAboutMe` varchar(100) DEFAULT NULL,
  `settingsEmailAlerts` varchar(100) DEFAULT NULL,
  `socialTitle` varchar(100) DEFAULT NULL,
  `socialFacebook` varchar(100) DEFAULT NULL,
  `socialTwitter` varchar(100) DEFAULT NULL,
  `socialGoogle` varchar(100) DEFAULT NULL,
  `socialInstagram` varchar(100) DEFAULT NULL,
  `placeSearch` varchar(100) DEFAULT NULL,
  `placeComment` varchar(100) DEFAULT NULL,
  `placeUpdate` varchar(100) DEFAULT NULL,
  `placeEmailUsername` varchar(100) DEFAULT NULL,
  `placePassword` varchar(100) DEFAULT NULL,
  `placeEmail` varchar(100) DEFAULT NULL,
  `placeUsername` varchar(100) DEFAULT NULL,
  `loginTitle` varchar(100) DEFAULT NULL,
  `emailUsername` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `forgotPassword` varchar(100) DEFAULT NULL,
  `registrationTitle` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `agreeMessage` varchar(300) DEFAULT NULL,
  `resetPassword` varchar(300) DEFAULT NULL,
  `thankYou` varchar(100) DEFAULT NULL,
  `thankYouMessage` varchar(300) DEFAULT NULL,
  `buttonYou` varchar(100) DEFAULT NULL,
  `commonViewAll` varchar(30) DEFAULT NULL,
  `placeSendMessage` varchar(100) DEFAULT NULL,
  `notiFollowingYou` varchar(100) DEFAULT NULL,
  `notiLiked` varchar(30) DEFAULT NULL,
  `notiShared` varchar(30) DEFAULT NULL,
  `notiStatus` varchar(30) DEFAULT NULL,
  `msgDeleteConversation` varchar(30) DEFAULT NULL,
  `msgConversation` varchar(100) DEFAULT NULL,
  `msgStartConversation` varchar(100) DEFAULT NULL,
  `msgNoUpdates` varchar(100) DEFAULT NULL,
  `msgNoMoreUpdates` varchar(100) DEFAULT NULL,
  `msgNoFriends` varchar(100) DEFAULT NULL,
  `msgNoMoreFriends` varchar(100) DEFAULT NULL,
  `msgNoPhotos` varchar(100) DEFAULT NULL,
  `msgNoMorePhotos` varchar(100) DEFAULT NULL,
  `msgNoViews` varchar(100) DEFAULT NULL,
  `msgNoMoreViews` varchar(100) DEFAULT NULL,
  `msgNoGroups` varchar(100) DEFAULT NULL,
  `msgNoMoreGroups` varchar(100) DEFAULT NULL,
  `commonMembers` varchar(30) DEFAULT NULL,
  `msgNoMembers` varchar(100) DEFAULT NULL,
  `msgNoMoreMembers` varchar(100) DEFAULT NULL,
  `msgNoConversations` varchar(100) DEFAULT NULL,
  `terms` varchar(30) DEFAULT NULL,
  `notiIsFollowingGroup` varchar(100) DEFAULT NULL,
  `notiCommented` varchar(30) DEFAULT NULL,
  `msgNoFollowers` varchar(100) DEFAULT NULL,
  `msgNoMoreFollowers` varchar(100) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=3 ;



INSERT INTO `language_labels` (`labelID`, `commonFriends`, `commonGroups`, `commonPhotos`, `commonCreateGroup`, `topMenuHome`, `topMenuMessages`, `topMenuNotifications`, `topMenuSeeAll`, `topMenuSettings`, `topMenuLogout`, `topMenuLogin`, `topMenuJoin`, `commonAbout`, `commonRecentVisitors`, `yourPhotos`, `photosOfYours`, `commonFollowers`, `boxName`, `boxUpdates`, `boxWebcam`, `boxLocation`, `buttonUpdate`, `buttonComment`, `buttonFollow`, `buttonFollowing`, `buttonMessage`, `buttonJoinGroup`, `buttonUnfollowGroup`, `buttonEditGroup`, `buttonSaveSettings`, `buttonSocialSave`, `buttonLogin`, `buttonSignUp`, `buttonForgotButton`, `buttonSetNewPassword`, `buttonFacebook`, `buttonGoogle`, `buttonMicrosoft`, `buttonLinkedin`, `feedLike`, `feedUnLike`, `feedLikeThis`, `feedShare`, `feedUnshare`, `feedShareThis`, `feedComment`, `feedDeleteUpdate`, `feedPosted`, `settingsTitle`, `settingsUsername`, `settingsEmail`, `settingsName`, `settingsPassword`, `settingsChangePassword`, `settingsOldPassword`, `settingsNewPassword`, `settingsConfirmPassword`, `settingsGroup`, `settingsGender`, `settingsAboutMe`, `settingsEmailAlerts`, `socialTitle`, `socialFacebook`, `socialTwitter`, `socialGoogle`, `socialInstagram`, `placeSearch`, `placeComment`, `placeUpdate`, `placeEmailUsername`, `placePassword`, `placeEmail`, `placeUsername`, `loginTitle`, `emailUsername`, `password`, `forgotPassword`, `registrationTitle`, `email`, `username`, `agreeMessage`, `resetPassword`, `thankYou`, `thankYouMessage`, `buttonYou`, `commonViewAll`, `placeSendMessage`, `notiFollowingYou`, `notiLiked`, `notiShared`, `notiStatus`, `msgDeleteConversation`, `msgConversation`, `msgStartConversation`, `msgNoUpdates`, `msgNoMoreUpdates`, `msgNoFriends`, `msgNoMoreFriends`, `msgNoPhotos`, `msgNoMorePhotos`, `msgNoViews`, `msgNoMoreViews`, `msgNoGroups`, `msgNoMoreGroups`, `commonMembers`, `msgNoMembers`, `msgNoMoreMembers`, `msgNoConversations`, `terms`, `notiIsFollowingGroup`, `notiCommented`, `msgNoFollowers`, `msgNoMoreFollowers`) VALUES
(1, 'друзья', 'группы', 'Фото', 'Создать группу', 'Главная', 'Сообщения', 'Уведомления', 'Увидеть все', 'настройки', 'Выйти', 'Авторизоваться', 'Присоединиться', 'Около', 'Последние посетители', 'Профиль фотографии', 'Фотографии', 'Последователи', 'Что происходит', 'Обновления', 'Веб-камера', 'Место нахождения', 'Обновить', 'Комментарий', 'следить', 'Следующий', 'Сообщение', 'Вступить в группу', 'Отписаться Группа', 'Изменить группу', 'Сохранить настройки', 'Социальная Сохранить', 'Авторизоваться', 'Зарегистрироваться', 'Забыли пароль', 'Установить новый пароль - сброс', 'Войти с Facebook', 'Вход с Google', 'Вход с Microsoft', 'Вход с LinkedIn', 'подобно', 'В отличие от', 'как это', 'Поделиться', 'из открытого списка', 'поделились этой', 'Комментарий', 'Удалить обновление', 'Опубликовано в', 'Настройки Название', 'имя пользователя', 'Эл. адрес', 'имя', 'пароль', 'Изменить пароль', 'Старый пароль', 'новый пароль', 'Подтвердите Пароль', 'группа', 'Пол', 'Обо мне', 'Уведомления по электронной почте', 'Социальная Заголовок', 'Социальные сети Facebook', 'Социальная Twitter', 'Социальная Google', 'Социальная Instagram', 'Поиск людей', 'Написать комментарий', 'Написать обновление.', 'Электронная почта или имя пользователя.', 'Введите пароль', 'Введите адрес электронной почты', 'Введите имя пользователя', 'Войти Название', 'Электронная почта или имя пользователя', 'пароль', 'Забыли пароль', 'Регистрация Название', 'Эл. адрес ', 'Электронная почта или имя пользователя', 'Регистрация Согласитесь сообщение', 'Сброс пароля', 'Спасибо!', 'Пожалуйста conirm сообщение', 'Вы', 'Посмотреть все', 'Отправить сообщение', 'после вас', 'понравилось', 'общий', 'положение дел', 'Удалить беседу', 'разговор', 'Начало разговора', 'Нет обновлений', 'Нет больше обновлений', 'Нет друзей', 'Нет больше друзей', 'Нет фото', 'Нет больше фотографий', 'Нет просмотров', 'Нет больше просмотров', 'Нет групп', 'Нет больше групп', 'члены', 'Нет участников', 'Нет больше членов', 'Нет цепочек', 'сроки', 'следующая группа', 'прокомментировал', 'Нет последователи', 'Нет больше последователей');


ALTER TABLE `language_labels`
 ADD PRIMARY KEY (`labelID`);

ALTER TABLE `language_labels`
MODIFY `labelID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;


alter table `advertisments` add ad_type ENUM('0','1') DEFAULT '0';

alter table `advertisments` add ad_code text;
alter table `users` modify provider_id varchar(200);

