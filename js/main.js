var STORE = window.STORE || [];

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

function User() {
    let tableName = 'users';
    this.add = (login, password) => {
        if (this.getByField('login', login)) {
            return err('Пользователь существует');
        }
        STORE[tableName].push({
            'login': login,
            'password': password,
            'created_at': 1,
        });

        $api.update(function(resp) {
            console.log(resp);
        });

        return ok('Пользователь добавлен');
    };

    this.getByField = (key, value) => {
        let result = false;

        $.map(STORE[tableName], function (row, i) {
            if (row[key] === value) {
                result = row;
            }
        });
        return result;
    }
}

let $user = new User();
console.log($user.getByField('id', 1));
console.log($user.add('test', '123'));

