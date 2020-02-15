var STORE = window.STORE || [];
var PARAM_GET = window._GET || [];
var PARAM_POST = window._POST || [];
var WEBSITE = 'http://api.worldproject.rf';

let $db = new DB();
let $api = new API();
let $user = new User();
let $topics = new Topics();
let $themes = new Themes();
let $messages = new Messages();
let $themeUsers = new ThemeUsers();

$api.get();
$user.init();
$topics.init();
$themes.init();
$messages.init();
$themeUsers.init();


function ok(msg) {
    return {
        'status': true,
        'data': msg,
    }
}

function err(msg) {
    return {
        'status': false,
        'data': msg,
    }
}

function showMessage(type, msg) {
    $('.alerts').append('<div class="alert-' + type + '">' + msg + '<div>');
    setTimeout(function () {
        $('.alerts').empty();
    }, 3000)
}

function API() {
    this.get = async () => {
        let response = await fetch('/api.php?api=all');
        if (response.ok) {
            let json = await response.json();
            window.STORE = json;
            STORE = json;
            updateElements();
        }
    };

    this.update = async (done) => {
        var formData = new FormData();
        formData.append('api', 'update');
        formData.append('data', JSON.stringify(STORE));

        let response = await fetch('/api.php', {
            method: 'POST',
            body: formData
        });
        if (response.ok) {
            let json = await response.json();
            done(json);
        }
    };
}

function DB() {
    this.getByField = (tableName, key, value) => {
        let result = false;

        $.map(STORE[tableName], function (row, i) {
            if (row[key] === value) {
                result = row;
            }
        });
        return result;
    }
}

function User() {

    let tableName = 'users';

    this.add = (arParams = {}, done) => {
        if (this.getByField('login', arParams['login'])) {
            done(err('Пользователь существует'));
            return;
        }
        arParams['created_at'] = 1;
        STORE[tableName].push(arParams);
        STORE['user'] = arParams['login'];

        $api.update(function (resp) {
            $api.get();
            done(ok('Пользователь добавлен'));
        });

    };

    this.login = (login, done) => {
        STORE['user'] = login;

        $api.update(function (resp) {
            $api.get();
            done(ok('Успешный вход в личный кабинет'));
        });
    };

    this.getByField = (key, value) => {
        return $db.getByField(tableName, key, value);
    };

    this.init = () => {
        this.submitLogin()
        this.submitRegister()
        this.submitExit()
    }

    this.submitLogin = () => {
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();

            let data = getInputs(this);

            let user = $user.getByField('login', data['login']);
            if (user['password'] === data['password']) {
                $user.login(data['login'], function () {
                    location.href = '/';
                });
                return false;
            }

            showMessage('danger', 'Неправильный логин или пароль');

            return false;
        });
    }

    this.submitRegister = () => {
        $('#registerForm').on('submit', function (e) {
            e.preventDefault();

            let data = getInputs(this);

            $user.add(data, function (result) {
                let type = (result['status']) ? 'success' : 'danger';
                showMessage(type, result['data']);
                if (result['status']) {
                    location.href = '/';
                }
            });

            return false;
        });

    }

    this.submitExit = () => {
        $('.action-exit').on('click', function (e) {
            $user.login('', function () {
                location.href = '/login.php';
            });
            return false;
        });

    }
}

