# webchat

<br/>

#### Install:

- Dependencies: php, webserver (apache2/nginx), js-compatible browser
- Download project archive into your web directory and unpack it
- Do: "chmod 666" or "chown %username%:www-data" to databases/files.json and databases/messages.json
- Change config variables in files if you need
- On Linux systems you can just use embedded php server instead of nginx or apache2. Do "php -S 127.0.0.1:8080" in unpacked project and enjoy it!

<br/>

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
- Databases encryption with openssl
- It have pretty good compability with old browsers
- A detailed description will come later
- File viewer
- Many other! (See the sources)

<br/>

#### TODO:

##### Касаемо просмотрщика файлов 
- no flex: content position in div centered fullscreened, panel on top fixed и налепить кнопку скрытия/показа ?¿?
- найти способ отцентрировать контент в просмотрщике, сделать красиво (юзать flex) | html, css
- полный экран в просмотрщик | html, css, js
- определение высоты картинки относительно именно высоты страницы? | html, css

<br/>

##### Разное
- поправить вид функций (кривовато)
- комментарии в коде
- глянуть, какие нотифи можно ещё выводить
- решить косяк с форматированием текста при копировании из чата (задетектил на winXP)
- кнопка "назад" при переходе с другого места для тесной интеграции с другими сервисами
- поработать над условиями воспроизведения звукового уведомления (она ведь не постоянно должна отыгрывать)

<br/>

##### Настройки
- поменять некоторые переменные на php-серверные для универсальности
- клиентские настройки ввода
- больше настроек и изменяемости сделать под всёеее

<br/>

##### Оптимизация сети
- можно типо отсылать не всю базу сообщений а только то, чего нет у клиента (так можно разгрузить сеть, но потребуется переработка клиентского кода (возможно полностью)
- придумать как экономить и ускорить трафик (можно например не получать сообщения если свернут чат, или что-то подобное), сжимать там мб
- придумать как уменьшить кол-во/частоту запросов к серверу
- получше изучить работу соединения через сокеты, попытаться сделать максимально похожим

<br/>

##### Непрочитанные сообщения
- кол-во непрочитанных сообщений
- счетчик пропущенных сообщений?
- намутить такое что типо прокручивать не сразу прям вниз а до первого непрочитанного сообщения?

<br/>

##### Касаемо файлов и баз
- обратная совместимость с предыдущими версиями? (По крайней мере возможность импорта бд?)
- сразу проверять файл на требования, чтобы не захламлять базу
- custom limits for file size?
- custom limits for messages count?
- затирание баз (лимит, время, удаление старых вместо перезаписи (всё опционально))
- скрипты для редактирования/удаления файлов/сообщений (мб примитивную админку всё-таки сделать)
- возможность ограничить вывод на клиентской стороне?
- удаление сообщений пользователем с проверками
- кастомные ограничения по типу файла
- кастомнные ограничения по размеру сообщения | php
- загрузка файлов частями?
- фильтрация по типу (черный и белый список) и имени файла (pathinfo)

<br/>

##### Для режима клиента
- функция получения списка файлов
- переменную для префикса для клиента
- префикс для скачивания файлов если клиент
- remote files sending

<br/>

##### Разные новые окна
- окна ошибок/отказа
- окно процесса 
- дописать фул хелпу
- может сделать граф. пункт настройки??? Вынести переменные в базы и привязать к адресу с шифровкой
- можно кинуть хелпу в настройки потом
- credits?

<br/>

##### Касаемо безопасности
- защита от xss (глупо но да)
- можно юзать шифрование для контроля доступа к бд, и попытаться гасить левые запросы
- токены/пароли для удаленных клиентов?
- обфусцировать для продакшена при необходимости
- вообще надо широко изучить вопросы безопасности и доступа (скриптов, файлов, бд)
- ускорение записи в бд доп. запись без перезаписи?
- шифрование на стороне клиента?
- шифрование при передаче инфы?
- сжатие смс/файлов/баз?
- расширить валидацию (клиентскую безопасность), добавить в просмотрщик | js, php
- php basic auth against web server
- noSQL injection?
- по итогу протестить на безопасность ещё раз
- можно закатать в докер для бОльшей безопасности (намутить готоую приложуху)
- организовать проверки на стадии ввода?
- проверять вообще всё что выводится
- js отображение тупо символов в чистом виде если есть такое (characterescape)
- xss escape через title
- защита запросов
- RFI, LFI, RCE, CSRF, IDOR
- WAF
- контроль загружаемых файлов
- htmlspecialchars (или экранирование символов)
- php вывод инфы через уже обработанные переменные
- проверять всее входящие данные и валидировать их
- фильтр ввода
- кодирование url
- найти более правильный/безопасный chmod или chown для баз

<br/>

##### Косметические удобства
- авто закрытие ненужной вкладки (не знаю есть косяк или нет, просто)
- ники юзеров разными цветами
- может всё-таки локаль?
- drag-n-drop? Во все инпуты
- рекурсивный выбор файлов в папке
- анимация автопрокрутки инфы (подсказок) в инпутах (при недостаточной широте экрана например)
- кастомный скроллбар?
- кнопка очистки инпутов?
- плавные переходы между страницами
- тень внизу сообщений??? (Может всё-таки да?)

<br/>

##### Адаптивность
- на мобильных скрыть некоторые кнопки
- сделать адаптацию для мобильных устройств (в последнюю очередь) | js, css

<br/>

##### Расширения
- потом добавить файлы с кодом от комнат, хтпасс и т.д.
- обновить дефолтные базы (произойд[ут|шли] некоторые изменения)
- на мобильных (когда доберусь) фоновоую работу, уведомления, светодиод, вибро

<br/>

##### Темы
- true material default theme (щас не тру)
- сделать дефолтную тему без голубых элементов (на основе нынешней, нынешнюю переименовать)
- разные темы понаделать
- угловатая тема (светлая + темная) | css
- очень компактная тема (светлая + темная) | css
- темная тема (в самую последнюю очередь) | css

<br/>

##### Описания
- описание концепта комнат, т.к. не всем они нужны | html, css, markdown
- описание | markdown
- описание basic auth | markdown, cfg
- документацию по итогу
- расписать требования, используемые расширения и функции, и миним браузер для работы

<br/>

#### Keywords:

- webchat chat messenger chatroom anonim
