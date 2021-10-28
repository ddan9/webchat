# webchat
webchat

dependencies: php, webserver (apache2/nginx)

do: "chmod 777" or "chown www-data:www-data" to databases/files.json and databases/messages.json

you need to synchronize max_upload_file size variable in PHP and templates/attachments.html

Stack: js, html, css, php, json

It uses json as portable databases

You don't need to register to use it

You can share files with it

Pretty good style

Very good client security

Databases "encryption"

It have pretty good compability with old browsers

A detailed description will come later

Keywords:
webchat chat messenger chatroom anonim

#### TODO

- исправить косяк с автофокусом, html/js
- чото там просили уменьшить сообщения, css
- расширение блока сообщений из-за большого текста до заданного лимита, css/js(maybe)
- textarea обработчик табов для вставки, js
- textarea обработчик shift+enter для переноса, js
- textarea обработчик enter для отправки, js
- мооожет быть сделать ограничение длины сообщения, html
- наделать комнаты, fullstack
- описание, markdown
- найти способ полной шифровки базы с файлами, щас с этим проблемы, php
- добавить кнопку с крактим хелпом прям в чат, fullstack
- валидацию во вложениях, php
- полный экран, hz
- исправить косяки с масштабированием на больших экранах, css
- хоткеи accesskey, html
- расширить валидацию, js/php
- убрать кнопку "выбрать файл", hz
- добавить "системные" уведомления в центральный чат, fullstack 
- добавить "секретную" панель управления базами (очистка, сводка), fullstack
- сделать адаптацию для мобильных устройств, fullstack
- примитивный движок стилей, php
- потеря ника при переходах, php