function Topics() {

    let tableName = 'topics';

    this.add = (arParams = {}, done) => {
        arParams['created_at'] = 1;
        STORE[tableName].push(arParams);

        $api.update(function (resp) {
            $api.get();
            done(ok('Раздел добавлен'));
        });
    };

    this.getAll = (parent, level) => {
        let result = [];
        $.map(STORE[tableName], function (topic, key) {
            if (topic['parent_id'] === parent && topic['level'] === level) {
                result.push(topic);
            }
        });
        return result;
    }

    this.init = () => {
        this.openModal();
        this.submitForm();
    }

    this.openModal = () => {
        $('.addTopic').on('click', function (e) {
            let parent = $(this).attr('data-parent');
            let level = $(this).attr('data-level');

            let form = $('.addTopicForm');
            form.find('input[name="level"]').val(level);
            form.find('input[name="parent_id"]').val(parent);
            $('#addTopicModal').modal('show');
        });
    }

    this.submitForm = () => {
        $('.addTopicSave').on('click', function (e) {
            let data = getInputs('.addTopicForm');

            $topics.add(data, function (result) {
                let type = (result['status']) ? 'success' : 'danger';
                showMessage(type, result['data']);
            });
        });
    }

    this.renderAll = () => {
        let el = $('#topicsAll');
        let parent = el.attr('data-parent');
        let level = el.attr('data-level');
        el.empty();

        let data = $topics.getAll(parent, level);
        $.map(data, function (row, i) {
            if (row['level'] === level && row['parent_id'] === parent) {
                let text = `
             <a href="/topics.php?id=${row['id']}&level=${row['level']}" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">${row['title']}</h5>
    </div>
    <p class="mb-1">${row['content']}</p>
  </a>`;
                el.append(text)
            }
        });
    }
}

function Themes() {

    let tableName = 'themes';

    this.add = (arParams = {}, done) => {
        arParams['created_at'] = 1;
        STORE[tableName].push(arParams);

        $api.update(function (resp) {
            $api.get();
            done(ok('Тема добавлена'));
        });
    };

    this.getAll = (parent) => {
        let result = [];
        $.map(STORE[tableName], function (theme, key) {
            if (theme['parent_id'] === parent) {
                result.push(theme);
            }
        });
        return result;
    }

    this.getByField = (key, value) => {
        return $db.getByField(tableName, key, value);
    };

    this.init = () => {
        this.openModal();
        this.submitForm();
        this.openEditModal();
        this.submitEditForm();
        this.linkForm();

    }

    this.openModal = () => {
        $('.addTheme').on('click', function (e) {
            let parent = $(this).attr('data-parent');

            let form = $('.addThemeForm');
            form.find('input[name="parent_id"]').val(parent);
            $('#addThemeModal').modal('show');
        });
    }

    this.submitForm = () => {
        $('.addThemeSave').on('click', function (e) {
            let data = getInputs('.addThemeForm');

            $themes.add(data, function (result) {
                let type = (result['status']) ? 'success' : 'danger';
                showMessage(type, result['data']);
            });
        });
    }

    this.openEditModal = () => {
        $('.editTheme').on('click', function (e) {
            let id = $(this).attr('data-id');

            let theme = $themes.getByField('id', id);

            let form = $('.editThemeForm');
            form.find('input[name="id"]').val(id);
            form.find('input[name="title"]').val(theme['title']);
            form.find('input[name="content"]').val(theme['content']);
            form.find('input[name="type"]').val(theme['type']);
            $('#editThemeModal').modal('show');
        });
    }

    this.submitEditForm = () => {
        $('.editThemeSave').on('click', function (e) {
            let data = getInputs('.editThemeForm');

            let theme = $themes.getByField('id', data['id']);
            theme['title'] = data['title'];
            theme['content'] = data['content'];
            theme['type'] = data['type'];
            theme['updated_at'] = 1;

            $.map(STORE[tableName], function (value, key) {
                if (value['id'] === theme['id']) {

                    STORE[tableName].splice(key, 1, theme)
                    return true;
                }
            });

            $api.update(function (resp) {
                $api.get();
                showMessage('success', 'Успешно изменено');
                return true;
            });

            return false;

        });
    }

    this.linkForm = () => {
        $('.linkTheme').on('click', function (e) {
            let id = $(this).attr('data-id');

            let form = $('.linkForm');
            form.find('input[name="link"]').val(`${WEBSITE}/themes.php?id=${id}`);
            $('#linkModal').modal('show');

            return false;

        });
    }

    this.renderAll = () => {
        let el = $('#themesAll');
        let parent = el.attr('data-parent');
        el.empty();

        let data = $themes.getAll(parent);
        $.map(data, function (row, i) {
            if (row['parent_id'] === parent) {
                let text = `
             <a href="/themes.php?id=${row['id']}" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">${row['title']}</h5>
    </div>
  </a>`;
                el.append(text)
            }
        });
    }
}

