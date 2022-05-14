# webchat

#### Install:

- dependencies: php, webserver (apache2/nginx), js-compatible browser
- download project archive into your web directory and unpack it
- do: "chmod 777" or "chown www-data:www-data" to databases/files.json and databases/messages.json
- change cfg variables in config files if you need
- On Linux systems you can just use embedded php server instead of nginx or apache2. Do "php -S 127.0.0.1:8000" in unpacked project and enjoy it!

#### Features:

- This project is in active development. Nope
- Basically ready to use
- Stack: js, html, css, php, json, noSQL
- It uses json as portable databases
- Multiple file uploading
- Fully manual code (no frameworks)
- Fully open-source
- You don't need to register to use it
- You can share files with it
- Pretty good style
- Very good client security
- Databases "encryption"
- It have pretty good compability with old browsers
- A detailed description will come later
- File viewer

#### Keywords:

- webchat chat messenger chatroom anonim

#### TODO:

- найти способ отцентрировать контент в просмотрщике, сделать красиво | html, css
- полный экран в просмотрщик | html, css, js
- определение высоты картинки относительно именно высоты страницы? | html, css

<br/>

- может всё-таки локаль?
- title style?
- custom время и GMT php
- функция получения списка файлов
- переменную для префикса
- префикс для скачивания файлов если клиент
- тень внизу сообщений??? (Может всё-таки да?)
- поправить вид функций (кривовато)
- custom limits for file size?
- custom limits for messages count?
- больше инфы через title (ник, время, дата, адрес)
- new line in title
- даты (не время) сообщений и файлов красиво
- remote files sending
- окна ошибок/отказа
- окно процесса 
- кастомные ограничения по типу файла
- кастомнные ограничения по размеру сообщения | php
- скрипты для редактирования/удаления файлов/сообщений (мб примитивную админку всё-таки сделать)
- шифровка вместо кодировки (опционально)
- кол-во непрочитанных сообщений
- autocomplete html on/off
- ники юзеров разными цветами
- форматированные всплывающие подсказки (инфо)
- ввести переменную версии (и может быть взаимодействие на основе этой инфы)
- поменять некоторые переменные на php-серверные для универсальности

<br/>

- комментарии в коде
- дописать фул хелпу
- на мобильных скрыть некоторые кнопки
- php server
- расширить валидацию (клиентскую безопасность), добавить в просмотрщик | js, php
- сделать адаптацию для мобильных устройств (в последнюю очередь) | js, css
- разные темы понаделать
- угловатая тема (светлая + темная) | css
- очень компактная тема (светлая + темная) | css
- темная тема (в самую последнюю очередь) | css
- потом добавить файлы с кодом от комнат, хтпасс и т.д.
- обновить дефолтные базы (произойд[ут|шли] некоторые изменения)
- описание концепта комнат, т.к. не всем они нужны | html, css, markdown
- описание | markdown
- описание basic auth | markdown, cfg
- документацию по итогу
