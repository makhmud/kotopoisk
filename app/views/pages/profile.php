<div id="profile-menu">
    <a href="#" id="password-change-link"><span class="profile-icon-1"></span>

        <div class="text">Сменить пароль</div>
    </a>
    <div id="photos">
        <div class="file-button-container-big">
            <input type="file" class="photo-file-input"/>
            <div class="photo-file-preview">
                <span class="profile-icon-3"></span>
                <div class="text">Сменить фото</div>
            </div>
            <img src="profile.jpg" alt="123"/>
        </div>
    </div>
    </a><a href="#"  id="profile-change-link"><span class="profile-icon-2"></span>

        <div class="text">Выйти из профиля</div>
    </a>
</div>
<main>

    <form id="profile-form">
        <div class="form-item"><input type="text" placeholder="Имя"/></div>
        <div class="form-item"><input type="text" placeholder="Фамилия"/></div>
        <div class="form-item"><input type="text" placeholder="Город"/></div>
        <div class="form-item"><input type="text" placeholder="E-Mail" disabled value="th@mail.ru"/></div>
        <div class="form-item"><input type="text" placeholder="Телефон"/></div>
        <div class="form-item"><input type="text" placeholder="Страничка ВКонтакте"/></div>
        <div class="form-item">
            <select name="amount" id="amount">
                <option value="" disabled selected>Сколько у Вас котов?</option>
                <option value="">1</option>
                <option value="">2</option>
                <option value="">3</option>
            </select>
        </div>
        <input type="submit" value="Ваш профиль полностью заполнен!"/>
    </form>
</main>

<?php echo View::make('popup._popup')->with( array('popupIds'=> array('change_password') ) ) ?>