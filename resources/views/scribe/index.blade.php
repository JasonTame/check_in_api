<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>CheckIn Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var baseUrl = "http://checkin.test";
        var useCsrf = Boolean(1);
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("vendor/scribe/js/tryitout-3.20.0.js") }}"></script>

    <script src="{{ asset("vendor/scribe/js/theme-default-3.20.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="navbar-image" />
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                                                                            <ul id="tocify-header-0" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="introduction">
                        <a href="#introduction">Introduction</a>
                    </li>
                                            
                                                                    </ul>
                                                <ul id="tocify-header-1" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="authenticating-requests">
                        <a href="#authenticating-requests">Authenticating requests</a>
                    </li>
                                            
                                                </ul>
                    
                    <ul id="tocify-header-2" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-create-account">
                        <a href="#authentication-POSTapi-create-account">Create account</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-login">
                        <a href="#authentication-POSTapi-login">Login</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="authentication-GETapi-profile">
                        <a href="#authentication-GETapi-profile">Get profile data</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-logout">
                        <a href="#authentication-POSTapi-logout">Logout</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-3" class="tocify-header">
                <li class="tocify-item level-1" data-unique="checkin">
                    <a href="#checkin">CheckIn</a>
                </li>
                                    <ul id="tocify-subheader-checkin" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="checkin-GETapi-checkins">
                        <a href="#checkin-GETapi-checkins">View all CheckIns</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="checkin-DELETEapi-checkins--checkIn-">
                        <a href="#checkin-DELETEapi-checkins--checkIn-">Delete CheckIn</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="checkin-GETapi-checkins--checkIn-">
                        <a href="#checkin-GETapi-checkins--checkIn-">View CheckIn</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="checkin-POSTapi-checkins-create">
                        <a href="#checkin-POSTapi-checkins-create">Create CheckIn</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="checkin-PUTapi-checkins--checkIn-">
                        <a href="#checkin-PUTapi-checkins--checkIn-">Update a Check In</a>
                    </li>
                                                    </ul>
                            </ul>
        
                        
            </div>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                            <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
                    </ul>
        <ul class="toc-footer" id="last-updated">
        <li>Last updated: January 9 2022</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://checkin.test</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>Authenticate requests to this API's endpoints by sending an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can get a token for testing purposes by using the create account API call and copying the token, or by running php artisan generate:token.</p>

        <h1 id="authentication">Authentication</h1>

    

            <h2 id="authentication-POSTapi-create-account">Create account</h2>

<p>
</p>

<p>Allows you to add a new user account</p>

<span id="example-requests-POSTapi-create-account">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://checkin.test/api/create-account" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Nathen Friesen\",
    \"email\": \"abel.heller@example.org\",
    \"password\": \"password\",
    \"password_confirmation\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://checkin.test/api/create-account"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Nathen Friesen",
    "email": "abel.heller@example.org",
    "password": "password",
    "password_confirmation": "password"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-create-account">
</span>
<span id="execution-results-POSTapi-create-account" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-create-account"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-create-account"></code></pre>
</span>
<span id="execution-error-POSTapi-create-account" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-create-account"></code></pre>
</span>
<form id="form-POSTapi-create-account" data-method="POST"
      data-path="api/create-account"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-create-account', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-create-account"
                    onclick="tryItOut('POSTapi-create-account');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-create-account"
                    onclick="cancelTryOut('POSTapi-create-account');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-create-account" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/create-account</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-create-account"
               value="Nathen Friesen"
               data-component="body" hidden>
    <br>
<p>The name of the user.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>email</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTapi-create-account"
               value="abel.heller@example.org"
               data-component="body" hidden>
    <br>
<p>The email address of the user.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTapi-create-account"
               value="password"
               data-component="body" hidden>
    <br>
<p>The user's password.</p>
        </p>
                <p>
            <b><code>password_confirmation</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="password_confirmation"
               data-endpoint="POSTapi-create-account"
               value="password"
               data-component="body" hidden>
    <br>
