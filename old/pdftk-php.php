
    

  

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
        <title>pdftk-php.php at master from andrewheiss/pdftk-php - GitHub</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub" />
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub" />

    <link href="https://d3nwyuy0nl342s.cloudfront.net/54e75cc17c543a91f799e9c3acca29524998d225/stylesheets/bundle_common.css" media="screen" rel="stylesheet" type="text/css" />
<link href="https://d3nwyuy0nl342s.cloudfront.net/54e75cc17c543a91f799e9c3acca29524998d225/stylesheets/bundle_github.css" media="screen" rel="stylesheet" type="text/css" />
    

    <script type="text/javascript">
      if (typeof console == "undefined" || typeof console.log == "undefined")
        console = { log: function() {} }
    </script>
    <script type="text/javascript" charset="utf-8">
      var GitHub = {
        assetHost: 'https://d3nwyuy0nl342s.cloudfront.net'
      }
      var github_user = null
      
    </script>
    <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
    <script src="https://d3nwyuy0nl342s.cloudfront.net/54e75cc17c543a91f799e9c3acca29524998d225/javascripts/bundle_common.js" type="text/javascript"></script>
<script src="https://d3nwyuy0nl342s.cloudfront.net/54e75cc17c543a91f799e9c3acca29524998d225/javascripts/bundle_github.js" type="text/javascript"></script>


    
    <script type="text/javascript" charset="utf-8">
      GitHub.spy({
        repo: "andrewheiss/pdftk-php"
      })
    </script>

    
  <link href="https://github.com/andrewheiss/pdftk-php/commits/master.atom" rel="alternate" title="Recent Commits to pdftk-php:master" type="application/atom+xml" />

        <meta name="description" content="A collection of functions that make it easy to use pdftk and PHP together to fill and serve PDF forms. " />
    <script type="text/javascript">
      GitHub.nameWithOwner = GitHub.nameWithOwner || "andrewheiss/pdftk-php";
      GitHub.currentRef = 'master';
      GitHub.commitSHA = "17ad937fe827b92fa6187500dc2e453666a807da";
      GitHub.currentPath = 'pdftk-php.php';
      GitHub.masterBranch = "master";

      
    </script>
  

        <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-3769691-2']);
      _gaq.push(['_setDomainName', 'none']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script');
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        ga.setAttribute('async', 'true');
        document.documentElement.firstChild.appendChild(ga);
      })();
    </script>

    
  </head>

  

  <body class="logged_out page-blob">
    

    

    

    
      <div id="site_alert">
        <form action="/translate?to=%2Fandrewheiss%2Fpdftk-php%2Fblob%2Fmaster%2Fpdftk-php.php" method="post"><div style="margin:0;padding:0"><input name="authenticity_token" type="hidden" value="bddd3da882e07770b12360d6fd59701a15a31e84" /></div>        <p>
          Would you rather see this site in Spanish? (¿Deseas ver este sitio en Español?) &nbsp;
          <button class="minibutton" name="code" value="es"><span>Yes (Sí)</span></button> &nbsp;
          <button class="minibutton" name="code" value="en"><span>No (No)</span></button>
        </p>
        </form>      </div>
    

    

    <div class="subnavd" id="main">
      <div id="header" class="true">
        
          <a class="logo boring" href="https://github.com">
            <img alt="github" class="default" src="https://d3nwyuy0nl342s.cloudfront.net/images/modules/header/logov3.png" />
            <!--[if (gt IE 8)|!(IE)]><!-->
            <img alt="github" class="hover" src="https://d3nwyuy0nl342s.cloudfront.net/images/modules/header/logov3-hover.png" />
            <!--<![endif]-->
          </a>
        
        
        <div class="topsearch">
  
    <ul class="nav logged_out">
      <li class="pricing"><a href="/plans">Pricing and Signup</a></li>
      <li class="explore"><a href="/explore">Explore GitHub</a></li>
      <li class="features"><a href="/features">Features</a></li>
      <li class="blog"><a href="/blog">Blog</a></li>
      <li class="login"><a href="/login?return_to=https://github.com/andrewheiss/pdftk-php/blob/master/pdftk-php.php">Login</a></li>
    </ul>
  
</div>

      </div>

      
      
        
    <div class="site">
      <div class="pagehead repohead vis-public    instapaper_ignore readability-menu">

      

      <div class="title-actions-bar">
        <h1>
          <a href="/andrewheiss">andrewheiss</a> / <strong><a href="https://github.com/andrewheiss/pdftk-php">pdftk-php</a></strong>
          
          
        </h1>

        
    <ul class="actions">
      

      
        <li class="for-owner" style="display:none"><a href="https://github.com/andrewheiss/pdftk-php/admin" class="minibutton btn-admin "><span><span class="icon"></span>Admin</span></a></li>
        <li>
          <a href="/andrewheiss/pdftk-php/toggle_watch" class="minibutton btn-watch " id="watch_button" onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var s = document.createElement('input'); s.setAttribute('type', 'hidden'); s.setAttribute('name', 'authenticity_token'); s.setAttribute('value', 'bddd3da882e07770b12360d6fd59701a15a31e84'); f.appendChild(s);f.submit();return false;" style="display:none"><span><span class="icon"></span>Watch</span></a>
          <a href="/andrewheiss/pdftk-php/toggle_watch" class="minibutton btn-watch " id="unwatch_button" onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var s = document.createElement('input'); s.setAttribute('type', 'hidden'); s.setAttribute('name', 'authenticity_token'); s.setAttribute('value', 'bddd3da882e07770b12360d6fd59701a15a31e84'); f.appendChild(s);f.submit();return false;" style="display:none"><span><span class="icon"></span>Unwatch</span></a>
        </li>
        
          
            <li class="for-notforked" style="display:none"><a href="/andrewheiss/pdftk-php/fork" class="minibutton btn-fork " id="fork_button" onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var s = document.createElement('input'); s.setAttribute('type', 'hidden'); s.setAttribute('name', 'authenticity_token'); s.setAttribute('value', 'bddd3da882e07770b12360d6fd59701a15a31e84'); f.appendChild(s);f.submit();return false;"><span><span class="icon"></span>Fork</span></a></li>
            <li class="for-hasfork" style="display:none"><a href="#" class="minibutton btn-fork " id="your_fork_button"><span><span class="icon"></span>Your Fork</span></a></li>
          

          
        
      
      
      <li class="repostats">
        <ul class="repo-stats">
          <li class="watchers"><a href="/andrewheiss/pdftk-php/watchers" title="Watchers" class="tooltipped downwards">9</a></li>
          <li class="forks"><a href="/andrewheiss/pdftk-php/network" title="Forks" class="tooltipped downwards">1</a></li>
        </ul>
      </li>
    </ul>

      </div>

        
  <ul class="tabs">
    <li><a href="https://github.com/andrewheiss/pdftk-php" class="selected" highlight="repo_source">Source</a></li>
    <li><a href="https://github.com/andrewheiss/pdftk-php/commits/master" highlight="repo_commits">Commits</a></li>
    <li><a href="/andrewheiss/pdftk-php/network" highlight="repo_network">Network</a></li>
    <li><a href="/andrewheiss/pdftk-php/pulls" highlight="repo_pulls">Pull Requests (0)</a></li>

    

    
      
      <li><a href="/andrewheiss/pdftk-php/issues" highlight="issues">Issues (1)</a></li>
    

                <li><a href="/andrewheiss/pdftk-php/wiki" highlight="repo_wiki">Wiki (4)</a></li>
        
    <li><a href="/andrewheiss/pdftk-php/graphs" highlight="repo_graphs">Graphs</a></li>

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
      
      <a href="/andrewheiss/pdftk-php/branches" class="dropdown">Switch Branches (3)</a>
      <ul>
        
          
          
            <li><a href="/andrewheiss/pdftk-php/blob/dev/pdftk-php.php" action="show">dev</a></li>
          
        
          
          
            <li><a href="/andrewheiss/pdftk-php/blob/gh-pages/pdftk-php.php" action="show">gh-pages</a></li>
          
        
          
            <li><strong>master &#x2713;</strong></li>
            
      </ul>
    </li>
    <li>
      <a href="#" class="dropdown ">Switch Tags (5)</a>
              <ul>
                      
              <li><a href="/andrewheiss/pdftk-php/blob/1.0.3/pdftk-php.php">1.0.3</a></li>
            
                      
              <li><a href="/andrewheiss/pdftk-php/blob/1.0.2/pdftk-php.php">1.0.2</a></li>
            
                      
              <li><a href="/andrewheiss/pdftk-php/blob/1.0.1/pdftk-php.php">1.0.1</a></li>
            
                      
              <li><a href="/andrewheiss/pdftk-php/blob/1.0/pdftk-php.php">1.0</a></li>
            
                      
              <li><a href="/andrewheiss/pdftk-php/blob/0.1/pdftk-php.php">0.1</a></li>
            
                  </ul>
      
    </li>
    <li>
    
    <a href="/andrewheiss/pdftk-php/branches" class="manage">Branch List</a>
    
    </li>
  </ul>
