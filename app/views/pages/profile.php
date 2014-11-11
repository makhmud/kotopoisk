<div id="profile-menu">
    <a href="#" id="password-change-link"><span class="profile-icon-1"></span>

        <div class="text">Сменить пароль</div>
    </a>
    <div id="photos" flow-init="ngFlowParams" flow-files-submitted="$flow.upload()" flow-file-success="user.data.image = $message">
        <div class="file-button-container-big">
            <input type="file" class="photo-file-input" multiple="false" flow-btn flow-attrs="{accept:'image/*'}"/>
            <div class="photo-file-preview">
                <span class="profile-icon-3"></span>
                <div class="text">Сменить фото</div>
            </div>
            <img src="/user/{{user.data.image}}" flow-img="$flow.files[$flow.files.length-1]"/>
        </div>
    </div>
    </a><a ng-click="logout()" id="profile-change-link"><span class="profile-icon-2"></span>

        <div class="text">Выйти из профиля</div>
    </a>
</div>
<main style="background-image: url(/api/getUserPic?destination={{user.data.image}});">

    <form id="profile-form" name="AddCatForm" enctype='multipart/form-data'>
        <div class="form-item"><input type="text" ng-model="user.data.contacts.name" placeholder="Имя"/></div>
        <div class="form-item"><input type="text" ng-model="user.data.contacts.surname" placeholder="Фамилия"/></div>
        <div class="form-item"><input type="text" ng-model="user.data.contacts.city" placeholder="Город"/></div>
        <div class="form-item"><input type="text" ng-model="user.data.email" placeholder="E-Mail" disabled value="th@mail.ru"/></div>
        <div class="form-item"><input type="text" ng-model="user.data.contacts.phone" placeholder="Телефон"/></div>
        <div class="form-item"><input type="text" ng-model="user.data.contacts.web" placeholder="Страничка ВКонтакте"/></div>
        <div class="form-item">
            <select name="amount" id="amount" ng-model="user.data.contacts.cats_amount">
                <option value="0" disabled selected>Сколько у Вас котов?</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
        <input type="submit" value="Ваш профиль полностью заполнен!" ng-disabled="ProfileForm.$invalid" ng-click="saveUser()"/>
    </form>
</main>

<?php echo View::make('popup._popup')->with( array('popupIds'=> array('change_password') ) ) ?>