<p>Add the password again as confirmation.</p>
        </p>
        </form>

            <h2 id="authentication-POSTapi-login">Login</h2>

<p>
</p>

<p>Authenticate and login</p>

<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://checkin.test/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"abel.heller@example.org\",
    \"password\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://checkin.test/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "abel.heller@example.org",
    "password": "password"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
</span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login"></code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>email</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTapi-login"
               value="abel.heller@example.org"
               data-component="body" hidden>
    <br>
<p>The user's email address.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTapi-login"
               value="password"
               data-component="body" hidden>
    <br>
<p>The user's password.</p>
        </p>
        </form>

            <h2 id="authentication-GETapi-profile">Get profile data</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get the user's profile data</p>

<span id="example-requests-GETapi-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://checkin.test/api/profile" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://checkin.test/api/profile"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-profile">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-profile"></code></pre>
</span>
<span id="execution-error-GETapi-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-profile"></code></pre>
</span>
<form id="form-GETapi-profile" data-method="GET"
      data-path="api/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-profile"
                    onclick="tryItOut('GETapi-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-profile"
                    onclick="cancelTryOut('GETapi-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-profile" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/profile</code></b>
        </p>
                <p>
            <label id="auth-GETapi-profile" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-profile"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="authentication-POSTapi-logout">Logout</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Revokes the user's API token</p>

<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://checkin.test/api/logout" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://checkin.test/api/logout"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
</span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout"></code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-logout" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-logout"
                                                                data-component="header"></label>
        </p>
                </form>

        <h1 id="checkin">CheckIn</h1>

    

            <h2 id="checkin-GETapi-checkins">View all CheckIns</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns a list of all CheckIns that belong to the user</p>

<span id="example-requests-GETapi-checkins">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://checkin.test/api/checkins" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://checkin.test/api/checkins"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-checkins">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-checkins" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-checkins"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-checkins"></code></pre>
</span>
<span id="execution-error-GETapi-checkins" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-checkins"></code></pre>
</span>
<form id="form-GETapi-checkins" data-method="GET"
      data-path="api/checkins"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-checkins', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-checkins"
                    onclick="tryItOut('GETapi-checkins');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-checkins"
                    onclick="cancelTryOut('GETapi-checkins');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-checkins" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/checkins</code></b>
        </p>
                <p>
            <label id="auth-GETapi-checkins" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-checkins"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="checkin-DELETEapi-checkins--checkIn-">Delete CheckIn</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Deletes a CheckIn belonging to the user</p>

<span id="example-requests-DELETEapi-checkins--checkIn-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://checkin.test/api/checkins/3" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://checkin.test/api/checkins/3"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-checkins--checkIn-">
</span>
<span id="execution-results-DELETEapi-checkins--checkIn-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-checkins--checkIn-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-checkins--checkIn-"></code></pre>
</span>
<span id="execution-error-DELETEapi-checkins--checkIn-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-checkins--checkIn-"></code></pre>
</span>
<form id="form-DELETEapi-checkins--checkIn-" data-method="DELETE"
      data-path="api/checkins/{checkIn}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-checkins--checkIn-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-checkins--checkIn-"
                    onclick="tryItOut('DELETEapi-checkins--checkIn-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-checkins--checkIn-"
                    onclick="cancelTryOut('DELETEapi-checkins--checkIn-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-checkins--checkIn-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/checkins/{checkIn}</code></b>
        </p>
                <p>
            <label id="auth-DELETEapi-checkins--checkIn-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEapi-checkins--checkIn-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>checkIn</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="checkIn"
               data-endpoint="DELETEapi-checkins--checkIn-"
               value="3"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="checkin-GETapi-checkins--checkIn-">View CheckIn</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>View the details for a CheckIn</p>

