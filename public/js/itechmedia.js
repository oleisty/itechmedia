class Tweets {
    constructor() {
        this.formUserSearch = '#formUserSearch';
        this.userName = '#formUserName';
        this.userNameBtnLabel = '#userNameBtnLabel';
        this.formValidationInfo = '#formValidationInfo';
        this.tweetsContainer = '#tweetsContainer';
        this.tweeterPreloader = '#tweeterPreloader';
        this.currentFollowingUserNameVariable = 'currentFollowingUser';
    }
    
    clearTweetsList() {
        $(this.formValidationInfo).text('');
        $(this.formValidationInfo).addClass('hidden');
        $(this.tweetsContainer).removeClass('text-danger');
        $(this.tweetsContainer).html('');
    }
    
    initTweets() {
        var currentFollowingUser = this.loadCurrentFollowingUser('currentFollowingUser');
        var initialLoad = true;
        if (this.isUserEmpty(currentFollowingUser) == true) {
            this.loadTweets('', initialLoad);
        } else {
            this.loadTweets(currentFollowingUser);
        }
    }
    
    loadTweets(userName, initialLoad = false) {
        var isUserEmpty = this.isUserEmpty(userName);
        var currentObj = this;
        if (isUserEmpty == true && initialLoad == false) {
            $(this.formValidationInfo).text('The box cannot be empty.');
            $(this.formValidationInfo).removeClass('hidden');
        } else {
            this.clearTweetsList();
            this.startTweeterPreloader();
            $.ajax({
                type: "POST",
                url: '/application/get-user-timeline',
                data: {userName: userName},
                dataType: 'json',
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                   console.log(XMLHttpRequest.responseText);
                },
                success: function(json) {
                    if (json.status == 1) {
                        $(currentObj.tweetsContainer).html(json.message);
                        $(currentObj.userNameBtnLabel).text(json.userName);
                        $(currentObj.formUserSearch).addClass('hidden');
                        currentObj.saveCurrentFollowingUser(json.userName);
                    } else {
                        $(currentObj.tweetsContainer).addClass('text-danger');
                        $(currentObj.tweetsContainer).text(json.message);
                        $(currentObj.userNameBtnLabel).text('NO USER');
                        $(currentObj.formUserSearch).addClass('hidden');
                    }
                    currentObj.stopTweeterPreloader();
                }
            });
        }
    }
    
    getCurrentUserNameValue() {
        return $(this.userName).val();
    }
    
    isUserEmpty(userName) {
        if (userName == null || userName.length == 0 || this.isStringEmpty(userName)) {
            return true;
        } else {
            return false;
        }
    }
    
    isStringEmpty(str) {
        return !str.replace(/\s+/, '').length;
    }
    
    startTweeterPreloader() {
        $(this.tweeterPreloader).removeClass('hidden');
    }
    
    stopTweeterPreloader() {
        $(this.tweeterPreloader).addClass('hidden');
    }
    
    saveCurrentFollowingUser(userName) {
        localStorage.setItem(this.currentFollowingUserNameVariable, userName);
    }
    
    loadCurrentFollowingUser() {
        return localStorage.getItem(this.currentFollowingUserNameVariable);
    }
}

$(document).ready(function ($) {
    var tweets = new Tweets();
    tweets.initTweets();
    
    $('#btnToggleUserSearch').click(function() {
        $("#formUserSearch").toggleClass('hidden');
    });
    
    $('#formUserSearch button').click(function() {
        var currentUserNameVal = tweets.getCurrentUserNameValue();
        tweets.loadTweets(currentUserNameVal);
    });
});