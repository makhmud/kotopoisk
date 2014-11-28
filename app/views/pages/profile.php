<div id="profile-menu">
    <a ng-click="methods.showPopup('change-password-popup')" id="password-change-link"><span class="profile-icon-1"></span>

        <div class="text" ng-bind="'page.profile.change_password' | translate"></div>
    </a>
    <div id="photos" flow-init="ngFlowParams" flow-files-submitted="$flow.upload()" flow-file-success="user.data.image = $message">
        <div class="file-button-container-big">
            <input type="file" class="photo-file-input" multiple="false" flow-btn flow-attrs="{accept:'image/*'}"/>
            <div class="photo-file-preview">
                <span class="profile-icon-3"></span>
                <div class="text"  ng-bind="'page.profile.change_photo' | translate"></div>
            </div>
            <img src="/api/getUserPic?notBlured=1&destination={{user.data.image}}" flow-img="$flow.files[$flow.files.length-1]"/>

        </div>
    </div>
    </a><a ng-click="logout()" id="profile-change-link"><span class="profile-icon-2"></span>

        <div class="text" ng-bind="'page.profile.logout' | translate"></div>
    </a>
</div>
<main style="background-image: url("/api/getUserPic?destination={{user.data.image}}");">

    <form id="profile-form" name="AddCatForm" enctype='multipart/form-data'>
        <div class="form-item" ng-class="{active: user.data.contacts.name.length>0}">
            <input type="text" ng-model="user.data.contacts.name" placeholder="{{ 'placeholders.name' | translate }}"/>
        </div>
        <div class="form-item" ng-class="{active: user.data.contacts.surname.length>0}">
            <input type="text" ng-model="user.data.contacts.surname" placeholder="{{ 'placeholders.surname' | translate }}"/>
        </div>
        <div class="form-item" ng-class="{active: user.data.contacts.city.length>0}">
            <input type="text" ng-model="user.data.contacts.city" placeholder="{{ 'placeholders.city' | translate }}"/>
        </div>
        <div class="form-item" ng-class="{active: user.data.email.length>0}">
            <input type="text" ng-model="user.data.email" placeholder="{{ 'placeholders.email' | translate }}" ng-disabled="user.data.social.length == 0" />
        </div>
        <div class="form-item" ng-class="{active: user.data.contacts.phone.length>0}">
            <input type="text" id="phone"  ng-model="user.data.contacts.phone" placeholder="{{ 'placeholders.phone' | translate }}" />
        </div>
        <div class="form-item" ng-class="{active: user.data.contacts.web.length>0}">
            <input type="text" id="web" ng-model="user.data.contacts.web" placeholder="{{ 'placeholders.social_link' | translate }}"/>
        </div>

        <div class="form-item submit" ng-class="{'active':isFull()}">
            <input type="submit" value="{{ 'page.profile.ready' | translate }}" ng-disabled="ProfileForm.$invalid" ng-click="saveUser()"/>
        </div>

    </form>
</main>

<?php echo View::make('popup._popup')->with( array('popupIds'=> array('change_password') ) ) ?>