function Messages() {

    let tableName = 'messages';

    this.add = (arParams = {}, done) => {
        arParams['created_at'] = 1;
        STORE[tableName].push(arParams);

        $api.update(function (resp) {
            $api.get();
            done(ok('Сообщение добавлено'));
        });
    };

    this.getAll = (parent) => {
        let result = [];
        $.map(STORE[tableName], function (theme, key) {
            if (theme['parent_id'] === parent) {
                result.push(theme);
            }
        });
        return result;
    }

    this.getByField = (key, value) => {
        return $db.getByField(tableName, key, value);
    };

    this.init = () => {

        this.openModal();
        this.submitForm();
        this.submitEditForm();
    }


    this.openModal = () => {
        $('.addMessage').on('click', function (e) {
            let parent = $(this).attr('data-parent');

            let form = $('.addMessageForm');
            form.find('input[name="parent_id"]').val(parent);
            $('#addMessageModal').modal('show');
        });
    }

    this.submitForm = () => {
        $('.addMessageSave').on('click', function (e) {
            let data = getInputs('.addMessageForm');

            $messages.add(data, function (result) {
                let type = (result['status']) ? 'success' : 'danger';
                showMessage(type, result['data']);
            });
        });
    }

    this.submitEditForm = () => {
        $('.editMessageSave').on('click', function (e) {
            let data = getInputs('.editMessageForm');

            let message = $messages.getByField('id', data['id']);
            message['content'] = data['content'];
            message['updated_at'] = 1;

            $.map(STORE[tableName], function (value, key) {
                if (value['id'] === message['id']) {

                    STORE[tableName].splice(key, 1, message)
                    return true;
                }
            });

            $api.update(function (resp) {
                $api.get();
                return true;
            });

            return false;

        });
    }

    this.renderButtons = () => {
        this.openEditModal();
        this.openReply();
        this.openLink();

    }

    this.openEditModal = () => {
        let $editMessage = $('.editMessage');
        $editMessage.off('click');

        $editMessage.on('click', function (e) {
            let mBox = $(this).closest('.messageBox');
            let id = mBox.attr('data-id'),
                message = $messages.getByField('id', id);

            let form = $('.editMessageForm');
            form.find('input[name="id"]').val(id);
            form.find('input[name="content"]').val(message['content']);
            $('#editMessageModal').modal('show');
        });
    }

    this.openReply = () => {
        let $replyMessage = $('.replyMessage');
        $replyMessage.off('click');

        $replyMessage.on('click', function (e) {
            let mBox = $(this).closest('.messageBox');
            let id = mBox.attr('data-id'),
                message = $messages.getByField('id', id);

            let form = $('.addMessageForm');
            form.find('input[name="parent_id"]').val(message['parent_id']);
            form.find('input[name="qu_content"]').val(message['content']);
            $('#addMessageForm').modal('show');
        });
    }

    this.openLink = () => {

        let $linkMessage = $('.linkMessage');
        $linkMessage.off('click');
        $linkMessage.on('click', function (e) {
            let mBox = $(this).closest('.messageBox');
            let id = mBox.attr('data-id'),
                message = $messages.getByField('id', id);

            let form = $('.linkForm');
            form.find('input[name="link"]').val(`${WEBSITE}/themes.php?id=${message['parent_id']}&message=${message['id']}`);
            $('#linkModal').modal('show');
        });
    }

    this.renderAll = () => {
        let el = $('#messagesAll');
        let parent = el.attr('data-parent');
        el.empty();

        let data = $messages.getAll(parent);
        $.map(data, function (row, i) {
            if (row['parent_id'] === parent) {
                let date = new Date(row['created_at'] * 1000);
                let dateFormat = date.getDate() + '.' + date.getMonth() + '.' + date.getFullYear() + ' ';
                dateFormat += date.getHours() + ':' + date.getMinutes();

                let buttons = '';
                if (STORE['user'] === row['owner_login']) {
                    buttons += `<li class="nav-item"><a class="nav-link editMessage" href="#">Редактировать</a></li>`;
                } else {
                    buttons += `<li class="nav-item"><a class="nav-link replyMessage" href="#">Ответить</a></li>`;
                }
                buttons += `<li class="nav-item"><a class="nav-link linkMessage" href="#">Ссылка на сообщение</a></li>`;


                let qu = '';
                if (row['qu_content'].length > 1) {
                    qu = `Цитата на сообщение: ${row['qu_content']}`;
                }

                let text = `<div class="media messageBox my-3" data-id="${row['id']}">
  <svg class="bd-placeholder-img mr-3" width="64" height="64" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 64x64"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">64x64</text></svg>
  <div class="media-body">
    <h5 class="mt-0">${row['owner_login']}</h5>
    <small>${dateFormat}</small>
    <p>${row['content']}</p>
    <p>${qu}</p>
    <ul class="nav">${buttons}</ul>
  </div>
</div>`;
                el.append(text)
            }
        });

        this.renderButtons();
    }
}

