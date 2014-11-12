<div class="main clearfix">
    <div class="logo-wrapper">
        <div class="logo">
            <img src="/images/logo.png" alt="Котопоиск"/>
        </div>
        <h1>Кото<strong>поиск</strong></h1>
    </div>

    <div class="enter-switch">
        <a ng-click="setActive('signup')" ng-class="{ 'active': isActive('signup') }">Зарегистрируйтесь</a>
        <span>Или</span>
        <a ng-click="setActive('signin')" ng-class="{ active: isActive('signin') }">Войдите</a>
    </div>

    <div class="footer-container">
        <footer class="wrapper">
            <form ng-if="isActive('signup')" name="register">
                <input type="text" placeholder="Введите ваш Email" required="required" ng-model="settings.loginForms.signup.email"/>
                <input type="submit" value="Получить доступ"  ng-click="formSubmits.signup()" ng-disabled="register.$invalid" />

                <div class="info-links">
                    <a href="#">Политика конфиденциальности</a>
                </div>
            </form>

            <form ng-if="isActive('signin')" name="login">
                <input type="text" placeholder="Введите ваш Email" required="required" ng-model="settings.loginForms.signin.email"/>
                <input type="password" placeholder="Пароль" required="required" ng-model="settings.loginForms.signin.password"/>

                <div class="lost-password">
                    <a ng-click="setActive('remind')">Забыли пароль</a>
                </div>
                <input type="submit" value="Войти" ng-click="formSubmits.signin()"  ng-disabled="login.$invalid" />
            </form>

            <form ng-if="isActive('remind')" name="remind">
                <input type="text" placeholder="Введите ваш Email" required="required" ng-model="settings.loginForms.remind.email"/>
                <input type="submit" ng-click="formSubmits.remind()" value="Напомнить пароль"  ng-disabled="remind.$invalid" />

                <div class="info-links">
                    <a href="#">Политика конфиденциальности</a>
                </div>
            </form>
        </footer>
    </div>
</div>