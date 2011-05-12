
    

  

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
        <title>application/sql/houseshare_db_EER_v05.sql at master from marcinwol/houseshare - GitHub</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub" />
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub" />

    <link href="https://d3nwyuy0nl342s.cloudfront.net/09f14d3d0b60dba27047db8e5d4b9126e733f7c5/stylesheets/bundle_github.css" media="screen" rel="stylesheet" type="text/css" />
    

    <script type="text/javascript">
      if (typeof console == "undefined" || typeof console.log == "undefined")
        console = { log: function() {} }
    </script>
    <script type="text/javascript" charset="utf-8">
      var GitHub = {
        assetHost: 'https://d3nwyuy0nl342s.cloudfront.net'
      }
      var github_user = 'marcinwol'
      
    </script>
    <script src="https://d3nwyuy0nl342s.cloudfront.net/09f14d3d0b60dba27047db8e5d4b9126e733f7c5/javascripts/jquery/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="https://d3nwyuy0nl342s.cloudfront.net/09f14d3d0b60dba27047db8e5d4b9126e733f7c5/javascripts/bundle_common.js" type="text/javascript"></script>
<script src="https://d3nwyuy0nl342s.cloudfront.net/09f14d3d0b60dba27047db8e5d4b9126e733f7c5/javascripts/bundle_github.js" type="text/javascript"></script>


    
    <script type="text/javascript" charset="utf-8">
      GitHub.spy({
        repo: "marcinwol/houseshare"
      })
    </script>

    
  <link rel='canonical' href='/marcinwol/houseshare/blob/63222ed9ed6a15edac58130a60d0bc253ad5bdf2/application/sql/houseshare_db_EER_v05.sql'>

  <link href="https://github.com/marcinwol/houseshare/commits/master.atom" rel="alternate" title="Recent Commits to houseshare:master" type="application/atom+xml" />

        <meta name="description" content="houseshare - Looking for a share mate?" />
    <script type="text/javascript">
      GitHub.nameWithOwner = GitHub.nameWithOwner || "marcinwol/houseshare";
      GitHub.currentRef = 'master';
      GitHub.commitSHA = "63222ed9ed6a15edac58130a60d0bc253ad5bdf2";
      GitHub.currentPath = 'application/sql/houseshare_db_EER_v05.sql';
      GitHub.masterBranch = "master";

      
    </script>
  

        <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-3769691-2']);
      _gaq.push(['_setDomainName', 'none']);
      _gaq.push(['_trackPageview']);
      _gaq.push(['_trackPageLoadTime']);
      (function() {
        var ga = document.createElement('script');
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        ga.setAttribute('async', 'true');
        document.documentElement.firstChild.appendChild(ga);
      })();
    </script>

    
  </head>

  

  <body class="logged_in page-blob  linux env-production">
    

    

    

    

    

    

    <div class="subnavd" id="main">
      <div id="header" class="true">
        
          <a class="logo boring" href="https://github.com/">
            <img alt="github" class="default" src="https://d3nwyuy0nl342s.cloudfront.net/images/modules/header/logov3.png" />
            <!--[if (gt IE 8)|!(IE)]><!-->
            <img alt="github" class="hover" src="https://d3nwyuy0nl342s.cloudfront.net/images/modules/header/logov3-hover.png" />
            <!--<![endif]-->
          </a>
        
        
          





  
    <div class="userbox">
      <div class="avatarname">
        <a href="https://github.com/marcinwol"><img src="https://secure.gravatar.com/avatar/6605deca5924e84df1a4847f607b87c6?s=140&d=https://d3nwyuy0nl342s.cloudfront.net%2Fimages%2Fgravatars%2Fgravatar-140.png" alt="" width="20" height="20"  /></a>
        <a href="https://github.com/marcinwol" class="name">marcinwol</a>

        
        
      </div>
      <ul class="usernav">
        <li><a href="https://github.com/">Dashboard</a></li>
        <li>
          
          <a href="https://github.com/inbox">Inbox</a>
          <a href="https://github.com/inbox" class="unread_count ">0</a>
        </li>
        <li><a href="https://github.com/account">Account Settings</a></li>
                <li><a href="/logout">Log Out</a></li>
      </ul>
    </div><!-- /.userbox -->
  


        
        <div class="topsearch">
  
    <form action="/search" id="top_search_form" method="get">
      <a href="/search" class="advanced-search tooltipped downwards" title="Advanced Search">Advanced Search</a>
      <input type="search" class="search my_repos_autocompleter" name="q" results="5" placeholder="Search&hellip;" /> <input type="submit" value="Search" class="button" />
      <input type="hidden" name="type" value="Everything" />
      <input type="hidden" name="repo" value="" />
      <input type="hidden" name="langOverride" value="" />
      <input type="hidden" name="start_value" value="1" />
    </form>
    <ul class="nav">
      <li><a href="/explore">Explore GitHub</a></li>
      <li><a href="https://gist.github.com">Gist</a></li>
      <li><a href="/blog">Blog</a></li>
      <li><a href="http://help.github.com">Help</a></li>
    </ul>
  
</div>

      </div>

      
      
        
    <div class="site">
      <div class="pagehead repohead vis-public    instapaper_ignore readability-menu">

      

      <div class="title-actions-bar">
        <h1>
          <a href="/marcinwol">marcinwol</a> / <strong><a href="/marcinwol/houseshare">houseshare</a></strong>
          
          
        </h1>

        
    <ul class="actions">
      

      
        <li class="for-owner" style="display:none"><a href="/marcinwol/houseshare/admin" class="minibutton btn-admin "><span><span class="icon"></span>Admin</span></a></li>
        <li>
          <a href="/marcinwol/houseshare/toggle_watch" class="minibutton btn-watch " id="watch_button" onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var s = document.createElement('input'); s.setAttribute('type', 'hidden'); s.setAttribute('name', 'authenticity_token'); s.setAttribute('value', '7f9ca641aaa2cf13a7744fc1a683d9d75decb6e7'); f.appendChild(s);f.submit();return false;" style="display:none"><span><span class="icon"></span>Watch</span></a>
          <a href="/marcinwol/houseshare/toggle_watch" class="minibutton btn-watch " id="unwatch_button" onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var s = document.createElement('input'); s.setAttribute('type', 'hidden'); s.setAttribute('name', 'authenticity_token'); s.setAttribute('value', '7f9ca641aaa2cf13a7744fc1a683d9d75decb6e7'); f.appendChild(s);f.submit();return false;" style="display:none"><span><span class="icon"></span>Unwatch</span></a>
        </li>
        
          
            <li class="for-notforked" style="display:none"><a href="/marcinwol/houseshare/fork" class="minibutton btn-fork " id="fork_button" onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var s = document.createElement('input'); s.setAttribute('type', 'hidden'); s.setAttribute('name', 'authenticity_token'); s.setAttribute('value', '7f9ca641aaa2cf13a7744fc1a683d9d75decb6e7'); f.appendChild(s);f.submit();return false;"><span><span class="icon"></span>Fork</span></a></li>
            <li class="for-hasfork" style="display:none"><a href="#" class="minibutton btn-fork " id="your_fork_button"><span><span class="icon"></span>Your Fork</span></a></li>
          

          <li id='pull_request_item' class='nspr' style='display:none'><a href="/marcinwol/houseshare/pull/new/master" class="minibutton btn-pull-request "><span><span class="icon"></span>Pull Request</span></a></li>
          
        
      
      
      <li class="repostats">
        <ul class="repo-stats">
          <li class="watchers"><a href="/marcinwol/houseshare/watchers" title="Watchers" class="tooltipped downwards">2</a></li>
          <li class="forks"><a href="/marcinwol/houseshare/network" title="Forks" class="tooltipped downwards">1</a></li>
        </ul>
      </li>
    </ul>

      </div>

        
  <ul class="tabs">
    <li><a href="/marcinwol/houseshare" class="selected" highlight="repo_source">Source</a></li>
    <li><a href="/marcinwol/houseshare/commits/master" highlight="repo_commits">Commits</a></li>
    <li><a href="/marcinwol/houseshare/network" highlight="repo_network">Network</a></li>
    <li><a href="/marcinwol/houseshare/pulls" highlight="repo_pulls">Pull Requests (0)</a></li>

    
      <li><a href="/marcinwol/houseshare/forkqueue" highlight="repo_fork_queue">Fork Queue</a></li>
    

    
      
      <li><a href="/marcinwol/houseshare/issues" highlight="issues">Issues (7)</a></li>
    

                <li><a href="/marcinwol/houseshare/wiki" highlight="repo_wiki">Wiki (0)</a></li>
        
    <li><a href="/marcinwol/houseshare/graphs" highlight="repo_graphs">Graphs</a></li>

    <li class="contextswitch nochoices">
      <span class="toggle leftwards" >
        <em>Branch:</em>
        <code>master</code>
      </span>
    </li>
  </ul>

  <div style="display:none" id="pl-description"><p><em class="placeholder">click here to add a description</em></p></div>
  <div style="display:none" id="pl-homepage"><p><em class="placeholder">click here to add a homepage</em></p></div>

  <div class="subnav-bar">
  
  <ul>
    <li>
      
      <a href="/marcinwol/houseshare/branches" class="dropdown">Switch Branches (3)</a>
      <ul>
        
          
          
            <li><a href="/marcinwol/houseshare/blob/appartments/application/sql/houseshare_db_EER_v05.sql" action="show">appartments</a></li>
          
        
          
            <li><strong>master &#x2713;</strong></li>
            
          
          
            <li><a href="/marcinwol/houseshare/blob/new-layout/application/sql/houseshare_db_EER_v05.sql" action="show">new-layout</a></li>
          
        
      </ul>
    </li>
    <li>
      <a href="#" class="dropdown defunct">Switch Tags (0)</a>
      
    </li>
    <li>
    
    <a href="/marcinwol/houseshare/branches" class="manage">Branch List</a>
    
    </li>
  </ul>
</div>

  
  
  
  
  
  



        
    <div id="repo_details" class="metabox clearfix">
      <div id="repo_details_loader" class="metabox-loader" style="display:none">Sending Request&hellip;</div>

        <a href="/marcinwol/houseshare/downloads" class="download-source" id="download_button" title="Download source, tagged packages and binaries."><span class="icon"></span>Downloads</a>

      <div id="repository_desc_wrapper">
      <div id="repository_description" rel="repository_description_edit">
        
          <p>Looking for a share mate?
            <span id="read_more" style="display:none">&mdash; <a href="#readme">Read more</a></span>
          </p>
        
      </div>

      <div id="repository_description_edit" style="display:none;" class="inline-edit">
        <form action="/marcinwol/houseshare/admin/update" method="post"><div style="margin:0;padding:0"><input name="authenticity_token" type="hidden" value="7f9ca641aaa2cf13a7744fc1a683d9d75decb6e7" /></div>
          <input type="hidden" name="field" value="repository_description">
          <input type="text" class="textfield" name="value" value="Looking for a share mate?">
          <div class="form-actions">
            <button class="minibutton"><span>Save</span></button> &nbsp; <a href="#" class="cancel">Cancel</a>
          </div>
        </form>
      </div>

      
      <div class="repository-homepage" id="repository_homepage" rel="repository_homepage_edit">
        <p><a href="http://" rel="nofollow"></a></p>
      </div>

      <div id="repository_homepage_edit" style="display:none;" class="inline-edit">
        <form action="/marcinwol/houseshare/admin/update" method="post"><div style="margin:0;padding:0"><input name="authenticity_token" type="hidden" value="7f9ca641aaa2cf13a7744fc1a683d9d75decb6e7" /></div>
          <input type="hidden" name="field" value="repository_homepage">
          <input type="text" class="textfield" name="value" value="">
          <div class="form-actions">
            <button class="minibutton"><span>Save</span></button> &nbsp; <a href="#" class="cancel">Cancel</a>
          </div>
        </form>
      </div>
      </div>
      <div class="rule "></div>
            <div id="url_box" class="url-box">
        <ul class="clone-urls">
          
            
              <li id="private_clone_url"><a href="git@github.com:marcinwol/houseshare.git" data-permissions="Read+Write">SSH</a></li>
            
            <li id="http_clone_url"><a href="https://marcinwol@github.com/marcinwol/houseshare.git" data-permissions="Read+Write">HTTP</a></li>
            <li id="public_clone_url"><a href="git://github.com/marcinwol/houseshare.git" data-permissions="Read-Only">Git Read-Only</a></li>
          
          
        </ul>
        <input type="text" spellcheck="false" id="url_field" class="url-field" />
              <span style="display:none" id="url_box_clippy"></span>
      <span id="clippy_tooltip_url_box_clippy" class="clippy-tooltip tooltipped" title="copy to clipboard">
      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
              width="14"
              height="14"
              class="clippy"
              id="clippy" >
      <param name="movie" value="https://d3nwyuy0nl342s.cloudfront.net/flash/clippy.swf?v5"/>
      <param name="allowScriptAccess" value="always" />
      <param name="quality" value="high" />
      <param name="scale" value="noscale" />
      <param NAME="FlashVars" value="id=url_box_clippy&amp;copied=&amp;copyto=">
      <param name="bgcolor" value="#FFFFFF">
      <param name="wmode" value="opaque">
      <embed src="https://d3nwyuy0nl342s.cloudfront.net/flash/clippy.swf?v5"
             width="14"
             height="14"
             name="clippy"
             quality="high"
             allowScriptAccess="always"
             type="application/x-shockwave-flash"
             pluginspage="http://www.macromedia.com/go/getflashplayer"
             FlashVars="id=url_box_clippy&amp;copied=&amp;copyto="
             bgcolor="#FFFFFF"
             wmode="opaque"
      />
      </object>
      </span>

        <p id="url_description">This URL has <strong>Read+Write</strong> access</p>
      </div>
    </div>

    <div class="frame frame-center tree-finder" style="display:none">
      <div class="breadcrumb">
        <b><a href="/marcinwol/houseshare">houseshare</a></b> /
        <input class="tree-finder-input" type="text" name="query" autocomplete="off" spellcheck="false">
      </div>

      
        <div class="octotip">
          <p>
            <a href="/marcinwol/houseshare/dismiss-tree-finder-help" class="dismiss js-dismiss-tree-list-help" title="Hide this notice forever">Dismiss</a>
            <strong>Octotip:</strong> You've activated the <em>file finder</em> by pressing <span class="kbd">t</span>
            Start typing to filter the file list. Use <span class="kbd badmono">↑</span> and <span class="kbd badmono">↓</span> to navigate,
            <span class="kbd">enter</span> to view files.
          </p>
        </div>
      

      <table class="tree-browser" cellpadding="0" cellspacing="0">
        <tr class="js-header"><th>&nbsp;</th><th>name</th></tr>
        <tr class="js-no-results no-results" style="display: none">
          <th colspan="2">No matching files</th>
        </tr>
        <tbody class="js-results-list">
        </tbody>
      </table>
    </div>

    <div id="jump-to-line" style="display:none">
      <h2>Jump to Line</h2>
      <form>
        <input class="textfield" type="text">
        <div class="full-button">
          <button type="submit" class="classy">
            <span>Go</span>
          </button>
        </div>
      </form>
    </div>


        

      </div><!-- /.pagehead -->

      

  







<script type="text/javascript">
  GitHub.downloadRepo = '/marcinwol/houseshare/archives/master'
  GitHub.revType = "master"

  GitHub.repoName = "houseshare"
  GitHub.controllerName = "blob"
  GitHub.actionName     = "show"
  GitHub.currentAction  = "blob#show"

  
    GitHub.loggedIn = true
    GitHub.hasWriteAccess = true
    GitHub.hasAdminAccess = true
    GitHub.watchingRepo = true
    GitHub.ignoredRepo = false
    GitHub.hasForkOfRepo = null
    GitHub.hasForked = true
  

  
</script>