<span id="example-requests-GETapi-checkins--checkIn-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://checkin.test/api/checkins/13" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://checkin.test/api/checkins/13"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-checkins--checkIn-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-checkins--checkIn-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-checkins--checkIn-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-checkins--checkIn-"></code></pre>
</span>
<span id="execution-error-GETapi-checkins--checkIn-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-checkins--checkIn-"></code></pre>
</span>
<form id="form-GETapi-checkins--checkIn-" data-method="GET"
      data-path="api/checkins/{checkIn}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-checkins--checkIn-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-checkins--checkIn-"
                    onclick="tryItOut('GETapi-checkins--checkIn-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-checkins--checkIn-"
                    onclick="cancelTryOut('GETapi-checkins--checkIn-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-checkins--checkIn-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/checkins/{checkIn}</code></b>
        </p>
                <p>
            <label id="auth-GETapi-checkins--checkIn-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-checkins--checkIn-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>checkIn</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="checkIn"
               data-endpoint="GETapi-checkins--checkIn-"
               value="13"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="checkin-POSTapi-checkins-create">Create CheckIn</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Creates a new CheckIn</p>

<span id="example-requests-POSTapi-checkins-create">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://checkin.test/api/checkins/create" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"ayfdsbufgbzmdikihewehgxtsdmkxxatssprtakebxzadjgxpfyegtjehyglvyvebbovjqoccncxi\",
    \"user_id\": 4,
    \"interval\": \"monthly\",
    \"birthday\": \"2022-01-09T12:58:02\",
    \"notes\": \"umoyoroycfefelabgsqftdchpltvcsubfyxeqffmgisjcnhkflcdpfxnmpkqedbfnouhcuexpiiumcjxfperoitlqegpwpzwjcloivoqaxlpziuepcklzwghuboouuexvlgfhtnzwtrxdialdglgkbsxtndjvokrbatcohccdeayrnqphyjonaqdlkwpdbemzuphtmdzjnfnubgurdulbplhojszxnluuijpwdpeninfmmmlhoskverunisiisvdgbiqdpxdkbqtdqnrvlwbwrcyagewoskthhwqrzpygopmimybjgnishlhidjzdzzxcnuuhwkmthcacxgjwazgvhyzubqzejqtyvmhawfrhhuhugmxxsugrjjomknmiicriofiefmvszzvocaenwonpmocqcucuohgyadmprodbshnwptlrsjmeqlasymcsanwoxqoueolsysuscgljplslqxfepwsbvaihrkjcvcljsojzul\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://checkin.test/api/checkins/create"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "ayfdsbufgbzmdikihewehgxtsdmkxxatssprtakebxzadjgxpfyegtjehyglvyvebbovjqoccncxi",
    "user_id": 4,
    "interval": "monthly",
    "birthday": "2022-01-09T12:58:02",
    "notes": "umoyoroycfefelabgsqftdchpltvcsubfyxeqffmgisjcnhkflcdpfxnmpkqedbfnouhcuexpiiumcjxfperoitlqegpwpzwjcloivoqaxlpziuepcklzwghuboouuexvlgfhtnzwtrxdialdglgkbsxtndjvokrbatcohccdeayrnqphyjonaqdlkwpdbemzuphtmdzjnfnubgurdulbplhojszxnluuijpwdpeninfmmmlhoskverunisiisvdgbiqdpxdkbqtdqnrvlwbwrcyagewoskthhwqrzpygopmimybjgnishlhidjzdzzxcnuuhwkmthcacxgjwazgvhyzubqzejqtyvmhawfrhhuhugmxxsugrjjomknmiicriofiefmvszzvocaenwonpmocqcucuohgyadmprodbshnwptlrsjmeqlasymcsanwoxqoueolsysuscgljplslqxfepwsbvaihrkjcvcljsojzul"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkins-create">