function ThemeUsers() {

    let tableName = 'theme_users';

    this.add = (arParams = {}, done) => {
        arParams['created_at'] = 1;
        STORE[tableName].push(arParams);

        $api.update(function (resp) {
            $api.get();
            done(ok('Пользователь добавлен'));
        });
    };

    this.getAll = (theme_id) => {
        let result = [];
        $.map(STORE[tableName], function (theme, key) {
            if (theme['theme_id'] === theme_id) {
                result.push(theme);
            }
        });
        return result;
    }

    this.getByField = (key, value) => {
        return $db.getByField(tableName, key, value);
    };

    this.init = () => {
        this.openModal();
        this.submitForm();

    }

    this.openModal = () => {
        $('.addThemeUser').on('click', function (e) {
            let id = $(this).attr('data-id');

            let form = $('.addThemeUserForm');
            form.find('input[name="theme_id"]').val(id);
            $('#addThemeUserModal').modal('show');
        });
    }

    this.submitForm = () => {
        $('.addThemeUserSave').on('click', function (e) {
            let data = getInputs('.addThemeUserForm');

            $themeUsers.add(data, function (result) {
                let type = (result['status']) ? 'success' : 'danger';
                showMessage(type, result['data']);
            });
        });
    }

    this.renderAll = () => {
        let el = $('#themeUsersAll');
        let themeId = el.attr('data-id');
        el.empty();

        let data = $themeUsers.getAll(themeId);
        $.map(data, function (row, i) {
            let text = `<div class="list-group-item list-group-flush">${row['login']}</div>`;
            el.append(text)
        });
    }
}

/*
* Forms
* */
function getInputs(context) {
    let data = {};
    $(context).find('input[name], select[name]').each(function () {
        data[$(this).attr('name')] = $(this).val();
    });
    return data;
}

function updateElements() {

    if ($('#topicsAll').length) {
        $topics.renderAll();
    }
    if ($('#themesAll').length) {
        $themes.renderAll();
    }
    if ($('#messagesAll').length) {
        $messages.renderAll();
    }
    if ($('#themeUsersAll').length) {
        $themeUsers.renderAll();
    }

    checkRights();
}

function checkRights() {
    if (!STORE.hasOwnProperty('user')) {
        return false;
    }
    let login = STORE['user'];
    let user = $user.getByField('login', login);
    let group_id = user['group_id'];

    if (group_id === 'expert') {
        $('.addTopic').hide();
        $('.addTheme').hide();
        $('.addThemeUser').hide();

    } else if (group_id === 'glav_expert') {
        $('.addTopic').hide();

    } else {

    }

    return true;
}