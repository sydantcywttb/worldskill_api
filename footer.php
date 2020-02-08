</div>

<!-- addTopicOneLevel -->
<div class="modal fade" id="addTopicOneLevelModal" tabindex="-1" role="dialog" aria-labelledby="addTopicOneLevelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTopicOneLevelModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bodyTopicOneLevel">
                <input type="hidden" value="1" name="level">
                <input type="hidden" value="0" name="parent_id">

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
                <button type="button" class="btn btn-primary addTopicOneLevelSave">Сохранить</button>
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