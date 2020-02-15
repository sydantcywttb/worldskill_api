</div>

<!-- addTopicModal -->
<div class="modal fade" id="addTopicModal" tabindex="-1" role="dialog" aria-labelledby="addTopicModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTopicModalLabel">Добавление раздела</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body addTopicForm">
                <input type="hidden" value="1" name="level">
                <input type="hidden" value="0" name="parent_id">
                <input type="hidden" value="<?= $USER?>" name="owner_login">

                <div class="form-group">
                    <label for="exampleInputEmail1">Название раздела</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Описание</label>
                    <input type="text" name="content" class="form-control" id="exampleInputPassword1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary addTopicSave">Сохранить</button>
            </div>
        </div>
    </div>
</div>


<!-- addThemeModal -->
<div class="modal fade" id="addThemeModal" tabindex="-1" role="dialog" aria-labelledby="addThemeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addThemeModalLabel">Добавление темы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body addThemeForm">
                <input type="hidden" value="0" name="parent_id">
                <input type="hidden" value="<?= $USER?>" name="owner_login">

                <div class="form-group">
                    <label for="exampleInputEmail1">Название темы</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="selectEmail1">Название темы</label>
                    <select id="selectEmail1" name="type" class="form-control">
                        <option value="public">Открытая</option>
                        <option value="info">Информационная</option>
                        <option value="private">Закрытая</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Описание</label>
                    <input type="text" name="content" class="form-control" id="exampleInputPassword1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary addThemeSave">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<!-- editThemeModal -->
<div class="modal fade" id="editThemeModal" tabindex="-1" role="dialog" aria-labelledby="editThemeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editThemeModalLabel">Редактирование темы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body editThemeForm">
                <input type="hidden" value="0" name="id">

                <div class="form-group">
                    <label for="exampleInputEmail1">Название темы</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="selectEmail1">Название темы</label>
                    <select id="selectEmail1" name="type" class="form-control">
                        <option value="public">Открытая</option>
                        <option value="info">Информационная</option>
                        <option value="private">Закрытая</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Описание</label>
                    <input type="text" name="content" class="form-control" id="exampleInputPassword1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary editThemeSave">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<!-- addThemeUserModal -->
<div class="modal fade" id="addThemeUserModal" tabindex="-1" role="dialog" aria-labelledby="addThemeUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addThemeUserModalLabel">Добавление участника</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body addThemeUserForm">
                <input type="hidden" value="0" name="theme_id">

                <div class="form-group">
                    <label for="exampleInputEmail1">Логин участника</label>
                    <input type="text" name="login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary addThemeUserSave">Сохранить</button>
            </div>
        </div>
    </div>
</div>


<!-- addMessageModal -->
<div class="modal fade" id="addMessageModal" tabindex="-1" role="dialog" aria-labelledby="addMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMessageModalLabel">Добавление сообщения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body addMessageForm">
                <input type="hidden" value="" name="qu_content">
                <input type="hidden" value="0" name="parent_id">
                <input type="hidden" value="<?= $USER?>" name="owner_login">

                <div class="form-group">
                    <label for="exampleInputPassword1">Сообщение</label>
                    <input type="text" name="content" class="form-control" id="exampleInputPassword1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary addMessageSave">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<!-- editMessageModal -->
<div class="modal fade" id="editMessageModal" tabindex="-1" role="dialog" aria-labelledby="editMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMessageModalLabel">Редактирование сообщения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body editMessageForm">
                <input type="hidden" value="0" name="id">

                <div class="form-group">
                    <label for="exampleInputPassword1">Сообщение</label>
                    <input type="text" name="content" class="form-control" id="exampleInputPassword1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary editMessageSave">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<!-- linkModal -->
<div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="linkModalLabel">Получить ссылку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body linkForm">

                <div class="form-group">
                    <label for="exampleInputPassword1">Ссылка</label>
                    <input type="text" name="link" class="form-control" id="exampleInputPassword1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<script src="/js/jquery.js"></script>
<script src="/js/main.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/popper.min.js"></script>

</body>
</html>