</span>
<span id="execution-results-POSTapi-checkins-create" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-checkins-create"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-checkins-create"></code></pre>
</span>
<span id="execution-error-POSTapi-checkins-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-checkins-create"></code></pre>
</span>
<form id="form-POSTapi-checkins-create" data-method="POST"
      data-path="api/checkins/create"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-checkins-create', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-checkins-create"
                    onclick="tryItOut('POSTapi-checkins-create');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-checkins-create"
                    onclick="cancelTryOut('POSTapi-checkins-create');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-checkins-create" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/checkins/create</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-checkins-create" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-checkins-create"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-checkins-create"
               value="ayfdsbufgbzmdikihewehgxtsdmkxxatssprtakebxzadjgxpfyegtjehyglvyvebbovjqoccncxi"
               data-component="body" hidden>
    <br>
<p>Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="user_id"
               data-endpoint="POSTapi-checkins-create"
               value="4"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>interval</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="interval"
               data-endpoint="POSTapi-checkins-create"
               value="monthly"
               data-component="body" hidden>
    <br>
<p>Must be one of <code>weekly</code>, <code>bi-weekly</code>, <code>monthly</code>, <code>semi-annually</code>, or <code>annually</code>.</p>
        </p>
                <p>
            <b><code>birthday</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="birthday"
               data-endpoint="POSTapi-checkins-create"
               value="2022-01-09T12:58:02"
               data-component="body" hidden>
    <br>
<p>Must be a valid date.</p>
        </p>
                <p>
            <b><code>notes</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="notes"
               data-endpoint="POSTapi-checkins-create"
               value="umoyoroycfefelabgsqftdchpltvcsubfyxeqffmgisjcnhkflcdpfxnmpkqedbfnouhcuexpiiumcjxfperoitlqegpwpzwjcloivoqaxlpziuepcklzwghuboouuexvlgfhtnzwtrxdialdglgkbsxtndjvokrbatcohccdeayrnqphyjonaqdlkwpdbemzuphtmdzjnfnubgurdulbplhojszxnluuijpwdpeninfmmmlhoskverunisiisvdgbiqdpxdkbqtdqnrvlwbwrcyagewoskthhwqrzpygopmimybjgnishlhidjzdzzxcnuuhwkmthcacxgjwazgvhyzubqzejqtyvmhawfrhhuhugmxxsugrjjomknmiicriofiefmvszzvocaenwonpmocqcucuohgyadmprodbshnwptlrsjmeqlasymcsanwoxqoueolsysuscgljplslqxfepwsbvaihrkjcvcljsojzul"
               data-component="body" hidden>
    <br>
<p>Must not be greater than 500 characters.</p>
        </p>
        </form>

            <h2 id="checkin-PUTapi-checkins--checkIn-">Update a Check In</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update the details of a CheckIn belonging to the authenticated user</p>

<span id="example-requests-PUTapi-checkins--checkIn-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://checkin.test/api/checkins/6" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"ddmjbwdumvfhglmouosranutw\",
    \"interval\": \"weekly\",
    \"birthday\": \"2022-01-09T12:58:02\",
    \"notes\": \"aiyvirwkmutcgtwfmmgmhmzmkozsevjuvkfsbqnxtetguzehdcoksapbmjdimxrqlmmuiblavydozqjedwikfaikgxntgzbjjffikyvyqbnrggittmjwckbxhoyuehyxrarqoazdwafuarsjtqusywopbtznfcnrhrihghlfboxedulagnsjauxmzgpqpuptjyighbbmcfxhhgrxfhkuuzrmznvedqxzttejkextqjioygwrrrpyrfhtuqqjfgfmwjrxanvrqnkbcuszcxqyojfcvaitpeucwyoqcusnivorpxmyvtpuaydggwdywcjdxtkfxzbdbersmhmrdvakgwddvxrctzeetaprdhkranlmwgqohmjcgirhdjqgzejowgotrbotolcwmoapkvodftxvxtsoslioldztptkoxvmyfbeahlvgedwvezuprsmwsjoonwpbaqggtdwzcuctdjhmwcqyvxd\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://checkin.test/api/checkins/6"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "ddmjbwdumvfhglmouosranutw",
    "interval": "weekly",
    "birthday": "2022-01-09T12:58:02",
    "notes": "aiyvirwkmutcgtwfmmgmhmzmkozsevjuvkfsbqnxtetguzehdcoksapbmjdimxrqlmmuiblavydozqjedwikfaikgxntgzbjjffikyvyqbnrggittmjwckbxhoyuehyxrarqoazdwafuarsjtqusywopbtznfcnrhrihghlfboxedulagnsjauxmzgpqpuptjyighbbmcfxhhgrxfhkuuzrmznvedqxzttejkextqjioygwrrrpyrfhtuqqjfgfmwjrxanvrqnkbcuszcxqyojfcvaitpeucwyoqcusnivorpxmyvtpuaydggwdywcjdxtkfxzbdbersmhmrdvakgwddvxrctzeetaprdhkranlmwgqohmjcgirhdjqgzejowgotrbotolcwmoapkvodftxvxtsoslioldztptkoxvmyfbeahlvgedwvezuprsmwsjoonwpbaqggtdwzcuctdjhmwcqyvxd"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-checkins--checkIn-">