</div>

  
  
  
  
  
  



        
    <div id="repo_details" class="metabox clearfix">
      <div id="repo_details_loader" class="metabox-loader" style="display:none">Sending Request&hellip;</div>

        <a href="/andrewheiss/pdftk-php/downloads" class="download-source" id="download_button" title="Download source, tagged packages and binaries."><span class="icon"></span>Downloads</a>

      <div id="repository_desc_wrapper">
      <div id="repository_description" rel="repository_description_edit">
        
          <p>A collection of functions that make it easy to use pdftk and PHP together to fill and serve PDF forms. 
            <span id="read_more" style="display:none">&mdash; <a href="#readme">Read more</a></span>
          </p>
        
      </div>

      <div id="repository_description_edit" style="display:none;" class="inline-edit">
        <form action="/andrewheiss/pdftk-php/admin/update" method="post"><div style="margin:0;padding:0"><input name="authenticity_token" type="hidden" value="bddd3da882e07770b12360d6fd59701a15a31e84" /></div>
          <input type="hidden" name="field" value="repository_description">
          <input type="text" class="textfield" name="value" value="A collection of functions that make it easy to use pdftk and PHP together to fill and serve PDF forms. ">
          <div class="form-actions">
            <button class="minibutton"><span>Save</span></button> &nbsp; <a href="#" class="cancel">Cancel</a>
          </div>
        </form>
      </div>

      
      <div class="repository-homepage" id="repository_homepage" rel="repository_homepage_edit">
        <p><a href="http://www.andrewheiss.com" rel="nofollow">http://www.andrewheiss.com</a></p>
      </div>

      <div id="repository_homepage_edit" style="display:none;" class="inline-edit">
        <form action="/andrewheiss/pdftk-php/admin/update" method="post"><div style="margin:0;padding:0"><input name="authenticity_token" type="hidden" value="bddd3da882e07770b12360d6fd59701a15a31e84" /></div>
          <input type="hidden" name="field" value="repository_homepage">
          <input type="text" class="textfield" name="value" value="http://www.andrewheiss.com">
          <div class="form-actions">
            <button class="minibutton"><span>Save</span></button> &nbsp; <a href="#" class="cancel">Cancel</a>
          </div>
        </form>
      </div>
      </div>
      <div class="rule "></div>
            <div id="url_box" class="url-box">
        <ul class="clone-urls">
          
            
            <li id="http_clone_url"><a href="https://github.com/andrewheiss/pdftk-php.git" data-permissions="Read-Only">HTTP</a></li>
            <li id="public_clone_url"><a href="git://github.com/andrewheiss/pdftk-php.git" data-permissions="Read-Only">Git Read-Only</a></li>
          
          
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
        <b><a href="/andrewheiss/pdftk-php">pdftk-php</a></b> /
        <input class="tree-finder-input" type="text" name="query" autocomplete="off" spellcheck="false">
      </div>

      
        <div class="octotip">
          <p>
            <a href="/andrewheiss/pdftk-php/dismiss-tree-finder-help" class="dismiss js-dismiss-tree-list-help" title="Hide this notice forever">Dismiss</a>
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
  GitHub.downloadRepo = '/andrewheiss/pdftk-php/archives/master'
  GitHub.revType = "master"

  GitHub.controllerName = "blob"
  GitHub.actionName     = "show"
  GitHub.currentAction  = "blob#show"

  

  
</script>






