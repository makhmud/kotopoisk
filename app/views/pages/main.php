<div class="main clearfix">
    <div class="logo-wrapper">
        <div class="logo">
            <img src="/images/logo.png" alt="Котопоиск"/>
        </div>
        <h1>Кото<strong>поиск</strong></h1>
    </div>

    <div class="enter-switch">
        <a href="javascript:void()" ng-click="setActive('signup')" ng-class="{ 'active': isActive('signup') }">Зарегистрируйтесь</a>
        <span>Или</span>
        <a href="javascript:void()" ng-click="setActive('signin')" ng-class="{ active: isActive('signin') }">Войдите</a>
    </div>

    <div class="footer-container">
        <footer class="wrapper">
            <form ng-if="isActive('signup')">
                <input type="text" placeholder="Введите ваш Email" ng-model="settings.loginForms.signup.email"/>
                <input type="submit" value="Получить доступ"/>

                <div class="info-links">
                    <a href="#">Политика конфиденциальности</a>
                </div>
            </form>

            <form ng-if="isActive('signin')">
                <input type="text" placeholder="Введите ваш Email" ng-model="settings.loginForms.signin.email"/>
                <input type="password" placeholder="Пароль" ng-model="settings.loginForms.signin.password"/>

                <div class="lost-password">
                    <a href="javascript:void()" ng-click="setActive('remind')">Забыли пароль</a>
                </div>
                <input type="submit" value="Войти" ng-click="formSubmits.signin()"/>
            </form>

            <form ng-if="isActive('remind')">
                <input type="text" placeholder="Введите ваш Email" ng-model="settings.loginForms.remind.email"/>
                <input type="submit" value="Напомнить пароль"/>

                <div class="info-links">
                    <a href="#">Политика конфиденциальности</a>
                </div>
            </form>
        </footer>
    </div>
</div>