<div class="flash-messages"></div>


  <div id="commit">
    <div class="group">
        
  <div class="envelope commit">
    <div class="human">
      
        <div class="message"><pre><a href="/marcinwol/houseshare/commit/63222ed9ed6a15edac58130a60d0bc253ad5bdf2">Maximum limitList price changed from 2000 to 3000.</a> </pre></div>
      

      <div class="actor">
        <div class="gravatar">
          
          <img src="https://secure.gravatar.com/avatar/8435cdf0c1d11aedcfde36cbfdc690c1?s=140&d=https://d3nwyuy0nl342s.cloudfront.net%2Fimages%2Fgravatars%2Fgravatar-140.png" alt="" width="30" height="30"  />
        </div>
        <div class="name">marcin <span>(author)</span></div>
        <div class="date">
          <abbr class="relatize" title="2011-05-08 02:52:48">Sun May 08 02:52:48 -0700 2011</abbr>
        </div>
      </div>

      

    </div>
    <div class="machine">
      <span>c</span>ommit&nbsp;&nbsp;<a href="/marcinwol/houseshare/commit/63222ed9ed6a15edac58130a60d0bc253ad5bdf2" hotkey="c">63222ed9ed6a15edac58</a><br />
      <span>t</span>ree&nbsp;&nbsp;&nbsp;&nbsp;<a href="/marcinwol/houseshare/tree/63222ed9ed6a15edac58130a60d0bc253ad5bdf2" hotkey="t">ec3f69ffa9f45b5d8f52</a><br />
      
        <span>p</span>arent&nbsp;
        
        <a href="/marcinwol/houseshare/tree/1f83018493f55606c062861382c6e929147a1610" hotkey="p">1f83018493f55606c062</a>
      

    </div>
  </div>

    </div>
  </div>



  <div id="slider">

  

    <div class="breadcrumb" data-path="application/sql/houseshare_db_EER_v05.sql/">
      <b><a href="/marcinwol/houseshare/tree/63222ed9ed6a15edac58130a60d0bc253ad5bdf2">houseshare</a></b> / <a href="/marcinwol/houseshare/tree/63222ed9ed6a15edac58130a60d0bc253ad5bdf2/application">application</a> / <a href="/marcinwol/houseshare/tree/63222ed9ed6a15edac58130a60d0bc253ad5bdf2/application/sql">sql</a> / houseshare_db_EER_v05.sql       <span style="display:none" id="clippy_1652">application/sql/houseshare_db_EER_v05.sql</span>
      
      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
              width="110"
              height="14"
              class="clippy"
              id="clippy" >
      <param name="movie" value="https://d3nwyuy0nl342s.cloudfront.net/flash/clippy.swf?v5"/>
      <param name="allowScriptAccess" value="always" />
      <param name="quality" value="high" />
      <param name="scale" value="noscale" />
      <param NAME="FlashVars" value="id=clippy_1652&amp;copied=copied!&amp;copyto=copy to clipboard">
      <param name="bgcolor" value="#FFFFFF">
      <param name="wmode" value="opaque">
      <embed src="https://d3nwyuy0nl342s.cloudfront.net/flash/clippy.swf?v5"
             width="110"
             height="14"
             name="clippy"
             quality="high"
             allowScriptAccess="always"
             type="application/x-shockwave-flash"
             pluginspage="http://www.macromedia.com/go/getflashplayer"
             FlashVars="id=clippy_1652&amp;copied=copied!&amp;copyto=copy to clipboard"
             bgcolor="#FFFFFF"
             wmode="opaque"
      />
      </object>
      

    </div>

    <div class="frames">
      <div class="frame frame-center" data-path="application/sql/houseshare_db_EER_v05.sql/" data-canonical-url="/marcinwol/houseshare/blob/63222ed9ed6a15edac58130a60d0bc253ad5bdf2/application/sql/houseshare_db_EER_v05.sql">
        
          <ul class="big-actions">
            
            <li><a class="file-edit-link minibutton" href="/marcinwol/houseshare/file-edit/__current_ref__/application/sql/houseshare_db_EER_v05.sql"><span>Edit this file</span></a></li>
          </ul>
        

        <div id="files">
          <div class="file">
            <div class="meta">
              <div class="info">
                <span class="icon"><img alt="Txt" height="16" src="https://d3nwyuy0nl342s.cloudfront.net/images/icons/txt.png" width="16" /></span>
                <span class="mode" title="File Mode">100644</span>
                
                  <span>986 lines (802 sloc)</span>
                
                <span>33.809 kb</span>
              </div>
              <ul class="actions">
                <li><a href="/marcinwol/houseshare/raw/master/application/sql/houseshare_db_EER_v05.sql" id="raw-url">raw</a></li>
                
                  <li><a href="/marcinwol/houseshare/blame/master/application/sql/houseshare_db_EER_v05.sql">blame</a></li>
                
                <li><a href="/marcinwol/houseshare/commits/master/application/sql/houseshare_db_EER_v05.sql">history</a></li>
              </ul>
            </div>
            
  <div class="data type-sql">
    
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <pre class="line_numbers"><span id="L1" rel="#L1">1</span>
<span id="L2" rel="#L2">2</span>
<span id="L3" rel="#L3">3</span>
<span id="L4" rel="#L4">4</span>
<span id="L5" rel="#L5">5</span>
<span id="L6" rel="#L6">6</span>
<span id="L7" rel="#L7">7</span>
<span id="L8" rel="#L8">8</span>
<span id="L9" rel="#L9">9</span>
<span id="L10" rel="#L10">10</span>
<span id="L11" rel="#L11">11</span>
<span id="L12" rel="#L12">12</span>
<span id="L13" rel="#L13">13</span>
<span id="L14" rel="#L14">14</span>
<span id="L15" rel="#L15">15</span>
<span id="L16" rel="#L16">16</span>
<span id="L17" rel="#L17">17</span>
<span id="L18" rel="#L18">18</span>
<span id="L19" rel="#L19">19</span>
<span id="L20" rel="#L20">20</span>
<span id="L21" rel="#L21">21</span>
<span id="L22" rel="#L22">22</span>
<span id="L23" rel="#L23">23</span>
<span id="L24" rel="#L24">24</span>
<span id="L25" rel="#L25">25</span>
<span id="L26" rel="#L26">26</span>
<span id="L27" rel="#L27">27</span>
<span id="L28" rel="#L28">28</span>
<span id="L29" rel="#L29">29</span>
<span id="L30" rel="#L30">30</span>
<span id="L31" rel="#L31">31</span>
<span id="L32" rel="#L32">32</span>
<span id="L33" rel="#L33">33</span>
<span id="L34" rel="#L34">34</span>
<span id="L35" rel="#L35">35</span>
<span id="L36" rel="#L36">36</span>
<span id="L37" rel="#L37">37</span>
<span id="L38" rel="#L38">38</span>
<span id="L39" rel="#L39">39</span>
<span id="L40" rel="#L40">40</span>
<span id="L41" rel="#L41">41</span>
<span id="L42" rel="#L42">42</span>
<span id="L43" rel="#L43">43</span>
<span id="L44" rel="#L44">44</span>
<span id="L45" rel="#L45">45</span>
<span id="L46" rel="#L46">46</span>
<span id="L47" rel="#L47">47</span>
<span id="L48" rel="#L48">48</span>
<span id="L49" rel="#L49">49</span>
<span id="L50" rel="#L50">50</span>
<span id="L51" rel="#L51">51</span>
<span id="L52" rel="#L52">52</span>
<span id="L53" rel="#L53">53</span>
<span id="L54" rel="#L54">54</span>
<span id="L55" rel="#L55">55</span>
<span id="L56" rel="#L56">56</span>
<span id="L57" rel="#L57">57</span>
<span id="L58" rel="#L58">58</span>
<span id="L59" rel="#L59">59</span>
<span id="L60" rel="#L60">60</span>
<span id="L61" rel="#L61">61</span>
<span id="L62" rel="#L62">62</span>
<span id="L63" rel="#L63">63</span>
<span id="L64" rel="#L64">64</span>
<span id="L65" rel="#L65">65</span>
<span id="L66" rel="#L66">66</span>
<span id="L67" rel="#L67">67</span>
<span id="L68" rel="#L68">68</span>
<span id="L69" rel="#L69">69</span>
<span id="L70" rel="#L70">70</span>
<span id="L71" rel="#L71">71</span>
<span id="L72" rel="#L72">72</span>
<span id="L73" rel="#L73">73</span>
<span id="L74" rel="#L74">74</span>
<span id="L75" rel="#L75">75</span>
<span id="L76" rel="#L76">76</span>
<span id="L77" rel="#L77">77</span>
<span id="L78" rel="#L78">78</span>
<span id="L79" rel="#L79">79</span>
<span id="L80" rel="#L80">80</span>
<span id="L81" rel="#L81">81</span>
<span id="L82" rel="#L82">82</span>
<span id="L83" rel="#L83">83</span>
<span id="L84" rel="#L84">84</span>
<span id="L85" rel="#L85">85</span>
<span id="L86" rel="#L86">86</span>
<span id="L87" rel="#L87">87</span>
<span id="L88" rel="#L88">88</span>
<span id="L89" rel="#L89">89</span>
<span id="L90" rel="#L90">90</span>
<span id="L91" rel="#L91">91</span>
<span id="L92" rel="#L92">92</span>
<span id="L93" rel="#L93">93</span>
<span id="L94" rel="#L94">94</span>
<span id="L95" rel="#L95">95</span>
<span id="L96" rel="#L96">96</span>
<span id="L97" rel="#L97">97</span>
<span id="L98" rel="#L98">98</span>
<span id="L99" rel="#L99">99</span>
<span id="L100" rel="#L100">100</span>
<span id="L101" rel="#L101">101</span>
<span id="L102" rel="#L102">102</span>
<span id="L103" rel="#L103">103</span>
<span id="L104" rel="#L104">104</span>
<span id="L105" rel="#L105">105</span>
<span id="L106" rel="#L106">106</span>
<span id="L107" rel="#L107">107</span>
<span id="L108" rel="#L108">108</span>
<span id="L109" rel="#L109">109</span>
<span id="L110" rel="#L110">110</span>
<span id="L111" rel="#L111">111</span>
<span id="L112" rel="#L112">112</span>
<span id="L113" rel="#L113">113</span>
<span id="L114" rel="#L114">114</span>
<span id="L115" rel="#L115">115</span>
<span id="L116" rel="#L116">116</span>
<span id="L117" rel="#L117">117</span>
<span id="L118" rel="#L118">118</span>
<span id="L119" rel="#L119">119</span>
<span id="L120" rel="#L120">120</span>
<span id="L121" rel="#L121">121</span>
<span id="L122" rel="#L122">122</span>
<span id="L123" rel="#L123">123</span>
<span id="L124" rel="#L124">124</span>
<span id="L125" rel="#L125">125</span>
<span id="L126" rel="#L126">126</span>
<span id="L127" rel="#L127">127</span>
<span id="L128" rel="#L128">128</span>
<span id="L129" rel="#L129">129</span>
<span id="L130" rel="#L130">130</span>
<span id="L131" rel="#L131">131</span>
<span id="L132" rel="#L132">132</span>
<span id="L133" rel="#L133">133</span>
<span id="L134" rel="#L134">134</span>
<span id="L135" rel="#L135">135</span>
<span id="L136" rel="#L136">136</span>
<span id="L137" rel="#L137">137</span>
<span id="L138" rel="#L138">138</span>
<span id="L139" rel="#L139">139</span>
<span id="L140" rel="#L140">140</span>
<span id="L141" rel="#L141">141</span>
<span id="L142" rel="#L142">142</span>
<span id="L143" rel="#L143">143</span>
<span id="L144" rel="#L144">144</span>
<span id="L145" rel="#L145">145</span>
<span id="L146" rel="#L146">146</span>
<span id="L147" rel="#L147">147</span>
<span id="L148" rel="#L148">148</span>
<span id="L149" rel="#L149">149</span>
<span id="L150" rel="#L150">150</span>
<span id="L151" rel="#L151">151</span>
<span id="L152" rel="#L152">152</span>
<span id="L153" rel="#L153">153</span>
<span id="L154" rel="#L154">154</span>
<span id="L155" rel="#L155">155</span>
<span id="L156" rel="#L156">156</span>
<span id="L157" rel="#L157">157</span>
<span id="L158" rel="#L158">158</span>
<span id="L159" rel="#L159">159</span>
<span id="L160" rel="#L160">160</span>
<span id="L161" rel="#L161">161</span>
<span id="L162" rel="#L162">162</span>
<span id="L163" rel="#L163">163</span>
<span id="L164" rel="#L164">164</span>
<span id="L165" rel="#L165">165</span>
<span id="L166" rel="#L166">166</span>
<span id="L167" rel="#L167">167</span>
<span id="L168" rel="#L168">168</span>
<span id="L169" rel="#L169">169</span>
<span id="L170" rel="#L170">170</span>
<span id="L171" rel="#L171">171</span>
<span id="L172" rel="#L172">172</span>
<span id="L173" rel="#L173">173</span>
<span id="L174" rel="#L174">174</span>
<span id="L175" rel="#L175">175</span>
<span id="L176" rel="#L176">176</span>
<span id="L177" rel="#L177">177</span>
<span id="L178" rel="#L178">178</span>
<span id="L179" rel="#L179">179</span>
<span id="L180" rel="#L180">180</span>
<span id="L181" rel="#L181">181</span>
<span id="L182" rel="#L182">182</span>
<span id="L183" rel="#L183">183</span>
<span id="L184" rel="#L184">184</span>
<span id="L185" rel="#L185">185</span>
<span id="L186" rel="#L186">186</span>
<span id="L187" rel="#L187">187</span>
<span id="L188" rel="#L188">188</span>
<span id="L189" rel="#L189">189</span>
<span id="L190" rel="#L190">190</span>
<span id="L191" rel="#L191">191</span>
<span id="L192" rel="#L192">192</span>
<span id="L193" rel="#L193">193</span>
<span id="L194" rel="#L194">194</span>
<span id="L195" rel="#L195">195</span>
<span id="L196" rel="#L196">196</span>
<span id="L197" rel="#L197">197</span>
<span id="L198" rel="#L198">198</span>
<span id="L199" rel="#L199">199</span>
<span id="L200" rel="#L200">200</span>
<span id="L201" rel="#L201">201</span>
<span id="L202" rel="#L202">202</span>
<span id="L203" rel="#L203">203</span>
<span id="L204" rel="#L204">204</span>
<span id="L205" rel="#L205">205</span>
<span id="L206" rel="#L206">206</span>
<span id="L207" rel="#L207">207</span>
<span id="L208" rel="#L208">208</span>
<span id="L209" rel="#L209">209</span>
<span id="L210" rel="#L210">210</span>
<span id="L211" rel="#L211">211</span>
<span id="L212" rel="#L212">212</span>
<span id="L213" rel="#L213">213</span>
<span id="L214" rel="#L214">214</span>
<span id="L215" rel="#L215">215</span>
<span id="L216" rel="#L216">216</span>
<span id="L217" rel="#L217">217</span>
<span id="L218" rel="#L218">218</span>
<span id="L219" rel="#L219">219</span>
<span id="L220" rel="#L220">220</span>
<span id="L221" rel="#L221">221</span>
<span id="L222" rel="#L222">222</span>
<span id="L223" rel="#L223">223</span>
<span id="L224" rel="#L224">224</span>
<span id="L225" rel="#L225">225</span>
<span id="L226" rel="#L226">226</span>
<span id="L227" rel="#L227">227</span>
<span id="L228" rel="#L228">228</span>
<span id="L229" rel="#L229">229</span>
<span id="L230" rel="#L230">230</span>
<span id="L231" rel="#L231">231</span>
<span id="L232" rel="#L232">232</span>
<span id="L233" rel="#L233">233</span>
<span id="L234" rel="#L234">234</span>
<span id="L235" rel="#L235">235</span>
<span id="L236" rel="#L236">236</span>
<span id="L237" rel="#L237">237</span>
<span id="L238" rel="#L238">238</span>
<span id="L239" rel="#L239">239</span>
<span id="L240" rel="#L240">240</span>
<span id="L241" rel="#L241">241</span>
<span id="L242" rel="#L242">242</span>
<span id="L243" rel="#L243">243</span>
<span id="L244" rel="#L244">244</span>
<span id="L245" rel="#L245">245</span>
<span id="L246" rel="#L246">246</span>
<span id="L247" rel="#L247">247</span>
<span id="L248" rel="#L248">248</span>
<span id="L249" rel="#L249">249</span>
<span id="L250" rel="#L250">250</span>
<span id="L251" rel="#L251">251</span>
<span id="L252" rel="#L252">252</span>
<span id="L253" rel="#L253">253</span>
<span id="L254" rel="#L254">254</span>
<span id="L255" rel="#L255">255</span>
<span id="L256" rel="#L256">256</span>
<span id="L257" rel="#L257">257</span>
<span id="L258" rel="#L258">258</span>
<span id="L259" rel="#L259">259</span>
<span id="L260" rel="#L260">260</span>
<span id="L261" rel="#L261">261</span>
<span id="L262" rel="#L262">262</span>
<span id="L263" rel="#L263">263</span>
<span id="L264" rel="#L264">264</span>
<span id="L265" rel="#L265">265</span>
<span id="L266" rel="#L266">266</span>
<span id="L267" rel="#L267">267</span>
<span id="L268" rel="#L268">268</span>
<span id="L269" rel="#L269">269</span>
<span id="L270" rel="#L270">270</span>
<span id="L271" rel="#L271">271</span>
<span id="L272" rel="#L272">272</span>
<span id="L273" rel="#L273">273</span>
<span id="L274" rel="#L274">274</span>
<span id="L275" rel="#L275">275</span>
<span id="L276" rel="#L276">276</span>
<span id="L277" rel="#L277">277</span>
<span id="L278" rel="#L278">278</span>
<span id="L279" rel="#L279">279</span>
<span id="L280" rel="#L280">280</span>
<span id="L281" rel="#L281">281</span>
<span id="L282" rel="#L282">282</span>
<span id="L283" rel="#L283">283</span>
<span id="L284" rel="#L284">284</span>
<span id="L285" rel="#L285">285</span>
<span id="L286" rel="#L286">286</span>
<span id="L287" rel="#L287">287</span>
<span id="L288" rel="#L288">288</span>
<span id="L289" rel="#L289">289</span>
<span id="L290" rel="#L290">290</span>
<span id="L291" rel="#L291">291</span>
<span id="L292" rel="#L292">292</span>
<span id="L293" rel="#L293">293</span>
<span id="L294" rel="#L294">294</span>
<span id="L295" rel="#L295">295</span>
<span id="L296" rel="#L296">296</span>
<span id="L297" rel="#L297">297</span>
<span id="L298" rel="#L298">298</span>
<span id="L299" rel="#L299">299</span>
<span id="L300" rel="#L300">300</span>
<span id="L301" rel="#L301">301</span>
<span id="L302" rel="#L302">302</span>
<span id="L303" rel="#L303">303</span>
<span id="L304" rel="#L304">304</span>
<span id="L305" rel="#L305">305</span>
<span id="L306" rel="#L306">306</span>
<span id="L307" rel="#L307">307</span>
<span id="L308" rel="#L308">308</span>
<span id="L309" rel="#L309">309</span>
<span id="L310" rel="#L310">310</span>
<span id="L311" rel="#L311">311</span>
<span id="L312" rel="#L312">312</span>
<span id="L313" rel="#L313">313</span>
<span id="L314" rel="#L314">314</span>
<span id="L315" rel="#L315">315</span>
<span id="L316" rel="#L316">316</span>
<span id="L317" rel="#L317">317</span>
<span id="L318" rel="#L318">318</span>
<span id="L319" rel="#L319">319</span>
<span id="L320" rel="#L320">320</span>
<span id="L321" rel="#L321">321</span>
<span id="L322" rel="#L322">322</span>
<span id="L323" rel="#L323">323</span>
<span id="L324" rel="#L324">324</span>
<span id="L325" rel="#L325">325</span>
<span id="L326" rel="#L326">326</span>
<span id="L327" rel="#L327">327</span>
<span id="L328" rel="#L328">328</span>
<span id="L329" rel="#L329">329</span>
<span id="L330" rel="#L330">330</span>
<span id="L331" rel="#L331">331</span>
<span id="L332" rel="#L332">332</span>
<span id="L333" rel="#L333">333</span>
<span id="L334" rel="#L334">334</span>
<span id="L335" rel="#L335">335</span>
<span id="L336" rel="#L336">336</span>
<span id="L337" rel="#L337">337</span>
<span id="L338" rel="#L338">338</span>
<span id="L339" rel="#L339">339</span>
<span id="L340" rel="#L340">340</span>
<span id="L341" rel="#L341">341</span>
<span id="L342" rel="#L342">342</span>
<span id="L343" rel="#L343">343</span>
<span id="L344" rel="#L344">344</span>
<span id="L345" rel="#L345">345</span>
<span id="L346" rel="#L346">346</span>
<span id="L347" rel="#L347">347</span>
<span id="L348" rel="#L348">348</span>
<span id="L349" rel="#L349">349</span>
<span id="L350" rel="#L350">350</span>
<span id="L351" rel="#L351">351</span>
<span id="L352" rel="#L352">352</span>
<span id="L353" rel="#L353">353</span>
<span id="L354" rel="#L354">354</span>
<span id="L355" rel="#L355">355</span>
<span id="L356" rel="#L356">356</span>
<span id="L357" rel="#L357">357</span>
<span id="L358" rel="#L358">358</span>
<span id="L359" rel="#L359">359</span>
<span id="L360" rel="#L360">360</span>
<span id="L361" rel="#L361">361</span>
<span id="L362" rel="#L362">362</span>
<span id="L363" rel="#L363">363</span>
<span id="L364" rel="#L364">364</span>
<span id="L365" rel="#L365">365</span>
<span id="L366" rel="#L366">366</span>
<span id="L367" rel="#L367">367</span>
<span id="L368" rel="#L368">368</span>
<span id="L369" rel="#L369">369</span>
<span id="L370" rel="#L370">370</span>
<span id="L371" rel="#L371">371</span>
<span id="L372" rel="#L372">372</span>
<span id="L373" rel="#L373">373</span>
<span id="L374" rel="#L374">374</span>
<span id="L375" rel="#L375">375</span>
<span id="L376" rel="#L376">376</span>
<span id="L377" rel="#L377">377</span>
<span id="L378" rel="#L378">378</span>
<span id="L379" rel="#L379">379</span>
<span id="L380" rel="#L380">380</span>
<span id="L381" rel="#L381">381</span>
<span id="L382" rel="#L382">382</span>
<span id="L383" rel="#L383">383</span>
<span id="L384" rel="#L384">384</span>
<span id="L385" rel="#L385">385</span>
<span id="L386" rel="#L386">386</span>
<span id="L387" rel="#L387">387</span>
<span id="L388" rel="#L388">388</span>
<span id="L389" rel="#L389">389</span>
<span id="L390" rel="#L390">390</span>
<span id="L391" rel="#L391">391</span>
<span id="L392" rel="#L392">392</span>
<span id="L393" rel="#L393">393</span>
<span id="L394" rel="#L394">394</span>
<span id="L395" rel="#L395">395</span>
<span id="L396" rel="#L396">396</span>
<span id="L397" rel="#L397">397</span>
<span id="L398" rel="#L398">398</span>
<span id="L399" rel="#L399">399</span>
<span id="L400" rel="#L400">400</span>
<span id="L401" rel="#L401">401</span>
<span id="L402" rel="#L402">402</span>
<span id="L403" rel="#L403">403</span>
<span id="L404" rel="#L404">404</span>
<span id="L405" rel="#L405">405</span>
<span id="L406" rel="#L406">406</span>
<span id="L407" rel="#L407">407</span>
<span id="L408" rel="#L408">408</span>
<span id="L409" rel="#L409">409</span>
<span id="L410" rel="#L410">410</span>
<span id="L411" rel="#L411">411</span>
<span id="L412" rel="#L412">412</span>
<span id="L413" rel="#L413">413</span>
<span id="L414" rel="#L414">414</span>
<span id="L415" rel="#L415">415</span>
<span id="L416" rel="#L416">416</span>
<span id="L417" rel="#L417">417</span>
<span id="L418" rel="#L418">418</span>
<span id="L419" rel="#L419">419</span>
<span id="L420" rel="#L420">420</span>
<span id="L421" rel="#L421">421</span>
<span id="L422" rel="#L422">422</span>
<span id="L423" rel="#L423">423</span>
<span id="L424" rel="#L424">424</span>
<span id="L425" rel="#L425">425</span>
<span id="L426" rel="#L426">426</span>
<span id="L427" rel="#L427">427</span>
<span id="L428" rel="#L428">428</span>
<span id="L429" rel="#L429">429</span>
<span id="L430" rel="#L430">430</span>
<span id="L431" rel="#L431">431</span>
<span id="L432" rel="#L432">432</span>
<span id="L433" rel="#L433">433</span>
<span id="L434" rel="#L434">434</span>
<span id="L435" rel="#L435">435</span>
<span id="L436" rel="#L436">436</span>
<span id="L437" rel="#L437">437</span>
<span id="L438" rel="#L438">438</span>
<span id="L439" rel="#L439">439</span>
<span id="L440" rel="#L440">440</span>
<span id="L441" rel="#L441">441</span>
<span id="L442" rel="#L442">442</span>
<span id="L443" rel="#L443">443</span>
<span id="L444" rel="#L444">444</span>
<span id="L445" rel="#L445">445</span>
<span id="L446" rel="#L446">446</span>
<span id="L447" rel="#L447">447</span>
<span id="L448" rel="#L448">448</span>
<span id="L449" rel="#L449">449</span>
<span id="L450" rel="#L450">450</span>
<span id="L451" rel="#L451">451</span>
<span id="L452" rel="#L452">452</span>
<span id="L453" rel="#L453">453</span>
<span id="L454" rel="#L454">454</span>
<span id="L455" rel="#L455">455</span>
<span id="L456" rel="#L456">456</span>
<span id="L457" rel="#L457">457</span>
<span id="L458" rel="#L458">458</span>
<span id="L459" rel="#L459">459</span>
<span id="L460" rel="#L460">460</span>
<span id="L461" rel="#L461">461</span>
<span id="L462" rel="#L462">462</span>
<span id="L463" rel="#L463">463</span>
<span id="L464" rel="#L464">464</span>
<span id="L465" rel="#L465">465</span>
<span id="L466" rel="#L466">466</span>
<span id="L467" rel="#L467">467</span>
<span id="L468" rel="#L468">468</span>
<span id="L469" rel="#L469">469</span>
<span id="L470" rel="#L470">470</span>
<span id="L471" rel="#L471">471</span>
<span id="L472" rel="#L472">472</span>
<span id="L473" rel="#L473">473</span>
<span id="L474" rel="#L474">474</span>
<span id="L475" rel="#L475">475</span>
<span id="L476" rel="#L476">476</span>
<span id="L477" rel="#L477">477</span>
<span id="L478" rel="#L478">478</span>
<span id="L479" rel="#L479">479</span>
<span id="L480" rel="#L480">480</span>
<span id="L481" rel="#L481">481</span>
<span id="L482" rel="#L482">482</span>
<span id="L483" rel="#L483">483</span>
<span id="L484" rel="#L484">484</span>
<span id="L485" rel="#L485">485</span>
<span id="L486" rel="#L486">486</span>
<span id="L487" rel="#L487">487</span>
<span id="L488" rel="#L488">488</span>
<span id="L489" rel="#L489">489</span>
<span id="L490" rel="#L490">490</span>
<span id="L491" rel="#L491">491</span>
<span id="L492" rel="#L492">492</span>
<span id="L493" rel="#L493">493</span>
<span id="L494" rel="#L494">494</span>
<span id="L495" rel="#L495">495</span>
<span id="L496" rel="#L496">496</span>
<span id="L497" rel="#L497">497</span>
<span id="L498" rel="#L498">498</span>
<span id="L499" rel="#L499">499</span>
<span id="L500" rel="#L500">500</span>
<span id="L501" rel="#L501">501</span>
<span id="L502" rel="#L502">502</span>
<span id="L503" rel="#L503">503</span>
<span id="L504" rel="#L504">504</span>
<span id="L505" rel="#L505">505</span>
<span id="L506" rel="#L506">506</span>
<span id="L507" rel="#L507">507</span>
<span id="L508" rel="#L508">508</span>
<span id="L509" rel="#L509">509</span>
<span id="L510" rel="#L510">510</span>
<span id="L511" rel="#L511">511</span>
<span id="L512" rel="#L512">512</span>
<span id="L513" rel="#L513">513</span>
<span id="L514" rel="#L514">514</span>
<span id="L515" rel="#L515">515</span>
<span id="L516" rel="#L516">516</span>
<span id="L517" rel="#L517">517</span>
<span id="L518" rel="#L518">518</span>
<span id="L519" rel="#L519">519</span>
<span id="L520" rel="#L520">520</span>
<span id="L521" rel="#L521">521</span>
<span id="L522" rel="#L522">522</span>
<span id="L523" rel="#L523">523</span>
<span id="L524" rel="#L524">524</span>
<span id="L525" rel="#L525">525</span>
<span id="L526" rel="#L526">526</span>
<span id="L527" rel="#L527">527</span>
<span id="L528" rel="#L528">528</span>
<span id="L529" rel="#L529">529</span>
<span id="L530" rel="#L530">530</span>
<span id="L531" rel="#L531">531</span>
<span id="L532" rel="#L532">532</span>
<span id="L533" rel="#L533">533</span>
<span id="L534" rel="#L534">534</span>
<span id="L535" rel="#L535">535</span>
<span id="L536" rel="#L536">536</span>
<span id="L537" rel="#L537">537</span>
<span id="L538" rel="#L538">538</span>
<span id="L539" rel="#L539">539</span>
<span id="L540" rel="#L540">540</span>
<span id="L541" rel="#L541">541</span>
<span id="L542" rel="#L542">542</span>
<span id="L543" rel="#L543">543</span>
<span id="L544" rel="#L544">544</span>
<span id="L545" rel="#L545">545</span>
<span id="L546" rel="#L546">546</span>
<span id="L547" rel="#L547">547</span>
<span id="L548" rel="#L548">548</span>
<span id="L549" rel="#L549">549</span>
<span id="L550" rel="#L550">550</span>
<span id="L551" rel="#L551">551</span>
<span id="L552" rel="#L552">552</span>
<span id="L553" rel="#L553">553</span>
<span id="L554" rel="#L554">554</span>
<span id="L555" rel="#L555">555</span>
<span id="L556" rel="#L556">556</span>
<span id="L557" rel="#L557">557</span>
<span id="L558" rel="#L558">558</span>
<span id="L559" rel="#L559">559</span>
<span id="L560" rel="#L560">560</span>
<span id="L561" rel="#L561">561</span>
<span id="L562" rel="#L562">562</span>
<span id="L563" rel="#L563">563</span>
<span id="L564" rel="#L564">564</span>
<span id="L565" rel="#L565">565</span>
<span id="L566" rel="#L566">566</span>
<span id="L567" rel="#L567">567</span>
<span id="L568" rel="#L568">568</span>
<span id="L569" rel="#L569">569</span>
<span id="L570" rel="#L570">570</span>
<span id="L571" rel="#L571">571</span>
<span id="L572" rel="#L572">572</span>
<span id="L573" rel="#L573">573</span>
<span id="L574" rel="#L574">574</span>
<span id="L575" rel="#L575">575</span>
<span id="L576" rel="#L576">576</span>
<span id="L577" rel="#L577">577</span>
<span id="L578" rel="#L578">578</span>
<span id="L579" rel="#L579">579</span>
<span id="L580" rel="#L580">580</span>
<span id="L581" rel="#L581">581</span>
<span id="L582" rel="#L582">582</span>
<span id="L583" rel="#L583">583</span>
<span id="L584" rel="#L584">584</span>
<span id="L585" rel="#L585">585</span>
<span id="L586" rel="#L586">586</span>
<span id="L587" rel="#L587">587</span>
<span id="L588" rel="#L588">588</span>
<span id="L589" rel="#L589">589</span>
<span id="L590" rel="#L590">590</span>
<span id="L591" rel="#L591">591</span>
<span id="L592" rel="#L592">592</span>
<span id="L593" rel="#L593">593</span>
<span id="L594" rel="#L594">594</span>
<span id="L595" rel="#L595">595</span>
<span id="L596" rel="#L596">596</span>
<span id="L597" rel="#L597">597</span>
<span id="L598" rel="#L598">598</span>
<span id="L599" rel="#L599">599</span>
<span id="L600" rel="#L600">600</span>
<span id="L601" rel="#L601">601</span>
<span id="L602" rel="#L602">602</span>
<span id="L603" rel="#L603">603</span>
<span id="L604" rel="#L604">604</span>
<span id="L605" rel="#L605">605</span>
<span id="L606" rel="#L606">606</span>
<span id="L607" rel="#L607">607</span>
<span id="L608" rel="#L608">608</span>
<span id="L609" rel="#L609">609</span>
<span id="L610" rel="#L610">610</span>
<span id="L611" rel="#L611">611</span>
<span id="L612" rel="#L612">612</span>
<span id="L613" rel="#L613">613</span>
<span id="L614" rel="#L614">614</span>
<span id="L615" rel="#L615">615</span>
<span id="L616" rel="#L616">616</span>
<span id="L617" rel="#L617">617</span>
<span id="L618" rel="#L618">618</span>
<span id="L619" rel="#L619">619</span>
<span id="L620" rel="#L620">620</span>
<span id="L621" rel="#L621">621</span>
<span id="L622" rel="#L622">622</span>
<span id="L623" rel="#L623">623</span>
<span id="L624" rel="#L624">624</span>
<span id="L625" rel="#L625">625</span>
<span id="L626" rel="#L626">626</span>
<span id="L627" rel="#L627">627</span>
<span id="L628" rel="#L628">628</span>
<span id="L629" rel="#L629">629</span>
<span id="L630" rel="#L630">630</span>
<span id="L631" rel="#L631">631</span>
<span id="L632" rel="#L632">632</span>
<span id="L633" rel="#L633">633</span>
<span id="L634" rel="#L634">634</span>
<span id="L635" rel="#L635">635</span>
<span id="L636" rel="#L636">636</span>
<span id="L637" rel="#L637">637</span>
<span id="L638" rel="#L638">638</span>
<span id="L639" rel="#L639">639</span>
<span id="L640" rel="#L640">640</span>
<span id="L641" rel="#L641">641</span>
<span id="L642" rel="#L642">642</span>
<span id="L643" rel="#L643">643</span>
<span id="L644" rel="#L644">644</span>
<span id="L645" rel="#L645">645</span>
<span id="L646" rel="#L646">646</span>
<span id="L647" rel="#L647">647</span>
<span id="L648" rel="#L648">648</span>
<span id="L649" rel="#L649">649</span>
<span id="L650" rel="#L650">650</span>
<span id="L651" rel="#L651">651</span>
<span id="L652" rel="#L652">652</span>
<span id="L653" rel="#L653">653</span>
<span id="L654" rel="#L654">654</span>
<span id="L655" rel="#L655">655</span>
<span id="L656" rel="#L656">656</span>
<span id="L657" rel="#L657">657</span>
<span id="L658" rel="#L658">658</span>
<span id="L659" rel="#L659">659</span>
<span id="L660" rel="#L660">660</span>
<span id="L661" rel="#L661">661</span>
<span id="L662" rel="#L662">662</span>
<span id="L663" rel="#L663">663</span>
<span id="L664" rel="#L664">664</span>
<span id="L665" rel="#L665">665</span>
<span id="L666" rel="#L666">666</span>
<span id="L667" rel="#L667">667</span>
<span id="L668" rel="#L668">668</span>
<span id="L669" rel="#L669">669</span>
<span id="L670" rel="#L670">670</span>
<span id="L671" rel="#L671">671</span>
<span id="L672" rel="#L672">672</span>
<span id="L673" rel="#L673">673</span>
<span id="L674" rel="#L674">674</span>
<span id="L675" rel="#L675">675</span>
<span id="L676" rel="#L676">676</span>
<span id="L677" rel="#L677">677</span>
<span id="L678" rel="#L678">678</span>
<span id="L679" rel="#L679">679</span>
<span id="L680" rel="#L680">680</span>
<span id="L681" rel="#L681">681</span>
<span id="L682" rel="#L682">682</span>
<span id="L683" rel="#L683">683</span>
<span id="L684" rel="#L684">684</span>
<span id="L685" rel="#L685">685</span>
<span id="L686" rel="#L686">686</span>
<span id="L687" rel="#L687">687</span>
<span id="L688" rel="#L688">688</span>
<span id="L689" rel="#L689">689</span>
<span id="L690" rel="#L690">690</span>
<span id="L691" rel="#L691">691</span>
<span id="L692" rel="#L692">692</span>
<span id="L693" rel="#L693">693</span>
<span id="L694" rel="#L694">694</span>
<span id="L695" rel="#L695">695</span>
<span id="L696" rel="#L696">696</span>
<span id="L697" rel="#L697">697</span>
<span id="L698" rel="#L698">698</span>
<span id="L699" rel="#L699">699</span>
<span id="L700" rel="#L700">700</span>
<span id="L701" rel="#L701">701</span>
<span id="L702" rel="#L702">702</span>
<span id="L703" rel="#L703">703</span>
<span id="L704" rel="#L704">704</span>
<span id="L705" rel="#L705">705</span>
<span id="L706" rel="#L706">706</span>
<span id="L707" rel="#L707">707</span>
<span id="L708" rel="#L708">708</span>
<span id="L709" rel="#L709">709</span>
<span id="L710" rel="#L710">710</span>
<span id="L711" rel="#L711">711</span>
<span id="L712" rel="#L712">712</span>
<span id="L713" rel="#L713">713</span>
<span id="L714" rel="#L714">714</span>
<span id="L715" rel="#L715">715</span>
<span id="L716" rel="#L716">716</span>
<span id="L717" rel="#L717">717</span>
<span id="L718" rel="#L718">718</span>
<span id="L719" rel="#L719">719</span>
<span id="L720" rel="#L720">720</span>
<span id="L721" rel="#L721">721</span>
<span id="L722" rel="#L722">722</span>
<span id="L723" rel="#L723">723</span>
<span id="L724" rel="#L724">724</span>
<span id="L725" rel="#L725">725</span>
<span id="L726" rel="#L726">726</span>
<span id="L727" rel="#L727">727</span>
<span id="L728" rel="#L728">728</span>
<span id="L729" rel="#L729">729</span>
<span id="L730" rel="#L730">730</span>
<span id="L731" rel="#L731">731</span>
<span id="L732" rel="#L732">732</span>
<span id="L733" rel="#L733">733</span>
<span id="L734" rel="#L734">734</span>
<span id="L735" rel="#L735">735</span>
<span id="L736" rel="#L736">736</span>
<span id="L737" rel="#L737">737</span>
<span id="L738" rel="#L738">738</span>
<span id="L739" rel="#L739">739</span>
<span id="L740" rel="#L740">740</span>
<span id="L741" rel="#L741">741</span>
<span id="L742" rel="#L742">742</span>
<span id="L743" rel="#L743">743</span>
<span id="L744" rel="#L744">744</span>
<span id="L745" rel="#L745">745</span>
<span id="L746" rel="#L746">746</span>
<span id="L747" rel="#L747">747</span>
<span id="L748" rel="#L748">748</span>
<span id="L749" rel="#L749">749</span>
<span id="L750" rel="#L750">750</span>
<span id="L751" rel="#L751">751</span>
<span id="L752" rel="#L752">752</span>
<span id="L753" rel="#L753">753</span>
<span id="L754" rel="#L754">754</span>
<span id="L755" rel="#L755">755</span>
<span id="L756" rel="#L756">756</span>
<span id="L757" rel="#L757">757</span>
<span id="L758" rel="#L758">758</span>
<span id="L759" rel="#L759">759</span>
<span id="L760" rel="#L760">760</span>
<span id="L761" rel="#L761">761</span>
<span id="L762" rel="#L762">762</span>
<span id="L763" rel="#L763">763</span>
<span id="L764" rel="#L764">764</span>
<span id="L765" rel="#L765">765</span>
<span id="L766" rel="#L766">766</span>
<span id="L767" rel="#L767">767</span>
<span id="L768" rel="#L768">768</span>
<span id="L769" rel="#L769">769</span>
<span id="L770" rel="#L770">770</span>
<span id="L771" rel="#L771">771</span>
<span id="L772" rel="#L772">772</span>
<span id="L773" rel="#L773">773</span>
<span id="L774" rel="#L774">774</span>
<span id="L775" rel="#L775">775</span>
<span id="L776" rel="#L776">776</span>
<span id="L777" rel="#L777">777</span>
<span id="L778" rel="#L778">778</span>
<span id="L779" rel="#L779">779</span>
<span id="L780" rel="#L780">780</span>
<span id="L781" rel="#L781">781</span>
<span id="L782" rel="#L782">782</span>
<span id="L783" rel="#L783">783</span>
<span id="L784" rel="#L784">784</span>
<span id="L785" rel="#L785">785</span>
<span id="L786" rel="#L786">786</span>
<span id="L787" rel="#L787">787</span>
<span id="L788" rel="#L788">788</span>
<span id="L789" rel="#L789">789</span>
<span id="L790" rel="#L790">790</span>
<span id="L791" rel="#L791">791</span>
<span id="L792" rel="#L792">792</span>
<span id="L793" rel="#L793">793</span>
<span id="L794" rel="#L794">794</span>
<span id="L795" rel="#L795">795</span>
<span id="L796" rel="#L796">796</span>
<span id="L797" rel="#L797">797</span>
<span id="L798" rel="#L798">798</span>
<span id="L799" rel="#L799">799</span>
<span id="L800" rel="#L800">800</span>
<span id="L801" rel="#L801">801</span>
<span id="L802" rel="#L802">802</span>
<span id="L803" rel="#L803">803</span>
<span id="L804" rel="#L804">804</span>
<span id="L805" rel="#L805">805</span>
<span id="L806" rel="#L806">806</span>
<span id="L807" rel="#L807">807</span>
<span id="L808" rel="#L808">808</span>
<span id="L809" rel="#L809">809</span>
<span id="L810" rel="#L810">810</span>
<span id="L811" rel="#L811">811</span>
<span id="L812" rel="#L812">812</span>
<span id="L813" rel="#L813">813</span>
<span id="L814" rel="#L814">814</span>
<span id="L815" rel="#L815">815</span>
<span id="L816" rel="#L816">816</span>
<span id="L817" rel="#L817">817</span>
<span id="L818" rel="#L818">818</span>
<span id="L819" rel="#L819">819</span>
<span id="L820" rel="#L820">820</span>
<span id="L821" rel="#L821">821</span>
<span id="L822" rel="#L822">822</span>
<span id="L823" rel="#L823">823</span>
<span id="L824" rel="#L824">824</span>
<span id="L825" rel="#L825">825</span>
<span id="L826" rel="#L826">826</span>
<span id="L827" rel="#L827">827</span>
<span id="L828" rel="#L828">828</span>
<span id="L829" rel="#L829">829</span>
<span id="L830" rel="#L830">830</span>
<span id="L831" rel="#L831">831</span>
<span id="L832" rel="#L832">832</span>
<span id="L833" rel="#L833">833</span>
<span id="L834" rel="#L834">834</span>
<span id="L835" rel="#L835">835</span>
<span id="L836" rel="#L836">836</span>
<span id="L837" rel="#L837">837</span>
<span id="L838" rel="#L838">838</span>
<span id="L839" rel="#L839">839</span>
<span id="L840" rel="#L840">840</span>
<span id="L841" rel="#L841">841</span>
<span id="L842" rel="#L842">842</span>
<span id="L843" rel="#L843">843</span>
<span id="L844" rel="#L844">844</span>
<span id="L845" rel="#L845">845</span>
<span id="L846" rel="#L846">846</span>
<span id="L847" rel="#L847">847</span>
<span id="L848" rel="#L848">848</span>
<span id="L849" rel="#L849">849</span>
<span id="L850" rel="#L850">850</span>
<span id="L851" rel="#L851">851</span>
<span id="L852" rel="#L852">852</span>
<span id="L853" rel="#L853">853</span>
<span id="L854" rel="#L854">854</span>
<span id="L855" rel="#L855">855</span>
<span id="L856" rel="#L856">856</span>
<span id="L857" rel="#L857">857</span>
<span id="L858" rel="#L858">858</span>
<span id="L859" rel="#L859">859</span>
<span id="L860" rel="#L860">860</span>
<span id="L861" rel="#L861">861</span>
<span id="L862" rel="#L862">862</span>
<span id="L863" rel="#L863">863</span>
<span id="L864" rel="#L864">864</span>
<span id="L865" rel="#L865">865</span>
<span id="L866" rel="#L866">866</span>
<span id="L867" rel="#L867">867</span>
<span id="L868" rel="#L868">868</span>
<span id="L869" rel="#L869">869</span>
<span id="L870" rel="#L870">870</span>
<span id="L871" rel="#L871">871</span>
<span id="L872" rel="#L872">872</span>
<span id="L873" rel="#L873">873</span>
<span id="L874" rel="#L874">874</span>
<span id="L875" rel="#L875">875</span>
<span id="L876" rel="#L876">876</span>
<span id="L877" rel="#L877">877</span>
<span id="L878" rel="#L878">878</span>
<span id="L879" rel="#L879">879</span>
<span id="L880" rel="#L880">880</span>
<span id="L881" rel="#L881">881</span>
<span id="L882" rel="#L882">882</span>
<span id="L883" rel="#L883">883</span>
<span id="L884" rel="#L884">884</span>
<span id="L885" rel="#L885">885</span>
<span id="L886" rel="#L886">886</span>
<span id="L887" rel="#L887">887</span>
<span id="L888" rel="#L888">888</span>
<span id="L889" rel="#L889">889</span>
<span id="L890" rel="#L890">890</span>
<span id="L891" rel="#L891">891</span>
<span id="L892" rel="#L892">892</span>
<span id="L893" rel="#L893">893</span>
<span id="L894" rel="#L894">894</span>
<span id="L895" rel="#L895">895</span>
<span id="L896" rel="#L896">896</span>
<span id="L897" rel="#L897">897</span>
<span id="L898" rel="#L898">898</span>
<span id="L899" rel="#L899">899</span>
<span id="L900" rel="#L900">900</span>
<span id="L901" rel="#L901">901</span>
<span id="L902" rel="#L902">902</span>
<span id="L903" rel="#L903">903</span>
<span id="L904" rel="#L904">904</span>
<span id="L905" rel="#L905">905</span>
<span id="L906" rel="#L906">906</span>
<span id="L907" rel="#L907">907</span>
<span id="L908" rel="#L908">908</span>
<span id="L909" rel="#L909">909</span>
<span id="L910" rel="#L910">910</span>
<span id="L911" rel="#L911">911</span>
<span id="L912" rel="#L912">912</span>
<span id="L913" rel="#L913">913</span>
<span id="L914" rel="#L914">914</span>
<span id="L915" rel="#L915">915</span>
<span id="L916" rel="#L916">916</span>
<span id="L917" rel="#L917">917</span>
<span id="L918" rel="#L918">918</span>
<span id="L919" rel="#L919">919</span>
<span id="L920" rel="#L920">920</span>
<span id="L921" rel="#L921">921</span>
<span id="L922" rel="#L922">922</span>
<span id="L923" rel="#L923">923</span>
<span id="L924" rel="#L924">924</span>
<span id="L925" rel="#L925">925</span>
<span id="L926" rel="#L926">926</span>
<span id="L927" rel="#L927">927</span>
<span id="L928" rel="#L928">928</span>
<span id="L929" rel="#L929">929</span>
<span id="L930" rel="#L930">930</span>
<span id="L931" rel="#L931">931</span>
<span id="L932" rel="#L932">932</span>
<span id="L933" rel="#L933">933</span>
<span id="L934" rel="#L934">934</span>
<span id="L935" rel="#L935">935</span>
<span id="L936" rel="#L936">936</span>
<span id="L937" rel="#L937">937</span>
<span id="L938" rel="#L938">938</span>
<span id="L939" rel="#L939">939</span>
<span id="L940" rel="#L940">940</span>
<span id="L941" rel="#L941">941</span>
<span id="L942" rel="#L942">942</span>
<span id="L943" rel="#L943">943</span>
<span id="L944" rel="#L944">944</span>
<span id="L945" rel="#L945">945</span>
<span id="L946" rel="#L946">946</span>
<span id="L947" rel="#L947">947</span>
<span id="L948" rel="#L948">948</span>
<span id="L949" rel="#L949">949</span>
<span id="L950" rel="#L950">950</span>
<span id="L951" rel="#L951">951</span>
<span id="L952" rel="#L952">952</span>
<span id="L953" rel="#L953">953</span>
<span id="L954" rel="#L954">954</span>
<span id="L955" rel="#L955">955</span>
<span id="L956" rel="#L956">956</span>
<span id="L957" rel="#L957">957</span>
<span id="L958" rel="#L958">958</span>
<span id="L959" rel="#L959">959</span>
<span id="L960" rel="#L960">960</span>
<span id="L961" rel="#L961">961</span>
<span id="L962" rel="#L962">962</span>
<span id="L963" rel="#L963">963</span>
<span id="L964" rel="#L964">964</span>
<span id="L965" rel="#L965">965</span>
<span id="L966" rel="#L966">966</span>
<span id="L967" rel="#L967">967</span>
<span id="L968" rel="#L968">968</span>
<span id="L969" rel="#L969">969</span>
<span id="L970" rel="#L970">970</span>
<span id="L971" rel="#L971">971</span>
<span id="L972" rel="#L972">972</span>
<span id="L973" rel="#L973">973</span>
<span id="L974" rel="#L974">974</span>
<span id="L975" rel="#L975">975</span>
<span id="L976" rel="#L976">976</span>
<span id="L977" rel="#L977">977</span>
<span id="L978" rel="#L978">978</span>
<span id="L979" rel="#L979">979</span>
<span id="L980" rel="#L980">980</span>
<span id="L981" rel="#L981">981</span>
<span id="L982" rel="#L982">982</span>
<span id="L983" rel="#L983">983</span>
<span id="L984" rel="#L984">984</span>
<span id="L985" rel="#L985">985</span>
<span id="L986" rel="#L986">986</span>
</pre>
          </td>
          <td width="100%">
            
              
                <div class="highlight"><pre><div class='line' id='LC1'><span class="k">SET</span> <span class="o">@</span><span class="n">OLD_UNIQUE_CHECKS</span><span class="o">=@@</span><span class="n">UNIQUE_CHECKS</span><span class="p">,</span> <span class="n">UNIQUE_CHECKS</span><span class="o">=</span><span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC2'><span class="k">SET</span> <span class="o">@</span><span class="n">OLD_FOREIGN_KEY_CHECKS</span><span class="o">=@@</span><span class="n">FOREIGN_KEY_CHECKS</span><span class="p">,</span> <span class="n">FOREIGN_KEY_CHECKS</span><span class="o">=</span><span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC3'><span class="k">SET</span> <span class="o">@</span><span class="n">OLD_SQL_MODE</span><span class="o">=@@</span><span class="n">SQL_MODE</span><span class="p">,</span> <span class="n">SQL_MODE</span><span class="o">=</span><span class="s1">&#39;TRADITIONAL&#39;</span><span class="p">;</span></div><div class='line' id='LC4'><br/></div><div class='line' id='LC5'><br/></div><div class='line' id='LC6'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC7'><span class="c1">-- Table `STATE`</span></div><div class='line' id='LC8'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC9'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="k">STATE</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC10'><br/></div><div class='line' id='LC11'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="k">STATE</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC12'>&nbsp;&nbsp;<span class="o">`</span><span class="n">state_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC13'>&nbsp;&nbsp;<span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">100</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC14'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">state_id</span><span class="o">`</span><span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC15'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC16'><span class="k">DEFAULT</span> <span class="nb">CHARACTER</span> <span class="k">SET</span> <span class="o">=</span> <span class="n">utf8</span></div><div class='line' id='LC17'><span class="k">COLLATE</span> <span class="o">=</span> <span class="n">utf8_polish_ci</span><span class="p">;</span></div><div class='line' id='LC18'><br/></div><div class='line' id='LC19'><span class="k">CREATE</span> <span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">name_UNIQUE</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="k">STATE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC20'><br/></div><div class='line' id='LC21'><br/></div><div class='line' id='LC22'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC23'><span class="c1">-- Table `MARKER`</span></div><div class='line' id='LC24'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC25'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">MARKER</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC26'><br/></div><div class='line' id='LC27'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">MARKER</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC28'>&nbsp;&nbsp;<span class="o">`</span><span class="n">marker_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC29'>&nbsp;&nbsp;<span class="o">`</span><span class="n">lat</span><span class="o">`</span> <span class="nb">FLOAT</span><span class="p">(</span><span class="mi">10</span><span class="p">,</span><span class="mi">6</span><span class="p">)</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC30'>&nbsp;&nbsp;<span class="o">`</span><span class="n">lng</span><span class="o">`</span> <span class="nb">FLOAT</span><span class="p">(</span><span class="mi">10</span><span class="p">,</span><span class="mi">6</span><span class="p">)</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC31'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">marker_id</span><span class="o">`</span><span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC32'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC33'><span class="k">COMMENT</span> <span class="o">=</span> <span class="s1">&#39;Google Map marker localization&#39;</span><span class="p">;</span></div><div class='line' id='LC34'><br/></div><div class='line' id='LC35'><br/></div><div class='line' id='LC36'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC37'><span class="c1">-- Table `CITY`</span></div><div class='line' id='LC38'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC39'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">CITY</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC40'><br/></div><div class='line' id='LC41'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">CITY</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC42'>&nbsp;&nbsp;<span class="o">`</span><span class="n">city_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC43'>&nbsp;&nbsp;<span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">100</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC44'>&nbsp;&nbsp;<span class="o">`</span><span class="n">state_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC45'>&nbsp;&nbsp;<span class="o">`</span><span class="n">marker_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC46'>&nbsp;&nbsp;<span class="o">`</span><span class="n">description</span><span class="o">`</span> <span class="nb">TEXT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC47'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC48'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_CITY_STATE1</span><span class="o">`</span></div><div class='line' id='LC49'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">state_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC50'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="k">STATE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">state_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC51'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">RESTRICT</span></div><div class='line' id='LC52'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">,</span></div><div class='line' id='LC53'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_CITY_MARKER1</span><span class="o">`</span></div><div class='line' id='LC54'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">marker_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC55'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">MARKER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">marker_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC56'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">SET</span> <span class="k">NULL</span></div><div class='line' id='LC57'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">)</span></div><div class='line' id='LC58'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC59'><span class="k">DEFAULT</span> <span class="nb">CHARACTER</span> <span class="k">SET</span> <span class="o">=</span> <span class="n">utf8</span></div><div class='line' id='LC60'><span class="k">COLLATE</span> <span class="o">=</span> <span class="n">utf8_polish_ci</span><span class="p">;</span></div><div class='line' id='LC61'><br/></div><div class='line' id='LC62'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_CITY_STATE1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">CITY</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">state_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC63'><br/></div><div class='line' id='LC64'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">city_name</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">CITY</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="k">ASC</span><span class="p">,</span> <span class="o">`</span><span class="n">state_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC65'><br/></div><div class='line' id='LC66'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_CITY_MARKER1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">CITY</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">marker_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC67'><br/></div><div class='line' id='LC68'><br/></div><div class='line' id='LC69'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC70'><span class="c1">-- Table `STREET`</span></div><div class='line' id='LC71'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC72'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">STREET</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC73'><br/></div><div class='line' id='LC74'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">STREET</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC75'>&nbsp;&nbsp;<span class="o">`</span><span class="n">street_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC76'>&nbsp;&nbsp;<span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">100</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC77'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">street_id</span><span class="o">`</span><span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC78'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC79'><span class="k">DEFAULT</span> <span class="nb">CHARACTER</span> <span class="k">SET</span> <span class="o">=</span> <span class="n">utf8</span></div><div class='line' id='LC80'><span class="k">COLLATE</span> <span class="o">=</span> <span class="n">utf8_polish_ci</span><span class="p">;</span></div><div class='line' id='LC81'><br/></div><div class='line' id='LC82'><br/></div><div class='line' id='LC83'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC84'><span class="c1">-- Table `ZIP`</span></div><div class='line' id='LC85'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC86'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ZIP</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC87'><br/></div><div class='line' id='LC88'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ZIP</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC89'>&nbsp;&nbsp;<span class="o">`</span><span class="n">zip_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC90'>&nbsp;&nbsp;<span class="o">`</span><span class="n">value</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">20</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC91'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">zip_id</span><span class="o">`</span><span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC92'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC93'><br/></div><div class='line' id='LC94'><span class="k">CREATE</span> <span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">value_UNIQUE</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">ZIP</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">value</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC95'><br/></div><div class='line' id='LC96'><br/></div><div class='line' id='LC97'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC98'><span class="c1">-- Table `ADDRESS`</span></div><div class='line' id='LC99'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC100'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ADDRESS</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC101'><br/></div><div class='line' id='LC102'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ADDRESS</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC103'>&nbsp;&nbsp;<span class="o">`</span><span class="n">addr_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC104'>&nbsp;&nbsp;<span class="o">`</span><span class="n">unit_no</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">10</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC105'>&nbsp;&nbsp;<span class="o">`</span><span class="n">street_no</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">10</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC106'>&nbsp;&nbsp;<span class="o">`</span><span class="n">city_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC107'>&nbsp;&nbsp;<span class="o">`</span><span class="n">street_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC108'>&nbsp;&nbsp;<span class="o">`</span><span class="n">zip_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC109'>&nbsp;&nbsp;<span class="o">`</span><span class="n">marker_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC110'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">addr_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC111'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ADDRESS_CITY1</span><span class="o">`</span></div><div class='line' id='LC112'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC113'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">CITY</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC114'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">RESTRICT</span></div><div class='line' id='LC115'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">,</span></div><div class='line' id='LC116'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ADDRESS_STREET1</span><span class="o">`</span></div><div class='line' id='LC117'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">street_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC118'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">STREET</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">street_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC119'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">RESTRICT</span></div><div class='line' id='LC120'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">,</span></div><div class='line' id='LC121'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ADDRESS_ZIP1</span><span class="o">`</span></div><div class='line' id='LC122'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">zip_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC123'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ZIP</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">zip_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC124'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">SET</span> <span class="k">NULL</span></div><div class='line' id='LC125'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">,</span></div><div class='line' id='LC126'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ADDRESS_MARKER1</span><span class="o">`</span></div><div class='line' id='LC127'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">marker_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC128'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">MARKER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">marker_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC129'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">SET</span> <span class="k">NULL</span></div><div class='line' id='LC130'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">)</span></div><div class='line' id='LC131'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC132'><br/></div><div class='line' id='LC133'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_ADDRESS_CITY1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">ADDRESS</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC134'><br/></div><div class='line' id='LC135'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_ADDRESS_STREET1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">ADDRESS</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">street_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC136'><br/></div><div class='line' id='LC137'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_ADDRESS_ZIP1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">ADDRESS</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">zip_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC138'><br/></div><div class='line' id='LC139'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_ADDRESS_MARKER1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">ADDRESS</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">marker_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC140'><br/></div><div class='line' id='LC141'><br/></div><div class='line' id='LC142'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC143'><span class="c1">-- Table `USER`</span></div><div class='line' id='LC144'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC145'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="k">USER</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC146'><br/></div><div class='line' id='LC147'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="k">USER</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC148'>&nbsp;&nbsp;<span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC149'>&nbsp;&nbsp;<span class="o">`</span><span class="n">email</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">85</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC150'>&nbsp;&nbsp;<span class="o">`</span><span class="n">phone</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">45</span><span class="p">)</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC151'>&nbsp;&nbsp;<span class="o">`</span><span class="n">phone_public</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">1</span><span class="p">)</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="mi">0</span> <span class="p">,</span></div><div class='line' id='LC152'>&nbsp;&nbsp;<span class="o">`</span><span class="n">created</span><span class="o">`</span> <span class="k">TIMESTAMP</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC153'>&nbsp;&nbsp;<span class="o">`</span><span class="n">first_name</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">45</span><span class="p">)</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC154'>&nbsp;&nbsp;<span class="o">`</span><span class="n">last_name</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">45</span><span class="p">)</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC155'>&nbsp;&nbsp;<span class="o">`</span><span class="n">last_name_public</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">1</span><span class="p">)</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="mi">1</span> <span class="p">,</span></div><div class='line' id='LC156'>&nbsp;&nbsp;<span class="o">`</span><span class="k">type</span><span class="o">`</span> <span class="n">ENUM</span><span class="p">(</span><span class="s1">&#39;USER&#39;</span><span class="p">,</span><span class="s1">&#39;ROOMATE&#39;</span><span class="p">,</span><span class="s1">&#39;LOOKER&#39;</span><span class="p">,</span><span class="s1">&#39;AGENT&#39;</span><span class="p">,</span><span class="s1">&#39;OWNER&#39;</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="s1">&#39;USER&#39;</span> <span class="p">,</span></div><div class='line' id='LC157'>&nbsp;&nbsp;<span class="o">`</span><span class="n">is_enabled</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">1</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="mi">1</span> <span class="p">,</span></div><div class='line' id='LC158'>&nbsp;&nbsp;<span class="o">`</span><span class="n">privilage</span><span class="o">`</span> <span class="n">ENUM</span><span class="p">(</span><span class="s1">&#39;BASIC&#39;</span><span class="p">,</span><span class="s1">&#39;PREMIUM&#39;</span><span class="p">,</span><span class="s1">&#39;ADMIN&#39;</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="s1">&#39;BASIC&#39;</span> <span class="p">,</span></div><div class='line' id='LC159'>&nbsp;&nbsp;<span class="o">`</span><span class="n">description</span><span class="o">`</span> <span class="nb">TEXT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC160'>&nbsp;&nbsp;<span class="o">`</span><span class="n">email_public</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">1</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="mi">0</span> <span class="p">,</span></div><div class='line' id='LC161'>&nbsp;&nbsp;<span class="o">`</span><span class="n">nickname</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">100</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC162'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span><span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC163'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC164'><span class="k">DEFAULT</span> <span class="nb">CHARACTER</span> <span class="k">SET</span> <span class="o">=</span> <span class="n">utf8</span></div><div class='line' id='LC165'><span class="k">COLLATE</span> <span class="o">=</span> <span class="n">utf8_polish_ci</span><span class="p">;</span></div><div class='line' id='LC166'><br/></div><div class='line' id='LC167'><span class="k">CREATE</span> <span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">email_UNIQUE</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="k">USER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">email</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC168'><br/></div><div class='line' id='LC169'><br/></div><div class='line' id='LC170'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC171'><span class="c1">-- Table `TYPE`</span></div><div class='line' id='LC172'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC173'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="k">TYPE</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC174'><br/></div><div class='line' id='LC175'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="k">TYPE</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC176'>&nbsp;&nbsp;<span class="o">`</span><span class="n">type_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC177'>&nbsp;&nbsp;<span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">45</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC178'>&nbsp;&nbsp;<span class="o">`</span><span class="n">is_shared</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">1</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="s1">&#39;1&#39;</span> <span class="p">,</span></div><div class='line' id='LC179'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC180'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC181'><br/></div><div class='line' id='LC182'><span class="k">CREATE</span> <span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">type_id_UNIQUE</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="k">TYPE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC183'><br/></div><div class='line' id='LC184'><br/></div><div class='line' id='LC185'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC186'><span class="c1">-- Table `ACCOMMODATION`</span></div><div class='line' id='LC187'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC188'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC189'><br/></div><div class='line' id='LC190'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC191'>&nbsp;&nbsp;<span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC192'>&nbsp;&nbsp;<span class="o">`</span><span class="n">title</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">255</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC193'>&nbsp;&nbsp;<span class="o">`</span><span class="n">description</span><span class="o">`</span> <span class="nb">TEXT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC194'>&nbsp;&nbsp;<span class="o">`</span><span class="n">addr_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC195'>&nbsp;&nbsp;<span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC196'>&nbsp;&nbsp;<span class="o">`</span><span class="n">date_avaliable</span><span class="o">`</span> <span class="nb">DATE</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC197'>&nbsp;&nbsp;<span class="o">`</span><span class="n">price</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC198'>&nbsp;&nbsp;<span class="o">`</span><span class="n">created</span><span class="o">`</span> <span class="k">TIMESTAMP</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC199'>&nbsp;&nbsp;<span class="o">`</span><span class="n">bond</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC200'>&nbsp;&nbsp;<span class="o">`</span><span class="n">street_address_public</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">1</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="mi">0</span> <span class="p">,</span></div><div class='line' id='LC201'>&nbsp;&nbsp;<span class="o">`</span><span class="n">short_term_ok</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">1</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="mi">1</span> <span class="p">,</span></div><div class='line' id='LC202'>&nbsp;&nbsp;<span class="o">`</span><span class="n">type_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC203'>&nbsp;&nbsp;<span class="o">`</span><span class="n">is_enabled</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">1</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="mi">0</span> <span class="p">,</span></div><div class='line' id='LC204'>&nbsp;&nbsp;<span class="o">`</span><span class="n">price_info</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">255</span><span class="p">)</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC205'>&nbsp;&nbsp;<span class="o">`</span><span class="n">queries_counter</span><span class="o">`</span> <span class="nb">INT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="mi">0</span> <span class="p">,</span></div><div class='line' id='LC206'>&nbsp;&nbsp;<span class="o">`</span><span class="n">features_info</span><span class="o">`</span> <span class="nb">TEXT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC207'>&nbsp;&nbsp;<span class="o">`</span><span class="n">preferences_info</span><span class="o">`</span> <span class="nb">TEXT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC208'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC209'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ACCOMODATION_ADDRESS1</span><span class="o">`</span></div><div class='line' id='LC210'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">addr_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC211'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ADDRESS</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">addr_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC212'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">RESTRICT</span></div><div class='line' id='LC213'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">,</span></div><div class='line' id='LC214'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ACCOMODATION_USER1</span><span class="o">`</span></div><div class='line' id='LC215'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC216'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="k">USER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC217'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC218'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">,</span></div><div class='line' id='LC219'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ACCOMMODATION_TYPE1</span><span class="o">`</span></div><div class='line' id='LC220'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC221'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="k">TYPE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC222'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">RESTRICT</span></div><div class='line' id='LC223'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">)</span></div><div class='line' id='LC224'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC225'><span class="k">DEFAULT</span> <span class="nb">CHARACTER</span> <span class="k">SET</span> <span class="o">=</span> <span class="n">utf8</span></div><div class='line' id='LC226'><span class="k">COLLATE</span> <span class="o">=</span> <span class="n">utf8_polish_ci</span></div><div class='line' id='LC227'><span class="n">PACK_KEYS</span> <span class="o">=</span> <span class="k">DEFAULT</span><span class="p">;</span></div><div class='line' id='LC228'><br/></div><div class='line' id='LC229'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_ACCOMODATION_ADDRESS1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">addr_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC230'><br/></div><div class='line' id='LC231'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_ACCOMODATION_USER1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC232'><br/></div><div class='line' id='LC233'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_ACCOMMODATION_TYPE1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC234'><br/></div><div class='line' id='LC235'><br/></div><div class='line' id='LC236'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC237'><span class="c1">-- Table `NONSHARE_ACC_DETAILS`</span></div><div class='line' id='LC238'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC239'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">NONSHARE_ACC_DETAILS</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC240'><br/></div><div class='line' id='LC241'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">NONSHARE_ACC_DETAILS</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC242'>&nbsp;&nbsp;<span class="o">`</span><span class="n">details_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC243'>&nbsp;&nbsp;<span class="o">`</span><span class="n">bedrooms</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">4</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC244'>&nbsp;&nbsp;<span class="o">`</span><span class="n">bathrooms</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">4</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC245'>&nbsp;&nbsp;<span class="o">`</span><span class="n">parking_spots</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">4</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC246'>&nbsp;&nbsp;<span class="o">`</span><span class="n">furnished</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">2</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC247'>&nbsp;&nbsp;<span class="o">`</span><span class="k">size</span><span class="o">`</span> <span class="nb">INT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC248'>&nbsp;&nbsp;<span class="o">`</span><span class="n">description</span><span class="o">`</span> <span class="nb">TEXT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC249'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">details_id</span><span class="o">`</span><span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC250'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC251'><span class="k">DEFAULT</span> <span class="nb">CHARACTER</span> <span class="k">SET</span> <span class="o">=</span> <span class="n">utf8</span></div><div class='line' id='LC252'><span class="k">COLLATE</span> <span class="o">=</span> <span class="n">utf8_polish_ci</span><span class="p">;</span></div><div class='line' id='LC253'><br/></div><div class='line' id='LC254'><br/></div><div class='line' id='LC255'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC256'><span class="c1">-- Table `APPARTMENT`</span></div><div class='line' id='LC257'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC258'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">APPARTMENT</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC259'><br/></div><div class='line' id='LC260'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">APPARTMENT</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC261'>&nbsp;&nbsp;<span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC262'>&nbsp;&nbsp;<span class="o">`</span><span class="n">details_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC263'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC264'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_APPARTMENT_ACCOMODATION1</span><span class="o">`</span></div><div class='line' id='LC265'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC266'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC267'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC268'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">,</span></div><div class='line' id='LC269'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_APPARTMENT_NONSHARE_ACC_DETAILS1</span><span class="o">`</span></div><div class='line' id='LC270'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">details_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC271'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">NONSHARE_ACC_DETAILS</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">details_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC272'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">NO</span> <span class="n">ACTION</span></div><div class='line' id='LC273'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">)</span></div><div class='line' id='LC274'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC275'><br/></div><div class='line' id='LC276'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_APPARTMENT_ACCOMODATION1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">APPARTMENT</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC277'><br/></div><div class='line' id='LC278'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_APPARTMENT_NONSHARE_ACC_DETAILS1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">APPARTMENT</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">details_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC279'><br/></div><div class='line' id='LC280'><br/></div><div class='line' id='LC281'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC282'><span class="c1">-- Table `HOUSE`</span></div><div class='line' id='LC283'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC284'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">HOUSE</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC285'><br/></div><div class='line' id='LC286'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">HOUSE</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC287'>&nbsp;&nbsp;<span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC288'>&nbsp;&nbsp;<span class="o">`</span><span class="n">details_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC289'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC290'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_HOUSE_ACCOMODATION1</span><span class="o">`</span></div><div class='line' id='LC291'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC292'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC293'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC294'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">,</span></div><div class='line' id='LC295'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_HOUSE_NONSHARE_ACC_DETAILS1</span><span class="o">`</span></div><div class='line' id='LC296'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">details_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC297'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">NONSHARE_ACC_DETAILS</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">details_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC298'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">NO</span> <span class="n">ACTION</span></div><div class='line' id='LC299'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">)</span></div><div class='line' id='LC300'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC301'><br/></div><div class='line' id='LC302'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_HOUSE_NONSHARE_ACC_DETAILS1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">HOUSE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">details_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC303'><br/></div><div class='line' id='LC304'><br/></div><div class='line' id='LC305'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC306'><span class="c1">-- Table `FEATURE`</span></div><div class='line' id='LC307'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC308'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">FEATURE</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC309'><br/></div><div class='line' id='LC310'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">FEATURE</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC311'>&nbsp;&nbsp;<span class="o">`</span><span class="n">feat_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC312'>&nbsp;&nbsp;<span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">45</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC313'>&nbsp;&nbsp;<span class="o">`</span><span class="nb">binary</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">1</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="mi">1</span> <span class="k">COMMENT</span> <span class="s1">&#39;To indicate whether \na feature is no/yes\nonly.&#39;</span> <span class="p">,</span></div><div class='line' id='LC314'>&nbsp;&nbsp;<span class="o">`</span><span class="n">type_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC315'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC316'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_FEATURE_TYPE1</span><span class="o">`</span></div><div class='line' id='LC317'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC318'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="k">TYPE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC319'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">NO</span> <span class="n">ACTION</span></div><div class='line' id='LC320'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">)</span></div><div class='line' id='LC321'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC322'><span class="k">COMMENT</span> <span class="o">=</span> <span class="s1">&#39;e.g. parking, internet, cable_tv, air_conditioning&#39;</span><span class="p">;</span></div><div class='line' id='LC323'><br/></div><div class='line' id='LC324'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_FEATURE_TYPE1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">FEATURE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC325'><br/></div><div class='line' id='LC326'><span class="k">CREATE</span> <span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">name_UNIQUE</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">FEATURE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC327'><br/></div><div class='line' id='LC328'><br/></div><div class='line' id='LC329'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC330'><span class="c1">-- Table `ACCOMODATION_has_FEATURE`</span></div><div class='line' id='LC331'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC332'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ACCOMODATION_has_FEATURE</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC333'><br/></div><div class='line' id='LC334'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ACCOMODATION_has_FEATURE</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC335'>&nbsp;&nbsp;<span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC336'>&nbsp;&nbsp;<span class="o">`</span><span class="n">feat_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC337'>&nbsp;&nbsp;<span class="o">`</span><span class="n">value</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">3</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC338'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC339'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ACCOMODATION_has_FEATURE_ACCOMODATION1</span><span class="o">`</span></div><div class='line' id='LC340'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC341'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC342'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC343'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">,</span></div><div class='line' id='LC344'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ACCOMODATION_has_FEATURE_FEATURE1</span><span class="o">`</span></div><div class='line' id='LC345'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC346'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">FEATURE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC347'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">RESTRICT</span></div><div class='line' id='LC348'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">RESTRICT</span><span class="p">)</span></div><div class='line' id='LC349'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC350'><br/></div><div class='line' id='LC351'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_ACCOMODATION_has_FEATURE_FEATURE1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">ACCOMODATION_has_FEATURE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC352'><br/></div><div class='line' id='LC353'><br/></div><div class='line' id='LC354'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC355'><span class="c1">-- Table `PATH`</span></div><div class='line' id='LC356'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC357'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">PATH</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC358'><br/></div><div class='line' id='LC359'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">PATH</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC360'>&nbsp;&nbsp;<span class="o">`</span><span class="n">path_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC361'>&nbsp;&nbsp;<span class="o">`</span><span class="n">value</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">255</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC362'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">path_id</span><span class="o">`</span><span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC363'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC364'><br/></div><div class='line' id='LC365'><span class="k">CREATE</span> <span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">value_UNIQUE</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">PATH</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">value</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC366'><br/></div><div class='line' id='LC367'><br/></div><div class='line' id='LC368'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC369'><span class="c1">-- Table `PHOTO`</span></div><div class='line' id='LC370'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC371'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">PHOTO</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC372'><br/></div><div class='line' id='LC373'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">PHOTO</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC374'>&nbsp;&nbsp;<span class="o">`</span><span class="n">photo_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC375'>&nbsp;&nbsp;<span class="o">`</span><span class="n">filename</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">45</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC376'>&nbsp;&nbsp;<span class="o">`</span><span class="n">path_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC377'>&nbsp;&nbsp;<span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC378'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">photo_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC379'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_PHOTO_ACCOMODATION1</span><span class="o">`</span></div><div class='line' id='LC380'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC381'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC382'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC383'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">,</span></div><div class='line' id='LC384'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_PHOTO_PATH1</span><span class="o">`</span></div><div class='line' id='LC385'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">path_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC386'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">PATH</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">path_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC387'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">RESTRICT</span></div><div class='line' id='LC388'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">)</span></div><div class='line' id='LC389'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC390'><br/></div><div class='line' id='LC391'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_PHOTO_ACCOMODATION1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">PHOTO</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC392'><br/></div><div class='line' id='LC393'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_PHOTO_PATH1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">PHOTO</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">path_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC394'><br/></div><div class='line' id='LC395'><span class="k">CREATE</span> <span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">UNIQUE_PATH</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">PHOTO</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">path_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">,</span> <span class="o">`</span><span class="n">filename</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC396'><br/></div><div class='line' id='LC397'><br/></div><div class='line' id='LC398'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC399'><span class="c1">-- Table `ROOMATES`</span></div><div class='line' id='LC400'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC401'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ROOMATES</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC402'><br/></div><div class='line' id='LC403'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ROOMATES</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC404'>&nbsp;&nbsp;<span class="o">`</span><span class="n">roomates_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC405'>&nbsp;&nbsp;<span class="o">`</span><span class="n">no_roomates</span><span class="o">`</span> <span class="n">TINYINT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC406'>&nbsp;&nbsp;<span class="o">`</span><span class="n">min_age</span><span class="o">`</span> <span class="n">TINYINT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC407'>&nbsp;&nbsp;<span class="o">`</span><span class="n">max_age</span><span class="o">`</span> <span class="n">TINYINT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC408'>&nbsp;&nbsp;<span class="o">`</span><span class="n">gender</span><span class="o">`</span> <span class="n">TINYINT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC409'>&nbsp;&nbsp;<span class="o">`</span><span class="n">description</span><span class="o">`</span> <span class="nb">TEXT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC410'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">roomates_id</span><span class="o">`</span><span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC411'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC412'><span class="k">DEFAULT</span> <span class="nb">CHARACTER</span> <span class="k">SET</span> <span class="o">=</span> <span class="n">utf8</span></div><div class='line' id='LC413'><span class="k">COLLATE</span> <span class="o">=</span> <span class="n">utf8_polish_ci</span></div><div class='line' id='LC414'><span class="k">COMMENT</span> <span class="o">=</span> <span class="s1">&#39;Info about roomates&#39;</span><span class="p">;</span></div><div class='line' id='LC415'><br/></div><div class='line' id='LC416'><br/></div><div class='line' id='LC417'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC418'><span class="c1">-- Table `PREFERENCE`</span></div><div class='line' id='LC419'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC420'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">PREFERENCE</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC421'><br/></div><div class='line' id='LC422'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">PREFERENCE</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC423'>&nbsp;&nbsp;<span class="o">`</span><span class="n">pref_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC424'>&nbsp;&nbsp;<span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">45</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC425'>&nbsp;&nbsp;<span class="o">`</span><span class="nb">binary</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">1</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="mi">1</span> <span class="k">COMMENT</span> <span class="s1">&#39;This indicates whether\nthe preference is \nonly yes/no type.&#39;</span> <span class="p">,</span></div><div class='line' id='LC426'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">pref_id</span><span class="o">`</span><span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC427'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC428'><br/></div><div class='line' id='LC429'><span class="k">CREATE</span> <span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">name_UNIQUE</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">PREFERENCE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC430'><br/></div><div class='line' id='LC431'><br/></div><div class='line' id='LC432'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC433'><span class="c1">-- Table `ACCOMODATION_has_PREFERENCE`</span></div><div class='line' id='LC434'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC435'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ACCOMODATION_has_PREFERENCE</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC436'><br/></div><div class='line' id='LC437'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ACCOMODATION_has_PREFERENCE</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC438'>&nbsp;&nbsp;<span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC439'>&nbsp;&nbsp;<span class="o">`</span><span class="n">pref_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC440'>&nbsp;&nbsp;<span class="o">`</span><span class="n">value</span><span class="o">`</span> <span class="n">TINYINT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC441'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">pref_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC442'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_acc_id</span><span class="o">`</span></div><div class='line' id='LC443'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC444'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC445'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC446'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">,</span></div><div class='line' id='LC447'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_pref_id</span><span class="o">`</span></div><div class='line' id='LC448'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">pref_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC449'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">PREFERENCE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">pref_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC450'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">RESTRICT</span></div><div class='line' id='LC451'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">)</span></div><div class='line' id='LC452'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC453'><br/></div><div class='line' id='LC454'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_pref_id</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">ACCOMODATION_has_PREFERENCE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">pref_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC455'><br/></div><div class='line' id='LC456'><br/></div><div class='line' id='LC457'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC458'><span class="c1">-- Table `ROOMATE`</span></div><div class='line' id='LC459'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC460'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ROOMATE</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC461'><br/></div><div class='line' id='LC462'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ROOMATE</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC463'>&nbsp;&nbsp;<span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC464'>&nbsp;&nbsp;<span class="o">`</span><span class="n">is_owner</span><span class="o">`</span> <span class="n">TINYINT</span><span class="p">(</span><span class="mi">1</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="k">DEFAULT</span> <span class="mi">0</span> <span class="p">,</span></div><div class='line' id='LC465'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC466'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ROOMATE_USER1</span><span class="o">`</span></div><div class='line' id='LC467'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC468'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="k">USER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC469'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC470'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">)</span></div><div class='line' id='LC471'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC472'><br/></div><div class='line' id='LC473'><br/></div><div class='line' id='LC474'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC475'><span class="c1">-- Table `LOOKER`</span></div><div class='line' id='LC476'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC477'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">LOOKER</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC478'><br/></div><div class='line' id='LC479'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">LOOKER</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC480'>&nbsp;&nbsp;<span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC481'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC482'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_LOOKER_USER1</span><span class="o">`</span></div><div class='line' id='LC483'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC484'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="k">USER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC485'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC486'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">)</span></div><div class='line' id='LC487'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC488'><span class="k">COMMENT</span> <span class="o">=</span> <span class="s1">&#39;A person looking for accomodation.&#39;</span><span class="p">;</span></div><div class='line' id='LC489'><br/></div><div class='line' id='LC490'><br/></div><div class='line' id='LC491'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC492'><span class="c1">-- Table `AGENT`</span></div><div class='line' id='LC493'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC494'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">AGENT</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC495'><br/></div><div class='line' id='LC496'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">AGENT</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC497'>&nbsp;&nbsp;<span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC498'>&nbsp;&nbsp;<span class="o">`</span><span class="n">agancy_name</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">100</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC499'>&nbsp;&nbsp;<span class="o">`</span><span class="n">addr_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC500'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC501'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_AGENT_USER1</span><span class="o">`</span></div><div class='line' id='LC502'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC503'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="k">USER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC504'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC505'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">,</span></div><div class='line' id='LC506'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_AGENT_ADDRESS1</span><span class="o">`</span></div><div class='line' id='LC507'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">addr_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC508'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ADDRESS</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">addr_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC509'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">RESTRICT</span></div><div class='line' id='LC510'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">)</span></div><div class='line' id='LC511'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC512'><br/></div><div class='line' id='LC513'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_AGENT_ADDRESS1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">AGENT</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">addr_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC514'><br/></div><div class='line' id='LC515'><br/></div><div class='line' id='LC516'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC517'><span class="c1">-- Table `CHARACTERISTIC`</span></div><div class='line' id='LC518'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC519'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">CHARACTERISTIC</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC520'><br/></div><div class='line' id='LC521'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">CHARACTERISTIC</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC522'>&nbsp;&nbsp;<span class="o">`</span><span class="n">charac_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC523'>&nbsp;&nbsp;<span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">45</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC524'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">charac_id</span><span class="o">`</span><span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC525'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC526'><br/></div><div class='line' id='LC527'><span class="k">CREATE</span> <span class="k">UNIQUE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">name_UNIQUE</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">CHARACTERISTIC</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC528'><br/></div><div class='line' id='LC529'><br/></div><div class='line' id='LC530'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC531'><span class="c1">-- Table `OWNER`</span></div><div class='line' id='LC532'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC533'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="k">OWNER</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC534'><br/></div><div class='line' id='LC535'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="k">OWNER</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC536'>&nbsp;&nbsp;<span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC537'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC538'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_OWNER_USER1</span><span class="o">`</span></div><div class='line' id='LC539'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC540'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="k">USER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC541'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC542'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">)</span></div><div class='line' id='LC543'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC544'><br/></div><div class='line' id='LC545'><br/></div><div class='line' id='LC546'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC547'><span class="c1">-- Table `LOOKER_has_CHARACTERISTIC`</span></div><div class='line' id='LC548'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC549'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">LOOKER_has_CHARACTERISTIC</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC550'><br/></div><div class='line' id='LC551'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">LOOKER_has_CHARACTERISTIC</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC552'>&nbsp;&nbsp;<span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC553'>&nbsp;&nbsp;<span class="o">`</span><span class="n">charac_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC554'>&nbsp;&nbsp;<span class="o">`</span><span class="n">value</span><span class="o">`</span> <span class="n">TINYINT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC555'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">charac_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC556'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_LOOKER_has_CHARACTERISTIC_LOOKER1</span><span class="o">`</span></div><div class='line' id='LC557'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC558'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">LOOKER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC559'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC560'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">,</span></div><div class='line' id='LC561'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_LOOKER_has_CHARACTERISTIC_CHARACTERISTIC1</span><span class="o">`</span></div><div class='line' id='LC562'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">charac_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC563'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">CHARACTERISTIC</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">charac_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC564'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC565'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">)</span></div><div class='line' id='LC566'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC567'><span class="n">PACK_KEYS</span> <span class="o">=</span> <span class="k">DEFAULT</span><span class="p">;</span></div><div class='line' id='LC568'><br/></div><div class='line' id='LC569'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_LOOKER_has_CHARACTERISTIC_CHARACTERISTIC1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">LOOKER_has_CHARACTERISTIC</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">charac_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC570'><br/></div><div class='line' id='LC571'><br/></div><div class='line' id='LC572'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC573'><span class="c1">-- Table `ROOMATE_has_CHARACTERISTIC`</span></div><div class='line' id='LC574'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC575'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ROOMATE_has_CHARACTERISTIC</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC576'><br/></div><div class='line' id='LC577'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">ROOMATE_has_CHARACTERISTIC</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC578'>&nbsp;&nbsp;<span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC579'>&nbsp;&nbsp;<span class="o">`</span><span class="n">charac_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC580'>&nbsp;&nbsp;<span class="o">`</span><span class="n">value</span><span class="o">`</span> <span class="n">TINYINT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC581'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">charac_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC582'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ROOMATE_has_CHARACTERISTIC_ROOMATE1</span><span class="o">`</span></div><div class='line' id='LC583'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC584'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ROOMATE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC585'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC586'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">,</span></div><div class='line' id='LC587'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_ROOMATE_has_CHARACTERISTIC_CHARACTERISTIC1</span><span class="o">`</span></div><div class='line' id='LC588'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">charac_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC589'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">CHARACTERISTIC</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">charac_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC590'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC591'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">)</span></div><div class='line' id='LC592'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC593'><br/></div><div class='line' id='LC594'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_ROOMATE_has_CHARACTERISTIC_CHARACTERISTIC1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">ROOMATE_has_CHARACTERISTIC</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">charac_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC595'><br/></div><div class='line' id='LC596'><br/></div><div class='line' id='LC597'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC598'><span class="c1">-- Table `WANTED_ACCOMMODATION`</span></div><div class='line' id='LC599'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC600'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">WANTED_ACCOMMODATION</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC601'><br/></div><div class='line' id='LC602'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">WANTED_ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC603'>&nbsp;&nbsp;<span class="o">`</span><span class="n">wanted_acc_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC604'>&nbsp;&nbsp;<span class="o">`</span><span class="n">max_price</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC605'>&nbsp;&nbsp;<span class="o">`</span><span class="n">acc_type_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC606'>&nbsp;&nbsp;<span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC607'>&nbsp;&nbsp;<span class="o">`</span><span class="n">title</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">255</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC608'>&nbsp;&nbsp;<span class="o">`</span><span class="n">description</span><span class="o">`</span> <span class="nb">TEXT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC609'>&nbsp;&nbsp;<span class="o">`</span><span class="n">city_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC610'>&nbsp;&nbsp;<span class="o">`</span><span class="n">created</span><span class="o">`</span> <span class="k">TIMESTAMP</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC611'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">wanted_acc_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC612'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_WANTED_ACCOMMODATION_LOOKER1</span><span class="o">`</span></div><div class='line' id='LC613'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC614'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">LOOKER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC615'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC616'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">,</span></div><div class='line' id='LC617'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_WANTED_ACCOMMODATION_CITY1</span><span class="o">`</span></div><div class='line' id='LC618'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC619'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">CITY</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC620'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">RESTRICT</span></div><div class='line' id='LC621'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">)</span></div><div class='line' id='LC622'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC623'><br/></div><div class='line' id='LC624'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_WANTED_ACCOMMODATION_LOOKER1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">WANTED_ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC625'><br/></div><div class='line' id='LC626'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_WANTED_ACCOMMODATION_CITY1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">WANTED_ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC627'><br/></div><div class='line' id='LC628'><br/></div><div class='line' id='LC629'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC630'><span class="c1">-- Table `SHARED`</span></div><div class='line' id='LC631'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC632'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">SHARED</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC633'><br/></div><div class='line' id='LC634'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">SHARED</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC635'>&nbsp;&nbsp;<span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC636'>&nbsp;&nbsp;<span class="o">`</span><span class="n">roomates_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC637'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC638'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_BED_ACCOMODATION10</span><span class="o">`</span></div><div class='line' id='LC639'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC640'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC641'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC642'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">,</span></div><div class='line' id='LC643'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_BED_ROOMATES10</span><span class="o">`</span></div><div class='line' id='LC644'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">roomates_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC645'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ROOMATES</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">roomates_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC646'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">RESTRICT</span></div><div class='line' id='LC647'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">)</span></div><div class='line' id='LC648'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC649'><br/></div><div class='line' id='LC650'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_BED_ROOMATES1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">SHARED</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">roomates_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC651'><br/></div><div class='line' id='LC652'><br/></div><div class='line' id='LC653'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC654'><span class="c1">-- Table `AUTH_PROVIDER`</span></div><div class='line' id='LC655'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC656'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">AUTH_PROVIDER</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC657'><br/></div><div class='line' id='LC658'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">AUTH_PROVIDER</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC659'>&nbsp;&nbsp;<span class="o">`</span><span class="k">key</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">255</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC660'>&nbsp;&nbsp;<span class="o">`</span><span class="n">provider_type</span><span class="o">`</span> <span class="n">ENUM</span><span class="p">(</span><span class="s1">&#39;google&#39;</span><span class="p">,</span><span class="s1">&#39;myopenid&#39;</span><span class="p">,</span><span class="s1">&#39;yahoo&#39;</span><span class="p">,</span><span class="s1">&#39;facebook&#39;</span><span class="p">,</span><span class="s1">&#39;twitter&#39;</span><span class="p">,</span><span class="s1">&#39;openid&#39;</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC661'>&nbsp;&nbsp;<span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC662'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="k">key</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">user_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC663'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_AUTH_PROVIDER_USER1</span><span class="o">`</span></div><div class='line' id='LC664'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC665'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="k">USER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC666'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC667'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">)</span></div><div class='line' id='LC668'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC669'><br/></div><div class='line' id='LC670'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_AUTH_PROVIDER_USER1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">AUTH_PROVIDER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC671'><br/></div><div class='line' id='LC672'><br/></div><div class='line' id='LC673'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC674'><span class="c1">-- Table `PASSWORD`</span></div><div class='line' id='LC675'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC676'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">PASSWORD</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC677'><br/></div><div class='line' id='LC678'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">PASSWORD</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC679'>&nbsp;&nbsp;<span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC680'>&nbsp;&nbsp;<span class="o">`</span><span class="n">password</span><span class="o">`</span> <span class="nb">VARCHAR</span><span class="p">(</span><span class="mi">65</span><span class="p">)</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC681'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC682'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_PASSWORD_USER1</span><span class="o">`</span></div><div class='line' id='LC683'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC684'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="k">USER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC685'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC686'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">CASCADE</span><span class="p">)</span></div><div class='line' id='LC687'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span></div><div class='line' id='LC688'><span class="k">DEFAULT</span> <span class="nb">CHARACTER</span> <span class="k">SET</span> <span class="o">=</span> <span class="n">utf8</span></div><div class='line' id='LC689'><span class="k">COLLATE</span> <span class="o">=</span> <span class="n">utf8_polish_ci</span><span class="p">;</span></div><div class='line' id='LC690'><br/></div><div class='line' id='LC691'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_PASSWORD_USER1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">PASSWORD</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC692'><br/></div><div class='line' id='LC693'><br/></div><div class='line' id='LC694'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC695'><span class="c1">-- Table `VIEWS_COUNTER`</span></div><div class='line' id='LC696'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC697'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEWS_COUNTER</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC698'><br/></div><div class='line' id='LC699'><span class="k">CREATE</span>  <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEWS_COUNTER</span><span class="o">`</span> <span class="p">(</span></div><div class='line' id='LC700'>&nbsp;&nbsp;<span class="o">`</span><span class="n">views_counter_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="n">AUTO_INCREMENT</span> <span class="p">,</span></div><div class='line' id='LC701'>&nbsp;&nbsp;<span class="o">`</span><span class="n">remote_ip</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC702'>&nbsp;&nbsp;<span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span> <span class="n">UNSIGNED</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC703'>&nbsp;&nbsp;<span class="o">`</span><span class="n">created</span><span class="o">`</span> <span class="k">TIMESTAMP</span> <span class="k">NOT</span> <span class="k">NULL</span> <span class="p">,</span></div><div class='line' id='LC704'>&nbsp;&nbsp;<span class="k">PRIMARY</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">views_counter_id</span><span class="o">`</span><span class="p">)</span> <span class="p">,</span></div><div class='line' id='LC705'>&nbsp;&nbsp;<span class="k">CONSTRAINT</span> <span class="o">`</span><span class="n">fk_VIEWS_COUNTER_ACCOMMODATION1</span><span class="o">`</span></div><div class='line' id='LC706'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">FOREIGN</span> <span class="k">KEY</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC707'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">REFERENCES</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="p">)</span></div><div class='line' id='LC708'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">DELETE</span> <span class="k">CASCADE</span></div><div class='line' id='LC709'>&nbsp;&nbsp;&nbsp;&nbsp;<span class="k">ON</span> <span class="k">UPDATE</span> <span class="k">NO</span> <span class="n">ACTION</span><span class="p">)</span></div><div class='line' id='LC710'><span class="n">ENGINE</span> <span class="o">=</span> <span class="n">InnoDB</span><span class="p">;</span></div><div class='line' id='LC711'><br/></div><div class='line' id='LC712'><span class="k">CREATE</span> <span class="k">INDEX</span> <span class="o">`</span><span class="n">fk_VIEWS_COUNTER_ACCOMMODATION1</span><span class="o">`</span> <span class="k">ON</span> <span class="o">`</span><span class="n">VIEWS_COUNTER</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="k">ASC</span><span class="p">)</span> <span class="p">;</span></div><div class='line' id='LC713'><br/></div><div class='line' id='LC714'><br/></div><div class='line' id='LC715'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC716'><span class="c1">-- Placeholder table for view `VIEW_CITY`</span></div><div class='line' id='LC717'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC718'><span class="k">CREATE</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_CITY</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">city_name</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">state_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">state_name</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">lat</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">lng</span><span class="o">`</span> <span class="nb">INT</span><span class="p">);</span></div><div class='line' id='LC719'><br/></div><div class='line' id='LC720'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC721'><span class="c1">-- Placeholder table for view `VIEW_ADDRESS`</span></div><div class='line' id='LC722'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC723'><span class="k">CREATE</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ADDRESS</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">unit_no</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">street_no</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">city_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">zip_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">street_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">state_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">marker_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">street</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">zip</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">city</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="k">state</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">lat</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">lng</span><span class="o">`</span> <span class="nb">INT</span><span class="p">);</span></div><div class='line' id='LC724'><br/></div><div class='line' id='LC725'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC726'><span class="c1">-- Placeholder table for view `VIEW_SHARE`</span></div><div class='line' id='LC727'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC728'><span class="k">CREATE</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_SHARE</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">roomates_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">);</span></div><div class='line' id='LC729'><br/></div><div class='line' id='LC730'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC731'><span class="c1">-- Placeholder table for view `VIEW_PHOTO`</span></div><div class='line' id='LC732'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC733'><span class="k">CREATE</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_PHOTO</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">photo_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">filename</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">path_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">path</span><span class="o">`</span> <span class="nb">INT</span><span class="p">);</span></div><div class='line' id='LC734'><br/></div><div class='line' id='LC735'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC736'><span class="c1">-- Placeholder table for view `VIEW_ACC_FEATURES`</span></div><div class='line' id='LC737'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC738'><span class="k">CREATE</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ACC_FEATURES</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">feat_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">value</span><span class="o">`</span> <span class="nb">INT</span><span class="p">);</span></div><div class='line' id='LC739'><br/></div><div class='line' id='LC740'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC741'><span class="c1">-- Placeholder table for view `VIEW_ACC_PREFERENCES`</span></div><div class='line' id='LC742'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC743'><span class="k">CREATE</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ACC_PREFERENCES</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">pref_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">value</span><span class="o">`</span> <span class="nb">INT</span><span class="p">);</span></div><div class='line' id='LC744'><br/></div><div class='line' id='LC745'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC746'><span class="c1">-- Placeholder table for view `VIEW_ACCOMMODATION`</span></div><div class='line' id='LC747'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC748'><span class="k">CREATE</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ACCOMMODATION</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="n">first_name</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">last_name</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">acc_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">title</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">description</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">addr_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">date_avaliable</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">price</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">created</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">bond</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">street_address_public</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">short_term_ok</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">type_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">is_enabled</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">price_info</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">queries_counter</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">features_info</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">preferences_info</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">feat_name</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">pref_name</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">filename</span><span class="o">`</span> <span class="nb">INT</span><span class="p">);</span></div><div class='line' id='LC749'><br/></div><div class='line' id='LC750'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC751'><span class="c1">-- Placeholder table for view `VIEW_USER_FOR_AUTH`</span></div><div class='line' id='LC752'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC753'><span class="k">CREATE</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">NOT</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_USER_FOR_AUTH</span><span class="o">`</span> <span class="p">(</span><span class="o">`</span><span class="k">key</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">provider_type</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">user_id</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">password</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">email</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">phone</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">phone_public</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">created</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">first_name</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">last_name</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">last_name_public</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="k">type</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">is_enabled</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">privilage</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">description</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">email_public</span><span class="o">`</span> <span class="nb">INT</span><span class="p">,</span> <span class="o">`</span><span class="n">nickname</span><span class="o">`</span> <span class="nb">INT</span><span class="p">);</span></div><div class='line' id='LC754'><br/></div><div class='line' id='LC755'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC756'><span class="c1">-- View `VIEW_CITY`</span></div><div class='line' id='LC757'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC758'><span class="k">DROP</span> <span class="k">VIEW</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_CITY</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC759'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_CITY</span><span class="o">`</span><span class="p">;</span></div><div class='line' id='LC760'><span class="k">DELIMITER</span> <span class="err">$$</span></div><div class='line' id='LC761'><span class="k">CREATE</span>  <span class="k">OR</span> <span class="k">REPLACE</span> <span class="k">VIEW</span> <span class="o">`</span><span class="n">VIEW_CITY</span><span class="o">`</span> <span class="k">AS</span></div><div class='line' id='LC762'><span class="k">SELECT</span> <span class="k">c</span><span class="p">.</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span><span class="p">,</span>  <span class="k">c</span><span class="p">.</span><span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="k">as</span> <span class="o">`</span><span class="n">city_name</span><span class="o">`</span><span class="p">,</span> <span class="k">c</span><span class="p">.</span><span class="o">`</span><span class="n">state_id</span><span class="o">`</span><span class="p">,</span> <span class="n">s</span><span class="p">.</span><span class="o">`</span><span class="n">name</span><span class="o">`</span> <span class="k">as</span> <span class="o">`</span><span class="n">state_name</span><span class="o">`</span><span class="p">,</span> <span class="n">m</span><span class="p">.</span><span class="n">lat</span> <span class="k">as</span> <span class="n">lat</span><span class="p">,</span> <span class="n">m</span><span class="p">.</span><span class="n">lng</span> <span class="k">as</span> <span class="n">lng</span></div><div class='line' id='LC763'><span class="k">FROM</span> <span class="o">`</span><span class="n">CITY</span><span class="o">`</span> <span class="k">c</span> </div><div class='line' id='LC764'><span class="k">INNER</span> <span class="k">JOIN</span> <span class="o">`</span><span class="k">STATE</span><span class="o">`</span> <span class="n">s</span> <span class="k">USING</span> <span class="p">(</span><span class="o">`</span><span class="n">state_id</span><span class="o">`</span><span class="p">)</span></div><div class='line' id='LC765'><span class="k">LEFT</span> <span class="k">JOIN</span> <span class="o">`</span><span class="n">MARKER</span><span class="o">`</span> <span class="n">m</span> <span class="k">ON</span>  <span class="k">c</span><span class="p">.</span><span class="n">marker_id</span> <span class="o">=</span> <span class="n">m</span><span class="p">.</span><span class="n">marker_id</span><span class="p">;</span></div><div class='line' id='LC766'><span class="err">$$</span></div><div class='line' id='LC767'><span class="k">DELIMITER</span> <span class="p">;</span></div><div class='line' id='LC768'><br/></div><div class='line' id='LC769'><span class="p">;</span></div><div class='line' id='LC770'><br/></div><div class='line' id='LC771'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC772'><span class="c1">-- View `VIEW_ADDRESS`</span></div><div class='line' id='LC773'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC774'><span class="k">DROP</span> <span class="k">VIEW</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ADDRESS</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC775'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ADDRESS</span><span class="o">`</span><span class="p">;</span></div><div class='line' id='LC776'><span class="k">DELIMITER</span> <span class="err">$$</span></div><div class='line' id='LC777'><span class="k">CREATE</span>  <span class="k">OR</span> <span class="k">REPLACE</span> <span class="k">VIEW</span> <span class="o">`</span><span class="n">VIEW_ADDRESS</span><span class="o">`</span> <span class="k">AS</span> </div><div class='line' id='LC778'><span class="k">SELECT</span> <span class="n">a</span><span class="p">.</span><span class="n">addr_id</span> <span class="k">as</span> <span class="n">id</span><span class="p">,</span> <span class="n">a</span><span class="p">.</span><span class="n">unit_no</span><span class="p">,</span> <span class="n">a</span><span class="p">.</span><span class="n">street_no</span><span class="p">,</span> <span class="n">a</span><span class="p">.</span><span class="n">city_id</span><span class="p">,</span> <span class="n">a</span><span class="p">.</span><span class="n">zip_id</span><span class="p">,</span> <span class="n">a</span><span class="p">.</span><span class="n">street_id</span><span class="p">,</span> <span class="n">st</span><span class="p">.</span><span class="n">state_id</span><span class="p">,</span> <span class="n">a</span><span class="p">.</span><span class="n">marker_id</span><span class="p">,</span> <span class="n">s</span><span class="p">.</span><span class="n">name</span> <span class="k">as</span> <span class="n">street</span><span class="p">,</span> <span class="n">z</span><span class="p">.</span><span class="n">value</span> <span class="k">as</span> <span class="n">zip</span><span class="p">,</span> <span class="k">c</span><span class="p">.</span><span class="n">name</span> <span class="k">as</span> <span class="n">city</span><span class="p">,</span> <span class="n">st</span><span class="p">.</span><span class="n">name</span> <span class="k">as</span> <span class="k">state</span><span class="p">,</span> <span class="n">m</span><span class="p">.</span><span class="n">lat</span> <span class="k">as</span> <span class="n">lat</span><span class="p">,</span> <span class="n">m</span><span class="p">.</span><span class="n">lng</span> <span class="k">as</span> <span class="n">lng</span> <span class="k">FROM</span> <span class="o">`</span><span class="n">ADDRESS</span><span class="o">`</span> <span class="n">a</span></div><div class='line' id='LC779'><span class="k">INNER</span> <span class="k">JOIN</span> <span class="p">(</span><span class="o">`</span><span class="n">STREET</span><span class="o">`</span> <span class="n">s</span><span class="p">,</span>  <span class="o">`</span><span class="n">CITY</span><span class="o">`</span> <span class="k">c</span><span class="p">)</span> <span class="k">USING</span> <span class="p">(</span><span class="o">`</span><span class="n">street_id</span><span class="o">`</span><span class="p">,</span>  <span class="o">`</span><span class="n">city_id</span><span class="o">`</span><span class="p">)</span></div><div class='line' id='LC780'><span class="k">INNER</span> <span class="k">JOIN</span> <span class="o">`</span><span class="k">STATE</span><span class="o">`</span> <span class="n">st</span> <span class="k">ON</span> <span class="k">c</span><span class="p">.</span><span class="n">state_id</span> <span class="o">=</span> <span class="n">st</span><span class="p">.</span><span class="n">state_id</span></div><div class='line' id='LC781'><span class="k">LEFT</span> <span class="k">JOIN</span> <span class="o">`</span><span class="n">ZIP</span><span class="o">`</span> <span class="n">z</span> <span class="k">ON</span>  <span class="n">a</span><span class="p">.</span><span class="n">zip_id</span> <span class="o">=</span> <span class="n">z</span><span class="p">.</span><span class="n">zip_id</span></div><div class='line' id='LC782'><span class="k">LEFT</span> <span class="k">JOIN</span> <span class="o">`</span><span class="n">MARKER</span><span class="o">`</span> <span class="n">m</span> <span class="k">ON</span>  <span class="n">a</span><span class="p">.</span><span class="n">marker_id</span> <span class="o">=</span> <span class="n">m</span><span class="p">.</span><span class="n">marker_id</span></div><div class='line' id='LC783'><br/></div><div class='line' id='LC784'><br/></div><div class='line' id='LC785'><br/></div><div class='line' id='LC786'><span class="err">$$</span></div><div class='line' id='LC787'><span class="k">DELIMITER</span> <span class="p">;</span></div><div class='line' id='LC788'><br/></div><div class='line' id='LC789'><span class="p">;</span></div><div class='line' id='LC790'><br/></div><div class='line' id='LC791'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC792'><span class="c1">-- View `VIEW_SHARE`</span></div><div class='line' id='LC793'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC794'><span class="k">DROP</span> <span class="k">VIEW</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_SHARE</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC795'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_SHARE</span><span class="o">`</span><span class="p">;</span></div><div class='line' id='LC796'><span class="k">DELIMITER</span> <span class="err">$$</span></div><div class='line' id='LC797'><span class="k">CREATE</span>  <span class="k">OR</span> <span class="k">REPLACE</span> <span class="k">VIEW</span> <span class="o">`</span><span class="n">VIEW_SHARE</span><span class="o">`</span> <span class="k">AS</span></div><div class='line' id='LC798'><span class="k">SELECT</span> <span class="n">s</span><span class="p">.</span><span class="o">*</span> <span class="k">FROM</span> <span class="o">`</span><span class="n">SHARED</span><span class="o">`</span> <span class="n">s</span></div><div class='line' id='LC799'><span class="k">INNER</span> <span class="k">JOIN</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="k">USING</span> <span class="p">(</span><span class="o">`</span><span class="n">acc_id</span><span class="o">`</span><span class="p">)</span></div><div class='line' id='LC800'><span class="k">INNER</span> <span class="k">JOIN</span> <span class="o">`</span><span class="n">ROOMATES</span><span class="o">`</span> <span class="k">USING</span> <span class="p">(</span><span class="o">`</span><span class="n">roomates_id</span><span class="o">`</span><span class="p">)</span></div><div class='line' id='LC801'><br/></div><div class='line' id='LC802'><span class="err">$$</span></div><div class='line' id='LC803'><span class="k">DELIMITER</span> <span class="p">;</span></div><div class='line' id='LC804'><br/></div><div class='line' id='LC805'><span class="p">;</span></div><div class='line' id='LC806'><br/></div><div class='line' id='LC807'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC808'><span class="c1">-- View `VIEW_PHOTO`</span></div><div class='line' id='LC809'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC810'><span class="k">DROP</span> <span class="k">VIEW</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_PHOTO</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC811'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_PHOTO</span><span class="o">`</span><span class="p">;</span></div><div class='line' id='LC812'><span class="k">DELIMITER</span> <span class="err">$$</span></div><div class='line' id='LC813'><span class="k">CREATE</span>  <span class="k">OR</span> <span class="k">REPLACE</span> <span class="k">VIEW</span> <span class="o">`</span><span class="n">VIEW_PHOTO</span><span class="o">`</span> <span class="k">AS</span> </div><div class='line' id='LC814'><span class="k">SELECT</span> <span class="n">p</span><span class="p">.</span><span class="n">photo_id</span><span class="p">,</span> <span class="n">p</span><span class="p">.</span><span class="n">filename</span><span class="p">,</span> <span class="n">p</span><span class="p">.</span><span class="n">acc_id</span><span class="p">,</span> <span class="n">pa</span><span class="p">.</span><span class="n">path_id</span><span class="p">,</span> <span class="n">pa</span><span class="p">.</span><span class="n">value</span> <span class="k">as</span> <span class="n">path</span> <span class="k">FROM</span> <span class="o">`</span><span class="n">PHOTO</span><span class="o">`</span> <span class="n">p</span></div><div class='line' id='LC815'><span class="k">INNER</span> <span class="k">JOIN</span> <span class="p">(</span><span class="o">`</span><span class="n">PATH</span><span class="o">`</span> <span class="n">pa</span><span class="p">)</span> <span class="k">USING</span> <span class="p">(</span><span class="o">`</span><span class="n">path_id</span><span class="o">`</span><span class="p">)</span></div><div class='line' id='LC816'><br/></div><div class='line' id='LC817'><span class="err">$$</span></div><div class='line' id='LC818'><span class="k">DELIMITER</span> <span class="p">;</span></div><div class='line' id='LC819'><br/></div><div class='line' id='LC820'><span class="p">;</span></div><div class='line' id='LC821'><br/></div><div class='line' id='LC822'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC823'><span class="c1">-- View `VIEW_ACC_FEATURES`</span></div><div class='line' id='LC824'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC825'><span class="k">DROP</span> <span class="k">VIEW</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ACC_FEATURES</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC826'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ACC_FEATURES</span><span class="o">`</span><span class="p">;</span></div><div class='line' id='LC827'><span class="k">DELIMITER</span> <span class="err">$$</span></div><div class='line' id='LC828'><span class="k">CREATE</span>  <span class="k">OR</span> <span class="k">REPLACE</span> <span class="k">VIEW</span> <span class="o">`</span><span class="n">VIEW_ACC_FEATURES</span><span class="o">`</span> <span class="k">AS</span></div><div class='line' id='LC829'><span class="k">SELECT</span> <span class="n">af</span><span class="p">.</span><span class="n">acc_id</span><span class="p">,</span> <span class="n">f</span><span class="p">.</span><span class="n">feat_id</span><span class="p">,</span> <span class="n">f</span><span class="p">.</span><span class="n">name</span><span class="p">,</span> <span class="n">af</span><span class="p">.</span><span class="n">value</span>  </div><div class='line' id='LC830'><span class="k">FROM</span> <span class="o">`</span><span class="n">ACCOMODATION_has_FEATURE</span><span class="o">`</span> <span class="n">af</span> <span class="k">INNER</span> <span class="k">JOIN</span> <span class="o">`</span><span class="n">FEATURE</span><span class="o">`</span> <span class="n">f</span> <span class="k">USING</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">)</span> </div><div class='line' id='LC831'><br/></div><div class='line' id='LC832'><br/></div><div class='line' id='LC833'><span class="err">$$</span></div><div class='line' id='LC834'><span class="k">DELIMITER</span> <span class="p">;</span></div><div class='line' id='LC835'><br/></div><div class='line' id='LC836'><span class="p">;</span></div><div class='line' id='LC837'><br/></div><div class='line' id='LC838'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC839'><span class="c1">-- View `VIEW_ACC_PREFERENCES`</span></div><div class='line' id='LC840'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC841'><span class="k">DROP</span> <span class="k">VIEW</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ACC_PREFERENCES</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC842'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ACC_PREFERENCES</span><span class="o">`</span><span class="p">;</span></div><div class='line' id='LC843'><span class="k">DELIMITER</span> <span class="err">$$</span></div><div class='line' id='LC844'><span class="k">CREATE</span>  <span class="k">OR</span> <span class="k">REPLACE</span> <span class="k">VIEW</span> <span class="o">`</span><span class="n">VIEW_ACC_PREFERENCES</span><span class="o">`</span> <span class="k">AS</span></div><div class='line' id='LC845'><span class="k">SELECT</span> <span class="n">ap</span><span class="p">.</span><span class="n">acc_id</span><span class="p">,</span> <span class="n">p</span><span class="p">.</span><span class="n">pref_id</span><span class="p">,</span> <span class="n">p</span><span class="p">.</span><span class="n">name</span><span class="p">,</span> <span class="n">ap</span><span class="p">.</span><span class="n">value</span>  </div><div class='line' id='LC846'><span class="k">FROM</span> <span class="o">`</span><span class="n">ACCOMODATION_has_PREFERENCE</span><span class="o">`</span> <span class="n">ap</span> <span class="k">INNER</span> <span class="k">JOIN</span> <span class="o">`</span><span class="n">PREFERENCE</span><span class="o">`</span> <span class="n">p</span> <span class="k">USING</span> <span class="p">(</span><span class="o">`</span><span class="n">pref_id</span><span class="o">`</span><span class="p">)</span> </div><div class='line' id='LC847'><br/></div><div class='line' id='LC848'><br/></div><div class='line' id='LC849'><span class="err">$$</span></div><div class='line' id='LC850'><span class="k">DELIMITER</span> <span class="p">;</span></div><div class='line' id='LC851'><br/></div><div class='line' id='LC852'><span class="p">;</span></div><div class='line' id='LC853'><br/></div><div class='line' id='LC854'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC855'><span class="c1">-- View `VIEW_ACCOMMODATION`</span></div><div class='line' id='LC856'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC857'><span class="k">DROP</span> <span class="k">VIEW</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ACCOMMODATION</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC858'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_ACCOMMODATION</span><span class="o">`</span><span class="p">;</span></div><div class='line' id='LC859'><span class="k">DELIMITER</span> <span class="err">$$</span></div><div class='line' id='LC860'><span class="k">CREATE</span>  <span class="k">OR</span> <span class="k">REPLACE</span> <span class="k">VIEW</span> <span class="o">`</span><span class="n">VIEW_ACCOMMODATION</span><span class="o">`</span> <span class="k">as</span></div><div class='line' id='LC861'><span class="k">SElECT</span> <span class="k">user</span><span class="p">.</span><span class="n">first_name</span><span class="p">,</span> <span class="k">user</span><span class="p">.</span><span class="n">last_name</span><span class="p">,</span>  <span class="n">acc</span><span class="p">.</span><span class="o">*</span><span class="p">,</span> <span class="n">ad</span><span class="p">.</span><span class="o">*</span><span class="p">,</span> <span class="n">feat</span><span class="p">.</span><span class="n">name</span> <span class="k">as</span> <span class="n">feat_name</span><span class="p">,</span> <span class="n">pref</span><span class="p">.</span><span class="n">name</span> <span class="k">as</span> <span class="n">pref_name</span><span class="p">,</span> <span class="n">photo</span><span class="p">.</span><span class="n">filename</span> <span class="k">FROM</span> <span class="o">`</span><span class="n">ACCOMMODATION</span><span class="o">`</span> <span class="n">acc</span> <span class="k">INNER</span> <span class="k">JOIN</span> <span class="o">`</span><span class="n">VIEW_ADDRESS</span><span class="o">`</span> <span class="n">ad</span> <span class="k">ON</span> <span class="p">(</span><span class="n">acc</span><span class="p">.</span><span class="n">addr_id</span> <span class="o">=</span> <span class="n">ad</span><span class="p">.</span><span class="n">id</span><span class="p">)</span> </div><div class='line' id='LC862'><span class="k">INNER</span> <span class="k">JOIN</span> <span class="k">USER</span> <span class="k">user</span> <span class="k">using</span> <span class="p">(</span><span class="n">user_id</span><span class="p">)</span></div><div class='line' id='LC863'><span class="k">LEFT</span> <span class="k">JOIN</span> <span class="n">VIEW_ACC_FEATURES</span> <span class="n">feat</span> <span class="k">USING</span> <span class="p">(</span><span class="n">acc_id</span><span class="p">)</span></div><div class='line' id='LC864'><span class="k">LEFT</span> <span class="k">JOIN</span> <span class="n">VIEW_ACC_PREFERENCES</span> <span class="n">pref</span> <span class="k">USING</span> <span class="p">(</span><span class="n">acc_id</span><span class="p">)</span></div><div class='line' id='LC865'><span class="k">LEFT</span> <span class="k">JOIN</span> <span class="n">VIEW_PHOTO</span> <span class="n">photo</span> <span class="k">USING</span> <span class="p">(</span><span class="n">acc_id</span><span class="p">)</span></div><div class='line' id='LC866'><br/></div><div class='line' id='LC867'><span class="err">$$</span></div><div class='line' id='LC868'><span class="k">DELIMITER</span> <span class="p">;</span></div><div class='line' id='LC869'><br/></div><div class='line' id='LC870'><span class="p">;</span></div><div class='line' id='LC871'><br/></div><div class='line' id='LC872'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC873'><span class="c1">-- View `VIEW_USER_FOR_AUTH`</span></div><div class='line' id='LC874'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC875'><span class="k">DROP</span> <span class="k">VIEW</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_USER_FOR_AUTH</span><span class="o">`</span> <span class="p">;</span></div><div class='line' id='LC876'><span class="k">DROP</span> <span class="k">TABLE</span> <span class="n">IF</span> <span class="k">EXISTS</span> <span class="o">`</span><span class="n">VIEW_USER_FOR_AUTH</span><span class="o">`</span><span class="p">;</span></div><div class='line' id='LC877'><span class="k">DELIMITER</span> <span class="err">$$</span></div><div class='line' id='LC878'><span class="k">CREATE</span>  <span class="k">OR</span> <span class="k">REPLACE</span> <span class="k">VIEW</span> <span class="o">`</span><span class="n">VIEW_USER_FOR_AUTH</span><span class="o">`</span> <span class="k">AS</span></div><div class='line' id='LC879'><span class="k">SELECT</span> <span class="o">*</span> <span class="k">FROM</span> <span class="o">`</span><span class="k">USER</span><span class="o">`</span> </div><div class='line' id='LC880'><span class="k">LEFT</span> <span class="k">JOIN</span> <span class="o">`</span><span class="n">PASSWORD</span><span class="o">`</span> <span class="k">USING</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span><span class="p">)</span></div><div class='line' id='LC881'><span class="k">LEFT</span> <span class="k">JOIN</span> <span class="o">`</span><span class="n">AUTH_PROVIDER</span><span class="o">`</span> <span class="k">USING</span> <span class="p">(</span><span class="o">`</span><span class="n">user_id</span><span class="o">`</span><span class="p">)</span></div><div class='line' id='LC882'><br/></div><div class='line' id='LC883'><span class="err">$$</span></div><div class='line' id='LC884'><span class="k">DELIMITER</span> <span class="p">;</span></div><div class='line' id='LC885'><br/></div><div class='line' id='LC886'><span class="p">;</span></div><div class='line' id='LC887'><br/></div><div class='line' id='LC888'><br/></div><div class='line' id='LC889'><span class="k">SET</span> <span class="n">SQL_MODE</span><span class="o">=@</span><span class="n">OLD_SQL_MODE</span><span class="p">;</span></div><div class='line' id='LC890'><span class="k">SET</span> <span class="n">FOREIGN_KEY_CHECKS</span><span class="o">=@</span><span class="n">OLD_FOREIGN_KEY_CHECKS</span><span class="p">;</span></div><div class='line' id='LC891'><span class="k">SET</span> <span class="n">UNIQUE_CHECKS</span><span class="o">=@</span><span class="n">OLD_UNIQUE_CHECKS</span><span class="p">;</span></div><div class='line' id='LC892'><br/></div><div class='line' id='LC893'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC894'><span class="c1">-- Data for table `STATE`</span></div><div class='line' id='LC895'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC896'><span class="k">SET</span> <span class="n">AUTOCOMMIT</span><span class="o">=</span><span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC897'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="k">STATE</span> <span class="p">(</span><span class="o">`</span><span class="n">state_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="k">NULL</span><span class="p">,</span> <span class="s1">&#39;Małopolska&#39;</span><span class="p">);</span></div><div class='line' id='LC898'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="k">STATE</span> <span class="p">(</span><span class="o">`</span><span class="n">state_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="k">NULL</span><span class="p">,</span> <span class="s1">&#39;Dolnośląsk&#39;</span><span class="p">);</span></div><div class='line' id='LC899'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="k">STATE</span> <span class="p">(</span><span class="o">`</span><span class="n">state_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="k">NULL</span><span class="p">,</span> <span class="s1">&#39;Mazowieckie&#39;</span><span class="p">);</span></div><div class='line' id='LC900'><br/></div><div class='line' id='LC901'><span class="k">COMMIT</span><span class="p">;</span></div><div class='line' id='LC902'><br/></div><div class='line' id='LC903'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC904'><span class="c1">-- Data for table `MARKER`</span></div><div class='line' id='LC905'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC906'><span class="k">SET</span> <span class="n">AUTOCOMMIT</span><span class="o">=</span><span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC907'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">MARKER</span> <span class="p">(</span><span class="o">`</span><span class="n">marker_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">lat</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">lng</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">1</span><span class="p">,</span> <span class="mi">51</span><span class="p">.</span><span class="mi">806917</span><span class="p">,</span> <span class="mi">15</span><span class="p">.</span><span class="mi">716629</span><span class="p">);</span></div><div class='line' id='LC908'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">MARKER</span> <span class="p">(</span><span class="o">`</span><span class="n">marker_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">lat</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">lng</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">2</span><span class="p">,</span> <span class="mi">49</span><span class="p">.</span><span class="mi">480059</span><span class="p">,</span> <span class="mi">20</span><span class="p">.</span><span class="mi">032539</span><span class="p">);</span></div><div class='line' id='LC909'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">MARKER</span> <span class="p">(</span><span class="o">`</span><span class="n">marker_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">lat</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">lng</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">3</span><span class="p">,</span> <span class="mi">51</span><span class="p">.</span><span class="mi">117317</span><span class="p">,</span> <span class="mi">17</span><span class="p">.</span><span class="mi">037048</span><span class="p">);</span></div><div class='line' id='LC910'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">MARKER</span> <span class="p">(</span><span class="o">`</span><span class="n">marker_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">lat</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">lng</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">4</span><span class="p">,</span> <span class="mi">50</span><span class="p">.</span><span class="mi">074769</span><span class="p">,</span> <span class="mi">19</span><span class="p">.</span><span class="mi">947739</span><span class="p">);</span></div><div class='line' id='LC911'><br/></div><div class='line' id='LC912'><span class="k">COMMIT</span><span class="p">;</span></div><div class='line' id='LC913'><br/></div><div class='line' id='LC914'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC915'><span class="c1">-- Data for table `CITY`</span></div><div class='line' id='LC916'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC917'><span class="k">SET</span> <span class="n">AUTOCOMMIT</span><span class="o">=</span><span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC918'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">CITY</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">state_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">marker_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">description</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">1</span><span class="p">,</span> <span class="s1">&#39;Wrocław&#39;</span><span class="p">,</span> <span class="mi">2</span><span class="p">,</span> <span class="mi">3</span><span class="p">,</span> <span class="k">NULL</span><span class="p">);</span></div><div class='line' id='LC919'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">CITY</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">state_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">marker_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">description</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">2</span><span class="p">,</span> <span class="s1">&#39;Kraków&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">,</span> <span class="mi">4</span><span class="p">,</span> <span class="k">NULL</span><span class="p">);</span></div><div class='line' id='LC920'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">CITY</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">state_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">marker_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">description</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">3</span><span class="p">,</span> <span class="s1">&#39;Nowy Targ&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">,</span> <span class="mi">2</span><span class="p">,</span> <span class="k">NULL</span><span class="p">);</span></div><div class='line' id='LC921'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">CITY</span> <span class="p">(</span><span class="o">`</span><span class="n">city_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">state_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">marker_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">description</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">4</span><span class="p">,</span> <span class="s1">&#39;Nowa Sól&#39;</span><span class="p">,</span> <span class="mi">2</span><span class="p">,</span> <span class="mi">1</span><span class="p">,</span> <span class="k">NULL</span><span class="p">);</span></div><div class='line' id='LC922'><br/></div><div class='line' id='LC923'><span class="k">COMMIT</span><span class="p">;</span></div><div class='line' id='LC924'><br/></div><div class='line' id='LC925'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC926'><span class="c1">-- Data for table `STREET`</span></div><div class='line' id='LC927'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC928'><span class="k">SET</span> <span class="n">AUTOCOMMIT</span><span class="o">=</span><span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC929'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">STREET</span> <span class="p">(</span><span class="o">`</span><span class="n">street_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">1</span><span class="p">,</span> <span class="s1">&#39;Podtatrzanska&#39;</span><span class="p">);</span></div><div class='line' id='LC930'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">STREET</span> <span class="p">(</span><span class="o">`</span><span class="n">street_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">2</span><span class="p">,</span> <span class="s1">&#39;Wyb. Wyspianskiego&#39;</span><span class="p">);</span></div><div class='line' id='LC931'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">STREET</span> <span class="p">(</span><span class="o">`</span><span class="n">street_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">3</span><span class="p">,</span> <span class="s1">&#39;Aleja 100 lecia&#39;</span><span class="p">);</span></div><div class='line' id='LC932'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">STREET</span> <span class="p">(</span><span class="o">`</span><span class="n">street_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">4</span><span class="p">,</span> <span class="s1">&#39;Plac dominikanski&#39;</span><span class="p">);</span></div><div class='line' id='LC933'><br/></div><div class='line' id='LC934'><span class="k">COMMIT</span><span class="p">;</span></div><div class='line' id='LC935'><br/></div><div class='line' id='LC936'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC937'><span class="c1">-- Data for table `ZIP`</span></div><div class='line' id='LC938'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC939'><span class="k">SET</span> <span class="n">AUTOCOMMIT</span><span class="o">=</span><span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC940'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">ZIP</span> <span class="p">(</span><span class="o">`</span><span class="n">zip_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">value</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">1</span><span class="p">,</span> <span class="s1">&#39;34-400&#39;</span><span class="p">);</span></div><div class='line' id='LC941'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">ZIP</span> <span class="p">(</span><span class="o">`</span><span class="n">zip_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">value</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">2</span><span class="p">,</span> <span class="s1">&#39;55-500&#39;</span><span class="p">);</span></div><div class='line' id='LC942'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">ZIP</span> <span class="p">(</span><span class="o">`</span><span class="n">zip_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">value</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">3</span><span class="p">,</span> <span class="s1">&#39;12-134&#39;</span><span class="p">);</span></div><div class='line' id='LC943'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">ZIP</span> <span class="p">(</span><span class="o">`</span><span class="n">zip_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">value</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">4</span><span class="p">,</span> <span class="s1">&#39;45-132&#39;</span><span class="p">);</span></div><div class='line' id='LC944'><br/></div><div class='line' id='LC945'><span class="k">COMMIT</span><span class="p">;</span></div><div class='line' id='LC946'><br/></div><div class='line' id='LC947'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC948'><span class="c1">-- Data for table `TYPE`</span></div><div class='line' id='LC949'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC950'><span class="k">SET</span> <span class="n">AUTOCOMMIT</span><span class="o">=</span><span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC951'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="k">TYPE</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">is_shared</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">1</span><span class="p">,</span> <span class="s1">&#39;Bed&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">);</span></div><div class='line' id='LC952'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="k">TYPE</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">is_shared</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">2</span><span class="p">,</span> <span class="s1">&#39;Room&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">);</span></div><div class='line' id='LC953'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="k">TYPE</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">is_shared</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">3</span><span class="p">,</span> <span class="s1">&#39;Appartment&#39;</span><span class="p">,</span> <span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC954'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="k">TYPE</span> <span class="p">(</span><span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">is_shared</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">4</span><span class="p">,</span> <span class="s1">&#39;House&#39;</span><span class="p">,</span> <span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC955'><br/></div><div class='line' id='LC956'><span class="k">COMMIT</span><span class="p">;</span></div><div class='line' id='LC957'><br/></div><div class='line' id='LC958'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC959'><span class="c1">-- Data for table `FEATURE`</span></div><div class='line' id='LC960'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC961'><span class="k">SET</span> <span class="n">AUTOCOMMIT</span><span class="o">=</span><span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC962'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">FEATURE</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">1</span><span class="p">,</span> <span class="s1">&#39;internet&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">,</span> <span class="k">NULL</span><span class="p">);</span></div><div class='line' id='LC963'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">FEATURE</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">2</span><span class="p">,</span> <span class="s1">&#39;parking&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">,</span> <span class="k">NULL</span><span class="p">);</span></div><div class='line' id='LC964'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">FEATURE</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">3</span><span class="p">,</span> <span class="s1">&#39;tv&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">,</span> <span class="k">NULL</span><span class="p">);</span></div><div class='line' id='LC965'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">FEATURE</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">4</span><span class="p">,</span> <span class="s1">&#39;furnished&#39;</span><span class="p">,</span> <span class="mi">0</span><span class="p">,</span> <span class="k">NULL</span><span class="p">);</span></div><div class='line' id='LC966'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">FEATURE</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">5</span><span class="p">,</span> <span class="s1">&#39;air conditioning&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">,</span> <span class="k">NULL</span><span class="p">);</span></div><div class='line' id='LC967'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">FEATURE</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">6</span><span class="p">,</span> <span class="s1">&#39;private bath&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">,</span> <span class="mi">2</span><span class="p">);</span></div><div class='line' id='LC968'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">FEATURE</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">7</span><span class="p">,</span> <span class="s1">&#39;private balcony&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">,</span> <span class="mi">2</span><span class="p">);</span></div><div class='line' id='LC969'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">FEATURE</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">8</span><span class="p">,</span> <span class="s1">&#39;no of bedrooms&#39;</span><span class="p">,</span> <span class="mi">0</span><span class="p">,</span> <span class="mi">3</span><span class="p">);</span></div><div class='line' id='LC970'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">FEATURE</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">9</span><span class="p">,</span> <span class="s1">&#39;no of bathrooms&#39;</span><span class="p">,</span> <span class="mi">0</span><span class="p">,</span> <span class="mi">3</span><span class="p">);</span></div><div class='line' id='LC971'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">FEATURE</span> <span class="p">(</span><span class="o">`</span><span class="n">feat_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">type_id</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">10</span><span class="p">,</span> <span class="s1">&#39;no of parking&#39;</span><span class="p">,</span> <span class="mi">0</span><span class="p">,</span> <span class="mi">3</span><span class="p">);</span></div><div class='line' id='LC972'><br/></div><div class='line' id='LC973'><span class="k">COMMIT</span><span class="p">;</span></div><div class='line' id='LC974'><br/></div><div class='line' id='LC975'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC976'><span class="c1">-- Data for table `PREFERENCE`</span></div><div class='line' id='LC977'><span class="c1">-- -----------------------------------------------------</span></div><div class='line' id='LC978'><span class="k">SET</span> <span class="n">AUTOCOMMIT</span><span class="o">=</span><span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC979'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">PREFERENCE</span> <span class="p">(</span><span class="o">`</span><span class="n">pref_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">1</span><span class="p">,</span> <span class="s1">&#39;smokers&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">);</span></div><div class='line' id='LC980'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">PREFERENCE</span> <span class="p">(</span><span class="o">`</span><span class="n">pref_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">2</span><span class="p">,</span> <span class="s1">&#39;kids&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">);</span></div><div class='line' id='LC981'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">PREFERENCE</span> <span class="p">(</span><span class="o">`</span><span class="n">pref_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">3</span><span class="p">,</span> <span class="s1">&#39;couples&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">);</span></div><div class='line' id='LC982'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">PREFERENCE</span> <span class="p">(</span><span class="o">`</span><span class="n">pref_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">4</span><span class="p">,</span> <span class="s1">&#39;pets&#39;</span><span class="p">,</span> <span class="mi">1</span><span class="p">);</span></div><div class='line' id='LC983'><span class="k">INSERT</span> <span class="k">INTO</span> <span class="n">PREFERENCE</span> <span class="p">(</span><span class="o">`</span><span class="n">pref_id</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="n">name</span><span class="o">`</span><span class="p">,</span> <span class="o">`</span><span class="nb">binary</span><span class="o">`</span><span class="p">)</span> <span class="k">VALUES</span> <span class="p">(</span><span class="mi">5</span><span class="p">,</span> <span class="s1">&#39;gender&#39;</span><span class="p">,</span> <span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC984'><br/></div><div class='line' id='LC985'><span class="k">COMMIT</span><span class="p">;</span></div><div class='line' id='LC986'><br/></div></pre></div>
              
            
          </td>
        </tr>
      </table>
    
  </div>


          </div>
        </div>
      </div>
    </div>
  

  </div>


