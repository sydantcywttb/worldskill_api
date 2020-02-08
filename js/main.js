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

function API() {
    this.get = async () => {
        let response = await fetch('/api.php?api=all');
        if (response.ok) {
            let json = await response.json();
            window.STORE = json;
            STORE = json;
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

    }
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

        $api.update(function (resp) {
            done(ok('Пользователь добавлен'));
        });

    };

    this.getByField = (key, value) => {
        return $db.getByField(tableName, key, value);
    }
}

let $user = new User();


if (PARAM_GET) {
    if (PARAM_GET.hasOwnProperty('method')) {
        switch (PARAM_GET['method']) {
            case 'register':
                let result = $user.add(PARAM_GET);
                if(result['status']) {
                    $('body').prepend('<div class="alert-success">'+result['data']+'<div>');
                } else {
                    $('body').prepend('<div class="alert-danger">'+result['data']+'<div>');
                }
                break;

        }
        $api.get();
    }
}

$('#register').on('submit', function(e) {
    e.preventDefault();

    let data = {};
    $('#register').find('input[name]').each(function() {
        data[$(this).attr('name')] = $(this).val();
    });

    $user.add(data, function(result) {
        if(result['status']) {
            $('body').prepend('<div class="alert-success">'+result['data']+'<div>');
        } else {
            $('body').prepend('<div class="alert-danger">'+result['data']+'<div>');
        }
    });

    return false;
})