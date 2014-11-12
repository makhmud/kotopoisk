<div id="change-password-popup" class="popup"  ng-show="methods.isPopupOpened('change-password-popup')">
    <div class="controls">
        <a ng-click="methods.closePopup()" class="close"><span class="gallery-controls-close"></span></a>
    </div>
        <span class="icon"><span class="profile-icon-1"></span>

            <div class="text">Сменить пароль</div>
        </span>
    <div class="content">
        <form name="changePassword">
            <input type="password" required="required" ng-model="changePassForm.data.oldPass" placeholder="Старый пароль"/>
            <input type="password" required="required" ng-model="changePassForm.data.newPass" placeholder="Новый пароль"/>
            <input type="password" required="required" ng-model="changePassForm.data.newPassRepeat" placeholder="Повторите пароль"/>
            <input type="submit" ng-click="changePassForm.submit()" ng-disabled="changePassword.$invalid && (changePassForm.data.newPass != changePassForm.data.newPassRepeat)" value="Сменить пароль"/>
        </form>
    </div>
</div>