<div class="frame frame-loading" style="display:none;">
  <img src="https://d3nwyuy0nl342s.cloudfront.net/images/modules/ajax/big_spinner_336699.gif" height="32" width="32">
</div>

    </div>
  
      
    </div>

    <div id="footer" class="clearfix">
      <div class="site">
        <div class="sponsor">
          <a href="http://www.rackspace.com" class="logo">
            <img alt="Dedicated Server" height="36" src="https://d3nwyuy0nl342s.cloudfront.net/images/modules/footer/rackspace_logo.png?v2" width="38" />
          </a>
          Powered by the <a href="http://www.rackspace.com ">Dedicated
          Servers</a> and<br/> <a href="http://www.rackspacecloud.com">Cloud
          Computing</a> of Rackspace Hosting<span>&reg;</span>
        </div>

        <ul class="links">
          <li class="blog"><a href="https://github.com/blog">Blog</a></li>
          <li><a href="https://github.com/contact">Support</a></li>
          <li><a href="https://github.com/training">Training</a></li>
          <li><a href="http://jobs.github.com">Job Board</a></li>
          <li><a href="http://shop.github.com">Shop</a></li>
          <li><a href="https://github.com/contact">Contact</a></li>
          <li><a href="http://developer.github.com">API</a></li>
          <li><a href="http://status.github.com">Status</a></li>
        </ul>
        <ul class="sosueme">
          <li class="main">&copy; 2011 <span id="_rrt" title="0.52399s from fe2.rs.github.com">GitHub</span> Inc. All rights reserved.</li>
          <li><a href="/site/terms">Terms of Service</a></li>
          <li><a href="/site/privacy">Privacy</a></li>
          <li><a href="https://github.com/security">Security</a></li>
        </ul>
      </div>
    </div><!-- /#footer -->

    <script>window._auth_token = "7f9ca641aaa2cf13a7744fc1a683d9d75decb6e7"</script>
    

