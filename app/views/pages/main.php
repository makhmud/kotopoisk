<div class="main clearfix">
    <div class="logo-wrapper">
        <div class="logo">
            <img src="/images/logo.png" alt="Котопоиск"/>
        </div>
        <h1>Кото<strong>поиск</strong></h1>
    </div>

    <div class="enter-switch">
        <a ng-click="setActive('signup')" ng-class="{ 'active': isActive('signup') }" ng-bind="'page.main.signup' | translate"></a>
        <span ng-bind="'or' | translate"></span>
        <a ng-click="setActive('signin')" ng-class="{ active: isActive('signin') }" ng-bind="'page.main.signin' | translate"></a>
    </div>

    <div class="footer-container">
        <footer class="wrapper">
            <form ng-if="isActive('signup')" name="register">
                <input type="text" placeholder="{{ 'placeholders.main.email' | translate }}" required="required" ng-model="settings.loginForms.signup.email"/>
                <input type="submit" value="{{ 'page.main.buttons.access' | translate }}"  ng-click="formSubmits.signup()" ng-disabled="register.$invalid" />
                <script src="//ulogin.ru/js/ulogin.js"></script>
                <div class="info-links">
                    <a href="#"  ng-bind="'page.main.policy' | translate"></a>
                </div>
            </form>

            <form ng-if="isActive('signin')" name="login">
                <input type="text" placeholder="{{ 'placeholders.main.email' | translate }}" required="required" ng-model="settings.loginForms.signin.email"/>
                <input type="password" placeholder="{{ 'placeholders.main.password' | translate }}" required="required" ng-model="settings.loginForms.signin.password"/>

                <div class="lost-password">
                    <a ng-click="setActive('remind')" ng-bind="'page.main.forgot' | translate"></a>
                </div>
                <input type="submit" value="{{ 'page.main.buttons.login' | translate }}" ng-click="formSubmits.signin()"  ng-disabled="login.$invalid" />
            </form>

            <form ng-if="isActive('remind')" name="remind">
                <input type="text" placeholder="{{ 'placeholders.main.email' | translate }}" required="required" ng-model="settings.loginForms.remind.email"/>
                <input type="submit" ng-click="formSubmits.remind()" value="{{ 'page.main.buttons.remind' | translate }}"  ng-disabled="remind.$invalid" />

                <div class="info-links">
                    <a href="#" ng-bind="'page.main.policy' | translate"></a>
                </div>
            </form>

            <p>Авторизация через социальные сети</p>
            <div id="uLogin"
                 data-ulogin="display=small;fields=first_name,last_name;providers=vkontakte,facebook;hidden=other;redirect_uri={{$host}}">
            </div>
        </footer>
    </div>
</div>