<div class="flash-messages"></div>


  <div id="commit">
    <div class="group">
        
  <div class="envelope commit">
    <div class="human">
      
        <div class="message"><pre><a href="/andrewheiss/pdftk-php/commit/17ad937fe827b92fa6187500dc2e453666a807da">Removed e-mail address field from example</a> </pre></div>
      

      <div class="actor">
        <div class="gravatar">
          
          <img src="https://secure.gravatar.com/avatar/fa80c2a776778ba6493086ea4fca525f?s=140&d=https://d3nwyuy0nl342s.cloudfront.net%2Fimages%2Fgravatars%2Fgravatar-140.png" alt="" width="30" height="30"  />
        </div>
        <div class="name"><a href="/andrewheiss">andrewheiss</a> <span>(author)</span></div>
        <div class="date">
          <abbr class="relatize" title="2010-03-28 13:19:14">Sun Mar 28 13:19:14 -0700 2010</abbr>
        </div>
      </div>

      

    </div>
    <div class="machine">
      <span>c</span>ommit&nbsp;&nbsp;<a href="/andrewheiss/pdftk-php/commit/17ad937fe827b92fa6187500dc2e453666a807da" hotkey="c">17ad937fe827b92fa618</a><br />
      <span>t</span>ree&nbsp;&nbsp;&nbsp;&nbsp;<a href="/andrewheiss/pdftk-php/tree/17ad937fe827b92fa6187500dc2e453666a807da" hotkey="t">bb01b575e6cb97260326</a><br />
      
        <span>p</span>arent&nbsp;
        
        <a href="/andrewheiss/pdftk-php/tree/e6fa74f5936b7e2005493b5e6017a3164df75d3c" hotkey="p">e6fa74f5936b7e200549</a>
      

    </div>
  </div>

    </div>
  </div>



  <div id="slider">

  

    <div class="breadcrumb" data-path="pdftk-php.php/">
      <b><a href="/andrewheiss/pdftk-php/tree/17ad937fe827b92fa6187500dc2e453666a807da">pdftk-php</a></b> / pdftk-php.php       <span style="display:none" id="clippy_3188">pdftk-php.php</span>
      
      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
              width="110"
              height="14"
              class="clippy"
              id="clippy" >
      <param name="movie" value="https://d3nwyuy0nl342s.cloudfront.net/flash/clippy.swf?v5"/>
      <param name="allowScriptAccess" value="always" />
      <param name="quality" value="high" />
      <param name="scale" value="noscale" />
      <param NAME="FlashVars" value="id=clippy_3188&amp;copied=copied!&amp;copyto=copy to clipboard">
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
             FlashVars="id=clippy_3188&amp;copied=copied!&amp;copyto=copy to clipboard"
             bgcolor="#FFFFFF"
             wmode="opaque"
      />
      </object>
      

    </div>

    <div class="frames">
      <div class="frame frame-center" data-path="pdftk-php.php/">
        
          <ul class="big-actions">
            
            <li><a class="file-edit-link minibutton" href="/andrewheiss/pdftk-php/file-edit/__current_ref__/pdftk-php.php"><span>Edit this file</span></a></li>
          </ul>
        

        <div id="files">
          <div class="file">
            <div class="meta">
              <div class="info">
                <span class="icon"><img alt="Txt" height="16" src="https://d3nwyuy0nl342s.cloudfront.net/images/icons/txt.png" width="16" /></span>
                <span class="mode" title="File Mode">100644</span>
                
                  <span>315 lines (264 sloc)</span>
                
                <span>10.277 kb</span>
              </div>
              <ul class="actions">
                <li><a href="/andrewheiss/pdftk-php/raw/master/pdftk-php.php" id="raw-url">raw</a></li>
                
                  <li><a href="/andrewheiss/pdftk-php/blame/master/pdftk-php.php">blame</a></li>
                
                <li><a href="/andrewheiss/pdftk-php/commits/master/pdftk-php.php">history</a></li>
              </ul>
            </div>
            
  <div class="data type-php">
    
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
</pre>
          </td>
          <td width="100%">
            
              
                <div class="highlight"><pre><div class='line' id='LC1'><span class="cp">&lt;?php</span></div><div class='line' id='LC2'><br/></div><div class='line' id='LC3'><span class="c1">##################################################################################################################</span></div><div class='line' id='LC4'><span class="c1">#</span></div><div class='line' id='LC5'><span class="c1">#	pdftk-php Class</span></div><div class='line' id='LC6'><span class="c1">#	http://code.google.com/p/pdftk-php/</span></div><div class='line' id='LC7'><span class="c1">#	http://www.pdfhacks.com/forge_fdf/</span></div><div class='line' id='LC8'><span class="c1">#</span></div><div class='line' id='LC9'><span class="c1">#	License: Released under New BSD license - http://www.opensource.org/licenses/bsd-license.php</span></div><div class='line' id='LC10'><span class="c1">#</span></div><div class='line' id='LC11'><span class="c1">#	Purpose: Contains functions used to inject data from MySQL into an empty PDF form</span></div><div class='line' id='LC12'><span class="c1">#</span></div><div class='line' id='LC13'><span class="c1">#	Authors: Andrew Heiss (www.andrewheiss.com), Sid Steward (http://www.oreillynet.com/pub/au/1754)</span></div><div class='line' id='LC14'><span class="c1">#</span></div><div class='line' id='LC15'><span class="c1">#	History: </span></div><div class='line' id='LC16'><span class="c1">#		8/26/08 - Initial programming</span></div><div class='line' id='LC17'><span class="c1">#</span></div><div class='line' id='LC18'><span class="c1">#	Usage: </span></div><div class='line' id='LC19'><span class="c1">#		$pdfmaker = new pdftk_php;</span></div><div class='line' id='LC20'><span class="c1">#</span></div><div class='line' id='LC21'><span class="c1">#		$fdf_data_strings = array();</span></div><div class='line' id='LC22'><span class="c1">#		$fdf_data_names = array(); </span></div><div class='line' id='LC23'><span class="c1">#		$fields_hidden = array(); </span></div><div class='line' id='LC24'><span class="c1">#		$fields_readonly = array();</span></div><div class='line' id='LC25'><span class="c1">#		$pdf_original = &quot;string&quot;; = filename of the original, empty pdf form</span></div><div class='line' id='LC26'><span class="c1">#		$pdf_filename = &quot;string&quot;; = filename to be used for the output pdf</span></div><div class='line' id='LC27'><span class="c1">#</span></div><div class='line' id='LC28'><span class="c1">#		$pdfmaker-&gt;make_pdf($fdf_data_strings, $fdf_data_names, $fields_hidden, $fields_readonly, $pdf_filename);</span></div><div class='line' id='LC29'><span class="c1">#</span></div><div class='line' id='LC30'><span class="c1">##################################################################################################################</span></div><div class='line' id='LC31'><br/></div><div class='line' id='LC32'>	<span class="k">class</span> <span class="nc">pdftk_php</span> <span class="p">{</span> 		</div><div class='line' id='LC33'><br/></div><div class='line' id='LC34'><span class="c1">#############################################################################</span></div><div class='line' id='LC35'><span class="c1">#</span></div><div class='line' id='LC36'><span class="c1">#	Function name: makePDF</span></div><div class='line' id='LC37'><span class="c1">#</span></div><div class='line' id='LC38'><span class="c1">#	Purpose: Generate an FDF file from db data, inject the FDF in an empty PDF form</span></div><div class='line' id='LC39'><span class="c1">#</span></div><div class='line' id='LC40'><span class="c1">#	Incoming parameters: </span></div><div class='line' id='LC41'><span class="c1">#		$fetched_array - one row of fetched MySQL data saved as a variable</span></div><div class='line' id='LC42'><span class="c1">#</span></div><div class='line' id='LC43'><span class="c1">#	Returns: Downloaded PDF file</span></div><div class='line' id='LC44'><span class="c1">#</span></div><div class='line' id='LC45'><span class="c1">#	Notes:</span></div><div class='line' id='LC46'><span class="c1">#		* For text fields, combo boxes and list boxes, add field values as a name =&gt; value pair to $fdf_data_strings. An example of $fdf_data_strings is given in /example/download.php</span></div><div class='line' id='LC47'><span class="c1">#		* For check boxes and radio buttons, add field values as a name =&gt; value pair to $fdf_data_names.  Typically, true and false correspond to the (case sensitive) names &quot;Yes&quot; and &quot;Off&quot;.</span></div><div class='line' id='LC48'><span class="c1">#		* Any field added to the $fields_hidden or $fields_readonly array must also be a key in $fdf_data_strings or $fdf_data_names; this might be changed in the future</span></div><div class='line' id='LC49'><span class="c1">#		* Any field listed in $fdf_data_strings or $fdf_data_names that you want hidden or read-only must have its field name added to $fields_hidden or $fields_readonly; do this even if your form has these bits set already </span></div><div class='line' id='LC50'><span class="c1">#</span></div><div class='line' id='LC51'><span class="c1">#############################################################################</span></div><div class='line' id='LC52'><br/></div><div class='line' id='LC53'>		<span class="k">public</span> <span class="k">function</span> <span class="nf">make_pdf</span><span class="p">(</span><span class="nv">$fdf_data_strings</span><span class="p">,</span> <span class="nv">$fdf_data_names</span><span class="p">,</span> <span class="nv">$fields_hidden</span><span class="p">,</span> <span class="nv">$fields_readonly</span><span class="p">,</span> <span class="nv">$pdf_original</span><span class="p">,</span> <span class="nv">$pdf_filename</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC54'>			<span class="c1">// Create the fdf file</span></div><div class='line' id='LC55'>			<span class="nv">$fdf</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">forge_fdf</span><span class="p">(</span><span class="s1">&#39;&#39;</span><span class="p">,</span> <span class="nv">$fdf_data_strings</span><span class="p">,</span> <span class="nv">$fdf_data_names</span><span class="p">,</span> <span class="nv">$fields_hidden</span><span class="p">,</span> <span class="nv">$fields_readonly</span><span class="p">);</span></div><div class='line' id='LC56'><br/></div><div class='line' id='LC57'>			<span class="c1">// Save the fdf file temporarily - make sure the server has write permissions in the folder you specify in tempnam()</span></div><div class='line' id='LC58'>			<span class="nv">$fdf_fn</span> <span class="o">=</span> <span class="nb">tempnam</span><span class="p">(</span><span class="s2">&quot;.&quot;</span><span class="p">,</span> <span class="s2">&quot;fdf&quot;</span><span class="p">);</span></div><div class='line' id='LC59'>			<span class="nv">$fp</span> <span class="o">=</span> <span class="nb">fopen</span><span class="p">(</span><span class="nv">$fdf_fn</span><span class="p">,</span> <span class="s1">&#39;w&#39;</span><span class="p">);</span></div><div class='line' id='LC60'><br/></div><div class='line' id='LC61'>			<span class="k">if</span><span class="p">(</span><span class="nv">$fp</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC62'>				<span class="nb">fwrite</span><span class="p">(</span><span class="nv">$fp</span><span class="p">,</span> <span class="nv">$fdf</span><span class="p">);</span></div><div class='line' id='LC63'>				<span class="nb">fclose</span><span class="p">(</span><span class="nv">$fp</span><span class="p">);</span></div><div class='line' id='LC64'><br/></div><div class='line' id='LC65'>				<span class="c1">// Send a force download header to the browser with a file MIME type</span></div><div class='line' id='LC66'>				<span class="nb">header</span><span class="p">(</span><span class="s2">&quot;Content-Type: application/force-download&quot;</span><span class="p">);</span></div><div class='line' id='LC67'>				<span class="nb">header</span><span class="p">(</span><span class="s2">&quot;Content-Disposition: attachment; filename=</span><span class="se">\&quot;</span><span class="si">$pdf_filename</span><span class="se">\&quot;</span><span class="s2">&quot;</span><span class="p">);</span></div><div class='line' id='LC68'><br/></div><div class='line' id='LC69'>				<span class="c1">// Actually make the PDF by running pdftk - make sure the path to pdftk is correct</span></div><div class='line' id='LC70'>				<span class="c1">// The PDF will be output directly to the browser - apart from the original PDF file, no actual PDF wil be saved on the server.</span></div><div class='line' id='LC71'>				<span class="nb">passthru</span><span class="p">(</span><span class="s2">&quot;/usr/local/bin/pdftk </span><span class="si">$pdf_original</span><span class="s2"> fill_form </span><span class="si">$fdf_fn</span><span class="s2"> output - flatten&quot;</span><span class="p">);</span></div><div class='line' id='LC72'><br/></div><div class='line' id='LC73'>				<span class="c1">// delete temporary fdf file</span></div><div class='line' id='LC74'>				<span class="nb">unlink</span><span class="p">(</span> <span class="nv">$fdf_fn</span> <span class="p">);</span> </div><div class='line' id='LC75'>			<span class="p">}</span></div><div class='line' id='LC76'>			<span class="k">else</span> <span class="p">{</span> <span class="c1">// error</span></div><div class='line' id='LC77'>				<span class="k">echo</span> <span class="s1">&#39;Error: unable to write temp fdf file: &#39;</span><span class="o">.</span> <span class="nv">$fdf_fn</span><span class="p">;</span></div><div class='line' id='LC78'>			<span class="p">}</span></div><div class='line' id='LC79'><br/></div><div class='line' id='LC80'>		<span class="p">}</span> <span class="c1">// end of make_pdf()</span></div><div class='line' id='LC81'><br/></div><div class='line' id='LC82'><br/></div><div class='line' id='LC83'>		<span class="k">protected</span> <span class="k">function</span> <span class="nf">forge_fdf</span><span class="p">(</span><span class="nv">$pdf_form_url</span><span class="p">,</span> <span class="o">&amp;</span><span class="nv">$fdf_data_strings</span><span class="p">,</span> <span class="o">&amp;</span><span class="nv">$fdf_data_names</span><span class="p">,</span> <span class="o">&amp;</span><span class="nv">$fields_hidden</span><span class="p">,</span> <span class="o">&amp;</span><span class="nv">$fields_readonly</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC84'><br/></div><div class='line' id='LC85'>		<span class="cm">/* forge_fdf, by Sid Steward</span></div><div class='line' id='LC86'><span class="cm">		   version 1.1</span></div><div class='line' id='LC87'><span class="cm">		   visit: www.pdfhacks.com/forge_fdf/</span></div><div class='line' id='LC88'><span class="cm">		   </span></div><div class='line' id='LC89'><span class="cm">		   PDF can be particular about CR and LF characters, so I spelled them out in hex: CR == \x0d : LF == \x0a</span></div><div class='line' id='LC90'><span class="cm">		   </span></div><div class='line' id='LC91'><span class="cm">		*/</span></div><div class='line' id='LC92'>			<span class="nv">$fdf</span> <span class="o">=</span> <span class="s2">&quot;%FDF-1.2</span><span class="se">\x0d</span><span class="s2">%</span><span class="se">\xe2\xe3\xcf\xd3\x0d\x0a</span><span class="s2">&quot;</span><span class="p">;</span> <span class="c1">// header</span></div><div class='line' id='LC93'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;1 0 obj</span><span class="se">\x0d</span><span class="s2">&lt;&lt; &quot;</span><span class="p">;</span> <span class="c1">// open the Root dictionary</span></div><div class='line' id='LC94'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;</span><span class="se">\x0d</span><span class="s2">/FDF &lt;&lt; &quot;</span><span class="p">;</span> <span class="c1">// open the FDF dictionary</span></div><div class='line' id='LC95'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;/Fields [ &quot;</span><span class="p">;</span> <span class="c1">// open the form Fields array</span></div><div class='line' id='LC96'><br/></div><div class='line' id='LC97'>			<span class="nv">$fdf_data_strings</span> <span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">burst_dots_into_arrays</span><span class="p">(</span> <span class="nv">$fdf_data_strings</span> <span class="p">);</span></div><div class='line' id='LC98'>			<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">forge_fdf_fields_strings</span><span class="p">(</span> <span class="nv">$fdf</span><span class="p">,</span></div><div class='line' id='LC99'>						<span class="nv">$fdf_data_strings</span><span class="p">,</span></div><div class='line' id='LC100'>						<span class="nv">$fields_hidden</span><span class="p">,</span></div><div class='line' id='LC101'>						<span class="nv">$fields_readonly</span> <span class="p">);</span></div><div class='line' id='LC102'><br/></div><div class='line' id='LC103'>			<span class="nv">$fdf_data_names</span><span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">burst_dots_into_arrays</span><span class="p">(</span> <span class="nv">$fdf_data_names</span> <span class="p">);</span></div><div class='line' id='LC104'>			<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">forge_fdf_fields_names</span><span class="p">(</span> <span class="nv">$fdf</span><span class="p">,</span></div><div class='line' id='LC105'>					  <span class="nv">$fdf_data_names</span><span class="p">,</span></div><div class='line' id='LC106'>					  <span class="nv">$fields_hidden</span><span class="p">,</span></div><div class='line' id='LC107'>					  <span class="nv">$fields_readonly</span> <span class="p">);</span></div><div class='line' id='LC108'><br/></div><div class='line' id='LC109'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;] </span><span class="se">\x0d</span><span class="s2">&quot;</span><span class="p">;</span> <span class="c1">// close the Fields array</span></div><div class='line' id='LC110'><br/></div><div class='line' id='LC111'>			<span class="c1">// the PDF form filename or URL, if given</span></div><div class='line' id='LC112'>			<span class="k">if</span><span class="p">(</span> <span class="nv">$pdf_form_url</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC113'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;/F (&quot;</span><span class="o">.</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">escape_pdf_string</span><span class="p">(</span><span class="nv">$pdf_form_url</span><span class="p">)</span><span class="o">.</span><span class="s2">&quot;) </span><span class="se">\x0d</span><span class="s2">&quot;</span><span class="p">;</span></div><div class='line' id='LC114'>			<span class="p">}</span></div><div class='line' id='LC115'><br/></div><div class='line' id='LC116'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;&gt;&gt; </span><span class="se">\x0d</span><span class="s2">&quot;</span><span class="p">;</span> <span class="c1">// close the FDF dictionary</span></div><div class='line' id='LC117'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;&gt;&gt; </span><span class="se">\x0d</span><span class="s2">endobj</span><span class="se">\x0d</span><span class="s2">&quot;</span><span class="p">;</span> <span class="c1">// close the Root dictionary</span></div><div class='line' id='LC118'><br/></div><div class='line' id='LC119'>			<span class="c1">// trailer; note the &quot;1 0 R&quot; reference to &quot;1 0 obj&quot; above</span></div><div class='line' id='LC120'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;trailer</span><span class="se">\x0d</span><span class="s2">&lt;&lt;</span><span class="se">\x0d</span><span class="s2">/Root 1 0 R </span><span class="se">\x0d\x0d</span><span class="s2">&gt;&gt;</span><span class="se">\x0d</span><span class="s2">&quot;</span><span class="p">;</span></div><div class='line' id='LC121'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;%%EOF</span><span class="se">\x0d\x0a</span><span class="s2">&quot;</span><span class="p">;</span></div><div class='line' id='LC122'><br/></div><div class='line' id='LC123'>			<span class="k">return</span> <span class="nv">$fdf</span><span class="p">;</span></div><div class='line' id='LC124'>		<span class="p">}</span></div><div class='line' id='LC125'><br/></div><div class='line' id='LC126'>		<span class="k">public</span> <span class="k">function</span> <span class="nf">escape_pdf_string</span><span class="p">(</span> <span class="nv">$ss</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC127'>		  <span class="nv">$backslash</span><span class="o">=</span> <span class="nb">chr</span><span class="p">(</span><span class="m">0</span><span class="nx">x5c</span><span class="p">);</span></div><div class='line' id='LC128'>		  <span class="nv">$ss_esc</span><span class="o">=</span> <span class="s1">&#39;&#39;</span><span class="p">;</span></div><div class='line' id='LC129'>		  <span class="nv">$ss_len</span><span class="o">=</span> <span class="nb">strlen</span><span class="p">(</span> <span class="nv">$ss</span> <span class="p">);</span></div><div class='line' id='LC130'>		  <span class="k">for</span><span class="p">(</span> <span class="nv">$ii</span><span class="o">=</span> <span class="m">0</span><span class="p">;</span> <span class="nv">$ii</span><span class="o">&lt;</span> <span class="nv">$ss_len</span><span class="p">;</span> <span class="o">++</span><span class="nv">$ii</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC131'>			<span class="k">if</span><span class="p">(</span> <span class="nb">ord</span><span class="p">(</span><span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">})</span><span class="o">==</span> <span class="m">0</span><span class="nx">x28</span> <span class="o">||</span>  <span class="c1">// open paren</span></div><div class='line' id='LC132'>			<span class="nb">ord</span><span class="p">(</span><span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">})</span><span class="o">==</span> <span class="m">0</span><span class="nx">x29</span> <span class="o">||</span>  <span class="c1">// close paren</span></div><div class='line' id='LC133'>			<span class="nb">ord</span><span class="p">(</span><span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">})</span><span class="o">==</span> <span class="m">0</span><span class="nx">x5c</span> <span class="p">)</span>   <span class="c1">// backslash</span></div><div class='line' id='LC134'>			  <span class="p">{</span></div><div class='line' id='LC135'>			<span class="nv">$ss_esc</span><span class="o">.=</span> <span class="nv">$backslash</span><span class="o">.</span><span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">};</span> <span class="c1">// escape the character w/ backslash</span></div><div class='line' id='LC136'>			  <span class="p">}</span></div><div class='line' id='LC137'>			<span class="k">else</span> <span class="k">if</span><span class="p">(</span> <span class="nb">ord</span><span class="p">(</span><span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">})</span> <span class="o">&lt;</span> <span class="m">32</span> <span class="o">||</span> <span class="m">126</span> <span class="o">&lt;</span> <span class="nb">ord</span><span class="p">(</span><span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">})</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC138'>			  <span class="nv">$ss_esc</span><span class="o">.=</span> <span class="nb">sprintf</span><span class="p">(</span> <span class="s2">&quot;\\%03o&quot;</span><span class="p">,</span> <span class="nb">ord</span><span class="p">(</span><span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">})</span> <span class="p">);</span> <span class="c1">// use an octal code</span></div><div class='line' id='LC139'>			<span class="p">}</span></div><div class='line' id='LC140'>			<span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC141'>			  <span class="nv">$ss_esc</span><span class="o">.=</span> <span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">};</span></div><div class='line' id='LC142'>			<span class="p">}</span></div><div class='line' id='LC143'>		  <span class="p">}</span></div><div class='line' id='LC144'>		  <span class="k">return</span> <span class="nv">$ss_esc</span><span class="p">;</span></div><div class='line' id='LC145'>		<span class="p">}</span></div><div class='line' id='LC146'><br/></div><div class='line' id='LC147'>		<span class="k">protected</span> <span class="k">function</span> <span class="nf">escape_pdf_name</span><span class="p">(</span> <span class="nv">$ss</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC148'>		  <span class="nv">$ss_esc</span><span class="o">=</span> <span class="s1">&#39;&#39;</span><span class="p">;</span></div><div class='line' id='LC149'>		  <span class="nv">$ss_len</span><span class="o">=</span> <span class="nb">strlen</span><span class="p">(</span> <span class="nv">$ss</span> <span class="p">);</span></div><div class='line' id='LC150'>		  <span class="k">for</span><span class="p">(</span> <span class="nv">$ii</span><span class="o">=</span> <span class="m">0</span><span class="p">;</span> <span class="nv">$ii</span><span class="o">&lt;</span> <span class="nv">$ss_len</span><span class="p">;</span> <span class="o">++</span><span class="nv">$ii</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC151'>			<span class="k">if</span><span class="p">(</span> <span class="nb">ord</span><span class="p">(</span><span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">})</span> <span class="o">&lt;</span> <span class="m">33</span> <span class="o">||</span> <span class="m">126</span> <span class="o">&lt;</span> <span class="nb">ord</span><span class="p">(</span><span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">})</span> <span class="o">||</span> </div><div class='line' id='LC152'>			<span class="nb">ord</span><span class="p">(</span><span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">})</span><span class="o">==</span> <span class="m">0</span><span class="nx">x23</span> <span class="p">)</span> <span class="c1">// hash mark</span></div><div class='line' id='LC153'>			  <span class="p">{</span></div><div class='line' id='LC154'>			<span class="nv">$ss_esc</span><span class="o">.=</span> <span class="nb">sprintf</span><span class="p">(</span> <span class="s2">&quot;#%02x&quot;</span><span class="p">,</span> <span class="nb">ord</span><span class="p">(</span><span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">})</span> <span class="p">);</span> <span class="c1">// use a hex code</span></div><div class='line' id='LC155'>			  <span class="p">}</span></div><div class='line' id='LC156'>			<span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC157'>			  <span class="nv">$ss_esc</span><span class="o">.=</span> <span class="nv">$ss</span><span class="p">{</span><span class="nv">$ii</span><span class="p">};</span></div><div class='line' id='LC158'>			<span class="p">}</span></div><div class='line' id='LC159'>		  <span class="p">}</span></div><div class='line' id='LC160'>		  <span class="k">return</span> <span class="nv">$ss_esc</span><span class="p">;</span></div><div class='line' id='LC161'>		<span class="p">}</span></div><div class='line' id='LC162'><br/></div><div class='line' id='LC163'>		<span class="c1">// In PDF, partial form field names are combined using periods to</span></div><div class='line' id='LC164'>		<span class="c1">// yield the full form field name; we&#39;ll take these dot-delimited</span></div><div class='line' id='LC165'>		<span class="c1">// names and then expand them into nested arrays, here; takes</span></div><div class='line' id='LC166'>		<span class="c1">// an array that uses dot-delimited names and returns a tree of arrays;</span></div><div class='line' id='LC167'>		<span class="c1">//</span></div><div class='line' id='LC168'>		<span class="k">protected</span> <span class="k">function</span> <span class="nf">burst_dots_into_arrays</span><span class="p">(</span> <span class="o">&amp;</span><span class="nv">$fdf_data_old</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC169'>		  <span class="nv">$fdf_data_new</span><span class="o">=</span> <span class="k">array</span><span class="p">();</span></div><div class='line' id='LC170'><br/></div><div class='line' id='LC171'>		  <span class="k">foreach</span><span class="p">(</span> <span class="nv">$fdf_data_old</span> <span class="k">as</span> <span class="nv">$key</span> <span class="o">=&gt;</span> <span class="nv">$value</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC172'>			<span class="nv">$key_split</span><span class="o">=</span> <span class="nb">explode</span><span class="p">(</span> <span class="s1">&#39;.&#39;</span><span class="p">,</span> <span class="p">(</span><span class="nx">string</span><span class="p">)</span><span class="nv">$key</span><span class="p">,</span> <span class="m">2</span> <span class="p">);</span></div><div class='line' id='LC173'><br/></div><div class='line' id='LC174'>			<span class="k">if</span><span class="p">(</span> <span class="nb">count</span><span class="p">(</span><span class="nv">$key_split</span><span class="p">)</span><span class="o">==</span> <span class="m">2</span> <span class="p">)</span> <span class="p">{</span> <span class="c1">// handle dot</span></div><div class='line' id='LC175'>			  <span class="k">if</span><span class="p">(</span> <span class="o">!</span><span class="nb">array_key_exists</span><span class="p">(</span> <span class="p">(</span><span class="nx">string</span><span class="p">)(</span><span class="nv">$key_split</span><span class="p">[</span><span class="m">0</span><span class="p">]),</span> <span class="nv">$fdf_data_new</span> <span class="p">)</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC176'>			<span class="nv">$fdf_data_new</span><span class="p">[</span> <span class="p">(</span><span class="nx">string</span><span class="p">)(</span><span class="nv">$key_split</span><span class="p">[</span><span class="m">0</span><span class="p">])</span> <span class="p">]</span><span class="o">=</span> <span class="k">array</span><span class="p">();</span></div><div class='line' id='LC177'>			  <span class="p">}</span></div><div class='line' id='LC178'>			  <span class="k">if</span><span class="p">(</span> <span class="nb">gettype</span><span class="p">(</span> <span class="nv">$fdf_data_new</span><span class="p">[</span> <span class="p">(</span><span class="nx">string</span><span class="p">)(</span><span class="nv">$key_split</span><span class="p">[</span><span class="m">0</span><span class="p">])</span> <span class="p">]</span> <span class="p">)</span><span class="o">!=</span> <span class="s1">&#39;array&#39;</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC179'>			<span class="c1">// this new key collides with an existing name; this shouldn&#39;t happen;</span></div><div class='line' id='LC180'>			<span class="c1">// associate string value with the special empty key in array, anyhow;</span></div><div class='line' id='LC181'><br/></div><div class='line' id='LC182'>			<span class="nv">$fdf_data_new</span><span class="p">[</span> <span class="p">(</span><span class="nx">string</span><span class="p">)(</span><span class="nv">$key_split</span><span class="p">[</span><span class="m">0</span><span class="p">])</span> <span class="p">]</span><span class="o">=</span> </div><div class='line' id='LC183'>			  <span class="k">array</span><span class="p">(</span> <span class="s1">&#39;&#39;</span> <span class="o">=&gt;</span> <span class="nv">$fdf_data_new</span><span class="p">[</span> <span class="p">(</span><span class="nx">string</span><span class="p">)(</span><span class="nv">$key_split</span><span class="p">[</span><span class="m">0</span><span class="p">])</span> <span class="p">]</span> <span class="p">);</span></div><div class='line' id='LC184'>			  <span class="p">}</span></div><div class='line' id='LC185'><br/></div><div class='line' id='LC186'>			  <span class="nv">$fdf_data_new</span><span class="p">[</span> <span class="p">(</span><span class="nx">string</span><span class="p">)(</span><span class="nv">$key_split</span><span class="p">[</span><span class="m">0</span><span class="p">])</span> <span class="p">][</span> <span class="p">(</span><span class="nx">string</span><span class="p">)(</span><span class="nv">$key_split</span><span class="p">[</span><span class="m">1</span><span class="p">])</span> <span class="p">]</span><span class="o">=</span> <span class="nv">$value</span><span class="p">;</span></div><div class='line' id='LC187'>			<span class="p">}</span></div><div class='line' id='LC188'>			<span class="k">else</span> <span class="p">{</span> <span class="c1">// no dot</span></div><div class='line' id='LC189'>			  <span class="k">if</span><span class="p">(</span> <span class="nb">array_key_exists</span><span class="p">(</span> <span class="p">(</span><span class="nx">string</span><span class="p">)(</span><span class="nv">$key_split</span><span class="p">[</span><span class="m">0</span><span class="p">]),</span> <span class="nv">$fdf_data_new</span> <span class="p">)</span> <span class="o">&amp;&amp;</span></div><div class='line' id='LC190'>			  <span class="nb">gettype</span><span class="p">(</span> <span class="nv">$fdf_data_new</span><span class="p">[</span> <span class="p">(</span><span class="nx">string</span><span class="p">)(</span><span class="nv">$key_split</span><span class="p">[</span><span class="m">0</span><span class="p">])</span> <span class="p">]</span> <span class="p">)</span><span class="o">==</span> <span class="s1">&#39;array&#39;</span> <span class="p">)</span></div><div class='line' id='LC191'>			<span class="p">{</span> <span class="c1">// this key collides with an existing array; this shouldn&#39;t happen;</span></div><div class='line' id='LC192'>			  <span class="c1">// associate string value with the special empty key in array, anyhow;</span></div><div class='line' id='LC193'><br/></div><div class='line' id='LC194'>			  <span class="nv">$fdf_data_new</span><span class="p">[</span> <span class="p">(</span><span class="nx">string</span><span class="p">)</span><span class="nv">$key</span> <span class="p">][</span><span class="s1">&#39;&#39;</span><span class="p">]</span><span class="o">=</span> <span class="nv">$value</span><span class="p">;</span></div><div class='line' id='LC195'>			<span class="p">}</span></div><div class='line' id='LC196'>			  <span class="k">else</span> <span class="p">{</span> <span class="c1">// simply copy</span></div><div class='line' id='LC197'>			<span class="nv">$fdf_data_new</span><span class="p">[</span> <span class="p">(</span><span class="nx">string</span><span class="p">)</span><span class="nv">$key</span> <span class="p">]</span><span class="o">=</span> <span class="nv">$value</span><span class="p">;</span></div><div class='line' id='LC198'>			  <span class="p">}</span></div><div class='line' id='LC199'>			<span class="p">}</span></div><div class='line' id='LC200'>		  <span class="p">}</span></div><div class='line' id='LC201'><br/></div><div class='line' id='LC202'>		  <span class="k">foreach</span><span class="p">(</span> <span class="nv">$fdf_data_new</span> <span class="k">as</span> <span class="nv">$key</span> <span class="o">=&gt;</span> <span class="nv">$value</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC203'>			<span class="k">if</span><span class="p">(</span> <span class="nb">gettype</span><span class="p">(</span><span class="nv">$value</span><span class="p">)</span><span class="o">==</span> <span class="s1">&#39;array&#39;</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC204'>			  <span class="nv">$fdf_data_new</span><span class="p">[</span> <span class="p">(</span><span class="nx">string</span><span class="p">)</span><span class="nv">$key</span> <span class="p">]</span><span class="o">=</span> <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">burst_dots_into_arrays</span><span class="p">(</span> <span class="nv">$value</span> <span class="p">);</span> <span class="c1">// recurse</span></div><div class='line' id='LC205'>			<span class="p">}</span></div><div class='line' id='LC206'>		  <span class="p">}</span></div><div class='line' id='LC207'><br/></div><div class='line' id='LC208'>		  <span class="k">return</span> <span class="nv">$fdf_data_new</span><span class="p">;</span></div><div class='line' id='LC209'>		<span class="p">}</span></div><div class='line' id='LC210'><br/></div><div class='line' id='LC211'>		<span class="k">protected</span> <span class="k">function</span> <span class="nf">forge_fdf_fields_flags</span><span class="p">(</span> <span class="o">&amp;</span><span class="nv">$fdf</span><span class="p">,</span></div><div class='line' id='LC212'>					<span class="nv">$field_name</span><span class="p">,</span></div><div class='line' id='LC213'>					<span class="o">&amp;</span><span class="nv">$fields_hidden</span><span class="p">,</span></div><div class='line' id='LC214'>					<span class="o">&amp;</span><span class="nv">$fields_readonly</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC215'>		  <span class="k">if</span><span class="p">(</span> <span class="nb">in_array</span><span class="p">(</span> <span class="nv">$field_name</span><span class="p">,</span> <span class="nv">$fields_hidden</span> <span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC216'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;/SetF 2 &quot;</span><span class="p">;</span> <span class="c1">// set</span></div><div class='line' id='LC217'>		  <span class="k">else</span></div><div class='line' id='LC218'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;/ClrF 2 &quot;</span><span class="p">;</span> <span class="c1">// clear</span></div><div class='line' id='LC219'><br/></div><div class='line' id='LC220'>		  <span class="k">if</span><span class="p">(</span> <span class="nb">in_array</span><span class="p">(</span> <span class="nv">$field_name</span><span class="p">,</span> <span class="nv">$fields_readonly</span> <span class="p">)</span> <span class="p">)</span></div><div class='line' id='LC221'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;/SetFf 1 &quot;</span><span class="p">;</span> <span class="c1">// set</span></div><div class='line' id='LC222'>		  <span class="k">else</span></div><div class='line' id='LC223'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;/ClrFf 1 &quot;</span><span class="p">;</span> <span class="c1">// clear</span></div><div class='line' id='LC224'>		<span class="p">}</span></div><div class='line' id='LC225'><br/></div><div class='line' id='LC226'>		<span class="k">protected</span> <span class="k">function</span> <span class="nf">forge_fdf_fields</span><span class="p">(</span> <span class="o">&amp;</span><span class="nv">$fdf</span><span class="p">,</span></div><div class='line' id='LC227'>				  <span class="o">&amp;</span><span class="nv">$fdf_data</span><span class="p">,</span></div><div class='line' id='LC228'>				  <span class="o">&amp;</span><span class="nv">$fields_hidden</span><span class="p">,</span></div><div class='line' id='LC229'>				  <span class="o">&amp;</span><span class="nv">$fields_readonly</span><span class="p">,</span></div><div class='line' id='LC230'>				  <span class="nv">$accumulated_name</span><span class="p">,</span></div><div class='line' id='LC231'>				  <span class="nv">$strings_b</span> <span class="p">)</span> <span class="c1">// true &lt;==&gt; $fdf_data contains string data</span></div><div class='line' id='LC232'>			 <span class="c1">//</span></div><div class='line' id='LC233'>			 <span class="c1">// string data is used for text fields, combo boxes and list boxes;</span></div><div class='line' id='LC234'>			 <span class="c1">// name data is used for checkboxes and radio buttons, and</span></div><div class='line' id='LC235'>			 <span class="c1">// /Yes and /Off are commonly used for true and false</span></div><div class='line' id='LC236'>		<span class="p">{</span></div><div class='line' id='LC237'>		  <span class="k">if</span><span class="p">(</span> <span class="m">0</span><span class="o">&lt;</span> <span class="nb">strlen</span><span class="p">(</span> <span class="nv">$accumulated_name</span> <span class="p">)</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC238'>			<span class="nv">$accumulated_name</span><span class="o">.=</span> <span class="s1">&#39;.&#39;</span><span class="p">;</span> <span class="c1">// append period seperator</span></div><div class='line' id='LC239'>		  <span class="p">}</span></div><div class='line' id='LC240'><br/></div><div class='line' id='LC241'>		  <span class="k">foreach</span><span class="p">(</span> <span class="nv">$fdf_data</span> <span class="k">as</span> <span class="nv">$key</span> <span class="o">=&gt;</span> <span class="nv">$value</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC242'>			<span class="c1">// we use string casts to prevent numeric strings from being silently converted to numbers</span></div><div class='line' id='LC243'><br/></div><div class='line' id='LC244'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;&lt;&lt; &quot;</span><span class="p">;</span> <span class="c1">// open dictionary</span></div><div class='line' id='LC245'><br/></div><div class='line' id='LC246'>			<span class="k">if</span><span class="p">(</span> <span class="nb">gettype</span><span class="p">(</span><span class="nv">$value</span><span class="p">)</span><span class="o">==</span> <span class="s1">&#39;array&#39;</span> <span class="p">)</span> <span class="p">{</span> <span class="c1">// parent; recurse</span></div><div class='line' id='LC247'>			  <span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;/T (&quot;</span><span class="o">.</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">escape_pdf_string</span><span class="p">(</span> <span class="p">(</span><span class="nx">string</span><span class="p">)</span><span class="nv">$key</span> <span class="p">)</span><span class="o">.</span><span class="s2">&quot;) &quot;</span><span class="p">;</span> <span class="c1">// partial field name</span></div><div class='line' id='LC248'>			  <span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;/Kids [ &quot;</span><span class="p">;</span>                                    <span class="c1">// open Kids array</span></div><div class='line' id='LC249'><br/></div><div class='line' id='LC250'>			  <span class="c1">// recurse</span></div><div class='line' id='LC251'>			  <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">forge_fdf_fields</span><span class="p">(</span> <span class="nv">$fdf</span><span class="p">,</span></div><div class='line' id='LC252'>					<span class="nv">$value</span><span class="p">,</span></div><div class='line' id='LC253'>					<span class="nv">$fields_hidden</span><span class="p">,</span></div><div class='line' id='LC254'>					<span class="nv">$fields_readonly</span><span class="p">,</span></div><div class='line' id='LC255'>					<span class="nv">$accumulated_name</span><span class="o">.</span> <span class="p">(</span><span class="nx">string</span><span class="p">)</span><span class="nv">$key</span><span class="p">,</span></div><div class='line' id='LC256'>					<span class="nv">$strings_b</span> <span class="p">);</span></div><div class='line' id='LC257'><br/></div><div class='line' id='LC258'>			  <span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;] &quot;</span><span class="p">;</span> <span class="c1">// close Kids array</span></div><div class='line' id='LC259'>			<span class="p">}</span></div><div class='line' id='LC260'>			<span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC261'><br/></div><div class='line' id='LC262'>			  <span class="c1">// field name</span></div><div class='line' id='LC263'>			  <span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;/T (&quot;</span><span class="o">.</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">escape_pdf_string</span><span class="p">(</span> <span class="p">(</span><span class="nx">string</span><span class="p">)</span><span class="nv">$key</span> <span class="p">)</span><span class="o">.</span><span class="s2">&quot;) &quot;</span><span class="p">;</span></div><div class='line' id='LC264'><br/></div><div class='line' id='LC265'>			  <span class="c1">// field value</span></div><div class='line' id='LC266'>			  <span class="k">if</span><span class="p">(</span> <span class="nv">$strings_b</span> <span class="p">)</span> <span class="p">{</span> <span class="c1">// string</span></div><div class='line' id='LC267'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;/V (&quot;</span><span class="o">.</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">escape_pdf_string</span><span class="p">(</span> <span class="p">(</span><span class="nx">string</span><span class="p">)</span><span class="nv">$value</span> <span class="p">)</span><span class="o">.</span><span class="s2">&quot;) &quot;</span><span class="p">;</span></div><div class='line' id='LC268'>			  <span class="p">}</span></div><div class='line' id='LC269'>			  <span class="k">else</span> <span class="p">{</span> <span class="c1">// name</span></div><div class='line' id='LC270'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;/V /&quot;</span><span class="o">.</span><span class="nv">$this</span><span class="o">-&gt;</span><span class="na">escape_pdf_name</span><span class="p">(</span> <span class="p">(</span><span class="nx">string</span><span class="p">)</span><span class="nv">$value</span> <span class="p">)</span><span class="o">.</span> <span class="s2">&quot; &quot;</span><span class="p">;</span></div><div class='line' id='LC271'>			  <span class="p">}</span></div><div class='line' id='LC272'><br/></div><div class='line' id='LC273'>			  <span class="c1">// field flags</span></div><div class='line' id='LC274'>			  <span class="nv">$this</span><span class="o">-&gt;</span><span class="na">forge_fdf_fields_flags</span><span class="p">(</span> <span class="nv">$fdf</span><span class="p">,</span></div><div class='line' id='LC275'>						  <span class="nv">$accumulated_name</span><span class="o">.</span> <span class="p">(</span><span class="nx">string</span><span class="p">)</span><span class="nv">$key</span><span class="p">,</span></div><div class='line' id='LC276'>						  <span class="nv">$fields_hidden</span><span class="p">,</span></div><div class='line' id='LC277'>						  <span class="nv">$fields_readonly</span> <span class="p">);</span></div><div class='line' id='LC278'>			<span class="p">}</span></div><div class='line' id='LC279'><br/></div><div class='line' id='LC280'>			<span class="nv">$fdf</span><span class="o">.=</span> <span class="s2">&quot;&gt;&gt; </span><span class="se">\x0d</span><span class="s2">&quot;</span><span class="p">;</span> <span class="c1">// close dictionary</span></div><div class='line' id='LC281'>		  <span class="p">}</span></div><div class='line' id='LC282'><br/></div><div class='line' id='LC283'>		<span class="p">}</span></div><div class='line' id='LC284'><br/></div><div class='line' id='LC285'><br/></div><div class='line' id='LC286'>		<span class="k">protected</span> <span class="k">function</span> <span class="nf">forge_fdf_fields_strings</span><span class="p">(</span> <span class="o">&amp;</span><span class="nv">$fdf</span><span class="p">,</span></div><div class='line' id='LC287'>					  <span class="o">&amp;</span><span class="nv">$fdf_data_strings</span><span class="p">,</span></div><div class='line' id='LC288'>					  <span class="o">&amp;</span><span class="nv">$fields_hidden</span><span class="p">,</span></div><div class='line' id='LC289'>					  <span class="o">&amp;</span><span class="nv">$fields_readonly</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC290'>		  <span class="k">return</span></div><div class='line' id='LC291'>			<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">forge_fdf_fields</span><span class="p">(</span> <span class="nv">$fdf</span><span class="p">,</span></div><div class='line' id='LC292'>					  <span class="nv">$fdf_data_strings</span><span class="p">,</span></div><div class='line' id='LC293'>					  <span class="nv">$fields_hidden</span><span class="p">,</span></div><div class='line' id='LC294'>					  <span class="nv">$fields_readonly</span><span class="p">,</span></div><div class='line' id='LC295'>					  <span class="s1">&#39;&#39;</span><span class="p">,</span></div><div class='line' id='LC296'>					  <span class="k">true</span> <span class="p">);</span> <span class="c1">// true =&gt; strings data</span></div><div class='line' id='LC297'>		<span class="p">}</span></div><div class='line' id='LC298'><br/></div><div class='line' id='LC299'><br/></div><div class='line' id='LC300'>		<span class="k">protected</span> <span class="k">function</span> <span class="nf">forge_fdf_fields_names</span><span class="p">(</span> <span class="o">&amp;</span><span class="nv">$fdf</span><span class="p">,</span></div><div class='line' id='LC301'>					<span class="o">&amp;</span><span class="nv">$fdf_data_names</span><span class="p">,</span></div><div class='line' id='LC302'>					<span class="o">&amp;</span><span class="nv">$fields_hidden</span><span class="p">,</span></div><div class='line' id='LC303'>					<span class="o">&amp;</span><span class="nv">$fields_readonly</span> <span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC304'>		  <span class="k">return</span></div><div class='line' id='LC305'>			<span class="nv">$this</span><span class="o">-&gt;</span><span class="na">forge_fdf_fields</span><span class="p">(</span> <span class="nv">$fdf</span><span class="p">,</span></div><div class='line' id='LC306'>					  <span class="nv">$fdf_data_names</span><span class="p">,</span></div><div class='line' id='LC307'>					  <span class="nv">$fields_hidden</span><span class="p">,</span></div><div class='line' id='LC308'>					  <span class="nv">$fields_readonly</span><span class="p">,</span></div><div class='line' id='LC309'>					  <span class="s1">&#39;&#39;</span><span class="p">,</span></div><div class='line' id='LC310'>					  <span class="k">false</span> <span class="p">);</span> <span class="c1">// false =&gt; names data</span></div><div class='line' id='LC311'>		<span class="p">}</span></div><div class='line' id='LC312'><br/></div><div class='line' id='LC313'><br/></div><div class='line' id='LC314'>	<span class="p">}</span></div><div class='line' id='LC315'><span class="cp">?&gt;</span><span class="x"></span></div></pre></div>
              
            
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
          <li><a href="/login/multipass?to=http%3A%2F%2Fsupport.github.com">Support</a></li>
          <li><a href="https://github.com/training">Training</a></li>
          <li><a href="http://jobs.github.com">Job Board</a></li>
          <li><a href="http://shop.github.com">Shop</a></li>
          <li><a href="https://github.com/contact">Contact</a></li>
          <li><a href="http://develop.github.com">API</a></li>
          <li><a href="http://status.github.com">Status</a></li>
        </ul>
        <ul class="sosueme">
          <li class="main">&copy; 2011 <span id="_rrt" title="0.07703s from fe2.rs.github.com">GitHub</span> Inc. All rights reserved.</li>
          <li><a href="/site/terms">Terms of Service</a></li>
          <li><a href="/site/privacy">Privacy</a></li>
          <li><a href="https://github.com/security">Security</a></li>
        </ul>
      </div>
    </div><!-- /#footer -->

    
      
      
        <!-- current locale:  -->
        <div class="locales instapaper_ignore readability-footer">
          <div class="site">

            <ul class="choices clearfix limited-locales">
              <li><span class="current">Español</span></li>
              
                  <li><a rel="nofollow" href="?locale=en">English</a></li>
              
                  <li><a rel="nofollow" href="?locale=de">Deutsch</a></li>
              
                  <li><a rel="nofollow" href="?locale=fr">Français</a></li>
              
                  <li><a rel="nofollow" href="?locale=ja">日本語</a></li>
              
                  <li><a rel="nofollow" href="?locale=pt-BR">Português (BR)</a></li>
              
                  <li><a rel="nofollow" href="?locale=ru">Русский</a></li>
              
                  <li><a rel="nofollow" href="?locale=zh">中文</a></li>
              
              <li class="all"><a href="#" class="minibutton btn-forward js-all-locales"><span><span class="icon"></span>See all available languages</span></a></li>
            </ul>

            <div class="all-locales clearfix">
              <h3>Your current locale selection: <strong>Español</strong>. Choose another?</h3>
              
              
                <ul class="choices">
                  
                      <li><a rel="nofollow" href="?locale=en">English</a></li>
                  
                      <li><a rel="nofollow" href="?locale=af">Afrikaans</a></li>
                  
                      <li><a rel="nofollow" href="?locale=ca">Català</a></li>
                  
                      <li><a rel="nofollow" href="?locale=cs">Čeština</a></li>
                  
                      <li><a rel="nofollow" href="?locale=de">Deutsch</a></li>
                  
                </ul>
              
                <ul class="choices">
                  
                      <li><a rel="nofollow" href="?locale=es">Español</a></li>
                  
                      <li><a rel="nofollow" href="?locale=fr">Français</a></li>
                  
                      <li><a rel="nofollow" href="?locale=hr">Hrvatski</a></li>
                  
                      <li><a rel="nofollow" href="?locale=hu">Magyar</a></li>
                  
                      <li><a rel="nofollow" href="?locale=id">Indonesia</a></li>
                  
                </ul>
              
                <ul class="choices">
                  
                      <li><a rel="nofollow" href="?locale=it">Italiano</a></li>
                  
                      <li><a rel="nofollow" href="?locale=ja">日本語</a></li>
                  
                      <li><a rel="nofollow" href="?locale=nl">Nederlands</a></li>
                  
                      <li><a rel="nofollow" href="?locale=no">Norsk</a></li>
                  
                      <li><a rel="nofollow" href="?locale=pl">Polski</a></li>
                  
                </ul>
              
                <ul class="choices">
                  
                      <li><a rel="nofollow" href="?locale=pt-BR">Português (BR)</a></li>
                  
                      <li><a rel="nofollow" href="?locale=ru">Русский</a></li>
                  
                      <li><a rel="nofollow" href="?locale=sr">Српски</a></li>
                  
                      <li><a rel="nofollow" href="?locale=sv">Svenska</a></li>
                  
                      <li><a rel="nofollow" href="?locale=zh">中文</a></li>
                  
                </ul>
              
            </div>

          </div>
          <div class="fade"></div>
        </div>
      
    

    <script>window._auth_token = "bddd3da882e07770b12360d6fd59701a15a31e84"</script>
    

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

    <h3>Source Code Browsing</h3>
    <div class="columns threecols">
      <div class="column first">
        <dl class="keyboard-mappings">
          <dt>t</dt>
          <dd>Activates the file finder</dd>
        </dl>
        <dl class="keyboard-mappings">
          <dt>l</dt>
          <dd>Jump to line</dd>
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

