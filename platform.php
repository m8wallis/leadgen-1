<h2>Custom Lead Gen Integration App: SkullCandy to WhatCounts</h2>
<p>Please follow these instructions to subscribe to this custom app. Whichever Facebook Page/Account controls the Lead Gen Form will need to be subscribed to the app for the leads to be added to WhatCounts automatically.</p>
<ol>
  <li>Click "Login with Facebook" button</li>
  <ul>
    <li>If already logged in to Facebook, you will see a list of Facebook Pages/Accounts appear which you control</li>
    <li>If you are not logged in, to you will prompted to do so, then will see that list appear</li>
  </ul>
  <li>Click the Facebook Page / Account that you would like to subcribe this App to</li>
  <li>BOOM! This Facebook App is now subscribed</li>
  <li>Now please ensure that things are setup correctly within WhatCounts, and that the correct List is attached to the correct Facebook Lead Form, and leads will be entered in automatically as users complete the lead form via Facebook</li>
</ol>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1370448819645868',
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

    (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  function subscribeApp(page_id, page_access_token) {
    console.log('Subscribing page to app! ' + page_id);
    alert('Subscribing page to app! ' + page_id);
    FB.api(
      '/' + page_id + '/subscribed_apps',
      'post',
      {access_token: page_access_token},
      function(response) {
      console.log('Successfully subscribed page', response);
    });
  }

  // Only works after `FB.init` is called
  function myFacebookLogin() {
    FB.login(function(response){
      console.log('Successfully logged in', response);
      FB.api('/me/accounts', function(response) {
        console.log('Successfully retrieved pages', response);
        var pages = response.data;
        var ul = document.getElementById('list');
        for (var i = 0, len = pages.length; i < len; i++) {
          var page = pages[i];
          var li = document.createElement('li');
          var a = document.createElement('a');
          a.href = "#";
          a.onclick = subscribeApp.bind(this, page.id, page.access_token);
          a.innerHTML = page.name;
          li.appendChild(a);
          ul.appendChild(li);
        }
      });
    }, {scope: 'manage_pages'});
  }
</script>
<button onclick="myFacebookLogin()">Login with Facebook</button>
<ul id="list"></ul>
