var STORE = window.STORE || [];
var PARAM_GET = window._GET || [];
var PARAM_POST = window._POST || [];

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

let $api = new API();
$api.get();

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

let $db = new DB();

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
    }
}

let $user = new User();

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

    this.getByField = (key, value) => {
        return $db.getByField(tableName, key, value);
    };

    this.getAll = (parent, level) => {
        let result = [];
        $.map(STORE[tableName], function(topic, key) {
            if(topic['parent_id'] === parent && topic['level'] === level) {
                result.push(topic);
            }
        });
        return result;
    }
}

let $topics = new Topics();


/*
* Forms
* */
function getInputs(context) {
    let data = {};
    $(context).find('input[name]').each(function () {
        data[$(this).attr('name')] = $(this).val();
    });
    return data;
}

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

$('.action-exit').on('click', function (e) {
    $user.login('', function () {
        location.href = '/login.php';
    });
    return false;
});


$('.addTopic').on('click', function (e) {
    let parent = $(this).attr('data-parent');
    let level = $(this).attr('data-level');

    let form = $('.addTopicForm');
    form.find('input[name="level"]').val(level);
    form.find('input[name="parent_id"]').val(parent);
    $('#addTopicModal').modal('show');
});

$('.addTopicSave').on('click', function (e) {
    let data = getInputs('.addTopicForm');

    $topics.add(data, function (result) {
        let type = (result['status']) ? 'success' : 'danger';
        showMessage(type, result['data']);
    });
});

function topicsAll() {
    let el = $('#topicsAll');
    let parent = el.attr('data-parent');
    let level = el.attr('data-level');
    el.empty();

    let data = $topics.getAll(parent, level);
    $.map(data, function(row, i) {
        if(row['level'] === '1') {
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

function updateElements() {

    if ($('#topicsAll').length) {
        topicsAll();
    }

    checkRights();
}

function checkRights() {
    if(!STORE.hasOwnProperty('user')) {
        return false;
    }
    let login = STORE['user'];
    let user = $user.getByField('login', login);
    let group_id = user['group_id'];

    if(group_id === 'expert') {
        $('.addTopic').hide();

    } else if(group_id === 'glav_expert') {


    } else {

    }

    return true;
}