<div id="keyboard_shortcuts_pane" class="instapaper_ignore readability-extra" style="display:none">
  <h2>Keyboard Shortcuts <small><a href="#" class="js-see-all-keyboard-shortcuts">(see all)</a></small></h2>

  <div class="columns threecols">
    <div class="column first">
      <h3>Site wide shortcuts</h3>
      <dl class="keyboard-mappings">
        <dt>s</dt>
        <dd>Focus site search</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>?</dt>
        <dd>Bring up this help dialog</dd>
      </dl>
    </div><!-- /.column.first -->

    <div class="column middle" style='display:none'>
      <h3>Commit list</h3>
      <dl class="keyboard-mappings">
        <dt>j</dt>
        <dd>Move selected down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>k</dt>
        <dd>Move selected up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>t</dt>
        <dd>Open tree</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>p</dt>
        <dd>Open parent</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>c <em>or</em> o <em>or</em> enter</dt>
        <dd>Open commit</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>y</dt>
        <dd>Expand URL to its canonical form</dd>
      </dl>
    </div><!-- /.column.first -->

    <div class="column last" style='display:none'>
      <h3>Pull request list</h3>
      <dl class="keyboard-mappings">
        <dt>j</dt>
        <dd>Move selected down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>k</dt>
        <dd>Move selected up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>o <em>or</em> enter</dt>
        <dd>Open issue</dd>
      </dl>
    </div><!-- /.columns.last -->

  </div><!-- /.columns.equacols -->

  <div style='display:none'>
    <div class="rule"></div>

    <h3>Issues</h3>

    <div class="columns threecols">
      <div class="column first">
        <dl class="keyboard-mappings">
          <dt>j</dt>
          <dd>Move selected down</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>k</dt>
          <dd>Move selected up</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>x</dt>
          <dd>Toggle select target</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>o <em>or</em> enter</dt>
          <dd>Open issue</dd>
        </dl>
      </div><!-- /.column.first -->
      <div class="column middle">
        <dl class="keyboard-mappings">
          <dt>I</dt>
          <dd>Mark selected as read</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>U</dt>
          <dd>Mark selected as unread</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>e</dt>
          <dd>Close selected</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>y</dt>
          <dd>Remove selected from view</dd>
        </dl>
      </div><!-- /.column.middle -->
      <div class="column last">
        <dl class="keyboard-mappings">
          <dt>c</dt>
          <dd>Create issue</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>l</dt>
          <dd>Create label</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>i</dt>
          <dd>Back to inbox</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>u</dt>
          <dd>Back to issues</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>/</dt>
          <dd>Focus issues search</dd>
        </dl>
      </div>
    </div>
  </div>

  <div style='display:none'>
    <div class="rule"></div>

    <h3>Network Graph</h3>
    <div class="columns equacols">
      <div class="column first">
        <dl class="keyboard-mappings">
          <dt><span class="badmono">←</span> <em>or</em> h</dt>
          <dd>Scroll left</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt><span class="badmono">→</span> <em>or</em> l</dt>
          <dd>Scroll right</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt><span class="badmono">↑</span> <em>or</em> k</dt>
          <dd>Scroll up</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt><span class="badmono">↓</span> <em>or</em> j</dt>
          <dd>Scroll down</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>t</dt>
          <dd>Toggle visibility of head labels</dd>
        </dl>
      </div><!-- /.column.first -->
      <div class="column last">
        <dl class="keyboard-mappings">
          <dt>shift <span class="badmono">←</span> <em>or</em> shift h</dt>
          <dd>Scroll all the way left</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>shift <span class="badmono">→</span> <em>or</em> shift l</dt>
          <dd>Scroll all the way right</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>shift <span class="badmono">↑</span> <em>or</em> shift k</dt>
          <dd>Scroll all the way up</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>shift <span class="badmono">↓</span> <em>or</em> shift j</dt>
          <dd>Scroll all the way down</dd>
        </dl>
      </div><!-- /.column.last -->
    </div>
  </div>

  <div >
    <div class="rule"></div>
    <div class="columns threecols">
      <div class="column first" >
        <h3>Source Code Browsing</h3>
        <dl class="keyboard-mappings">
          <dt>t</dt>
          <dd>Activates the file finder</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>l</dt>
          <dd>Jump to line</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>y</dt>
          <dd>Expand URL to its canonical form</dd>
        </dl>
      </div>
    </div>
  </div>
</div>

    

    <!--[if IE 8]>
    <script type="text/javascript" charset="utf-8">
      $(document.body).addClass("ie8")
    </script>
    <![endif]-->

    <!--[if IE 7]>
    <script type="text/javascript" charset="utf-8">
      $(document.body).addClass("ie7")
    </script>
    <![endif]-->

    
    <script type='text/javascript'></script>
    
  </body>
</html>

