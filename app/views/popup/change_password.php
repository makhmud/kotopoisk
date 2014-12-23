<div id="change-password-popup" class="popup"  ng-show="methods.isPopupOpened('change-password-popup')">
    <div class="controls">
        <a ng-click="methods.closePopup()" class="close"><span class="gallery-controls-close"></span></a>
    </div>
        <span class="icon"><span class="profile-icon-1"></span>

            <div class="text">Сменить пароль</div>
        </span>
    <div class="content">
        <form name="changePassword">
            <input type="password" required="required" ng-model="changePassForm.data.oldPass" placeholder="{{'placeholders.old_password' | translate}}"/>
            <input type="password" required="required" ng-model="changePassForm.data.newPass" placeholder="{{'placeholders.new_password' | translate}}"/>
            <input type="password" required="required" ng-model="changePassForm.data.newPassRepeat" placeholder="{{'placeholders.new_password_repeat' | translate}}"/>
            <input type="submit" ng-click="changePassForm.submit()" ng-disabled="changePassword.$invalid && (changePassForm.data.newPass != changePassForm.data.newPassRepeat)" value="{{'placeholders.change_password_button' | translate}}"/>
        </form>
    </div>
</div>