</span>
<span id="execution-results-PUTapi-checkins--checkIn-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-checkins--checkIn-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-checkins--checkIn-"></code></pre>
</span>
<span id="execution-error-PUTapi-checkins--checkIn-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-checkins--checkIn-"></code></pre>
</span>
<form id="form-PUTapi-checkins--checkIn-" data-method="PUT"
      data-path="api/checkins/{checkIn}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-checkins--checkIn-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-checkins--checkIn-"
                    onclick="tryItOut('PUTapi-checkins--checkIn-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-checkins--checkIn-"
                    onclick="cancelTryOut('PUTapi-checkins--checkIn-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-checkins--checkIn-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/checkins/{checkIn}</code></b>
        </p>
                <p>
            <label id="auth-PUTapi-checkins--checkIn-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTapi-checkins--checkIn-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>checkIn</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="checkIn"
               data-endpoint="PUTapi-checkins--checkIn-"
               value="6"
               data-component="url" hidden>
    <br>

            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PUTapi-checkins--checkIn-"
               value="ddmjbwdumvfhglmouosranutw"
               data-component="body" hidden>
    <br>
<p>Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>interval</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="interval"
               data-endpoint="PUTapi-checkins--checkIn-"
               value="weekly"
               data-component="body" hidden>
    <br>
<p>Must be one of <code>weekly</code>, <code>bi-weekly</code>, <code>monthly</code>, <code>semi-annually</code>, or <code>annually</code>.</p>
        </p>
                <p>
            <b><code>birthday</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="birthday"
               data-endpoint="PUTapi-checkins--checkIn-"
               value="2022-01-09T12:58:02"
               data-component="body" hidden>
    <br>
<p>Must be a valid date.</p>
        </p>
                <p>
            <b><code>notes</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="notes"
               data-endpoint="PUTapi-checkins--checkIn-"
               value="aiyvirwkmutcgtwfmmgmhmzmkozsevjuvkfsbqnxtetguzehdcoksapbmjdimxrqlmmuiblavydozqjedwikfaikgxntgzbjjffikyvyqbnrggittmjwckbxhoyuehyxrarqoazdwafuarsjtqusywopbtznfcnrhrihghlfboxedulagnsjauxmzgpqpuptjyighbbmcfxhhgrxfhkuuzrmznvedqxzttejkextqjioygwrrrpyrfhtuqqjfgfmwjrxanvrqnkbcuszcxqyojfcvaitpeucwyoqcusnivorpxmyvtpuaydggwdywcjdxtkfxzbdbersmhmrdvakgwddvxrctzeetaprdhkranlmwgqohmjcgirhdjqgzejowgotrbotolcwmoapkvodftxvxtsoslioldztptkoxvmyfbeahlvgedwvezuprsmwsjoonwpbaqggtdwzcuctdjhmwcqyvxd"
               data-component="body" hidden>
    <br>
<p>Must not be greater than 500 characters.</p>
        </p>
        </form>

    

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
