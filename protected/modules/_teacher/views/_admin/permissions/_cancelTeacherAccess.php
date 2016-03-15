<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/index'); ?>')">
            Права доступу
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showAddAccessForm'); ?>')">
            Додати запис
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/showAddTeacherAccess'); ?>')">
            Призначити автора модуля
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/UserStatus'); ?>')">
            Змінити статус користувача
        </button>
    </li>
</ul>

<div id="cancelTeacherAccess">
    <form role="form" class="col col-md-9">
        <div class="form-group">
            <input type="text" hidden="hidden" value="author" id="role">
            <label>Викладач:</label>
            <br>
            <input id="typeahead" type="text" class="form-control" placeholder="Викладач"
                   size="135" required autofocus>
            <input type="number" hidden="hidden" id="user" value="0"/>
        </div>
        <div class="form-group">
            <br>
            <div name="teacherModules" class="form-group"></div>
            <br>
            <input type="submit" class="btn btn-outline btn-warning" value="Скасувати"
                   onclick="cancelTeacherAccess('<?php echo Yii::app()->createUrl('/_teacher/_admin/permissions/cancelTeacherPermission'); ?>');
                       return false;">
        </div>
    </form>
</div>

<script>
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/permissions/teachersByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (users) {
                return $jq.map(users.results, function (user) {
                    return {
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        url: user.url
                    };
                });
            }
        }
    });

    users.initialize();

    $jq('#typeahead').typeahead(null, {
        name: 'users',
        display: 'email',
        source: users,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає викладачів з таким іменем або email\`ом',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
        }
    });

    $jq('#typeahead').on('typeahead:selected', function (e, item){
        $jq("#user").val(item.id);
        selectTeacherModules('<?=Yii::app()->createUrl("/_teacher/_admin/permissions/showTeacherModules");?>', item.id);
    });
</script>
