<?php
$test = "test";
$liburl = "";

?>
<script src="/resources/quicksearch/js/bento_queries.js"></script>

<header class="header" role="banner">
  <div class="container">
    <div class="col-md-3 wsu-logo">
    <a href="http://wayne.edu"><img src="/pattern-lib/images/green_gold_wayne_left.png" class="logo wayne-left" alt="Wayne State University" /></a><a href="/"><img src="/pattern-lib/images/green_gold_lib_right.png" class="logo lib-right" alt="Wayne State University Libraries" /></a>
    </div>
    <div class="col-md-9 bento-search">
      <form action="#" onsubmit="searchCall(); return false;" class="inline-form search-form">
        <fieldset>
          <legend class="is-vishidden">Search</legend>
          <label for="search-field" class="is-vishidden">Quicksearch</label>
          <input type="search" placeholder="Find articles, books, journals, and more" id="search_string" class="search-field" x-webkit-speech="" autofocus="autofocus"/>
          <button type="submit" id="submit" class="search-submit">
            <span class="icon-search" aria-hidden="true"></span>
            <span class="is-vishidden">Search</span>
          </button>
        </fieldset>
    </form>
    </div>

    <nav id="nav" class="main-nav" role="navigation">
      <ul class="nav navbar-nav">
        <li class="home-nav"><a href="/"><span class="icon-home"></span></a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Resources</a>
          <ul class="dropdown-menu">
            <li><a href="/resources/databases">Article Databases</a></li>
            <li><a href="http://wayne.summon.serialssolutions.com/">Catalog</a></li>
            <li><a href="http://elibrary.wayne.edu/">Classic Catalog</a></li>
            <li><a href="http://digital.library.wayne.edu/">Digital Collections</a></li>
            <li><a href="http://digitalcommons.wayne.edu/">Digital Commons</a></li>
            <li><a href="/resources/ebooks">E-Books</a></li>
            <li><a href="/resources/journals">E-Journals</a></li>
            <li><a href="http://guides.lib.wayne.edu/content.php?pid=248390">Reference Tools</a></li>
            <li><a href="/resources/guides">Research Guides</a></li>
            <li><a href="/resources/special">Special Collections</a></li>
            <li class="divider hidden-xs"></li>
            <li class="hidden-xs"><a href="/resources">All Resources</a></li>
          </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Services</a>
          <ul class="dropdown-menu">
            <li><a href="/services/help">Ask-A-Librarian</a></li>
            <li><a href="/services/borrowing">Borrowing</a></li>
            <li><a href="/services/classroom">Classroom Support</a></li>
            <li><a href="/services/computing">Computing</a></li>
            <li><a href="http://copyright.wayne.edu/">Copyright@Wayne</a></li>
            <li><a href="/services/events">Events Support</a></li>
            <li><a href="/services/research">Faculty/Grad Research Support</a></li>
            <li><a href="https://wayne.illiad.oclc.org/illiad/illiad.dll">Interlibrary Loan</a></li>
            <li><a href="/services/instruction">Instruction</a></li>
            <li><a href="/services/reserves">Reserves</a></li>
            <li><a href="/services/rooms">Room Reservations</a></li>
            <li><a href="http://scholarscooperative.wayne.edu/">Scholars Cooperative</a></li>
            <li class="divider hidden-xs"></li>
            <li class="hidden-xs"><a href="/services">All Services</a></li>
          </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Libraries</a>
          <ul class="dropdown-menu">
            <li><a href="/neef">Neef Law Library</a></li>
            <li><a href="/pk">Purdy/Kresge Library</a></li>
            <li><a href="http://www.reuther.wayne.edu">Reuther Library</a></li>
            <li><a href="/shiffman">Shiffman Medical Library</a></li>
            <li><a href="/ugl">Undergraduate Library</a></li>
            <li class="divider hidden-xs"></li>
            <li><a href="/info/about">About</a></li>
            <li><a href="http://www.lib.wayne.edu/lab">App Lab</a></li>
            <li><a href="/info/staff">Contact Info/Staff Directory</a></li>
            <li><a href="/info/hours">Hours</a></li>
            <li><a href="/info/maps">Maps and Directions</a></li>
            <li><a href="http://www.lib.wayne.edu/blog">News</a></li>
            <li><a href="/info/policies">Policies</a></li>
            <li class="divider hidden-xs"></li>
            <li class="hidden-xs"><a href="/info">All Information</a></li>
          </ul>
        </li>
        <li><a href="/services/help/">Help</a></li>
      </ul>
      <ul class="nav navbar-right">
        <li class="login-nav"><a href="#"><span class="icon-user"></span> Log In</a></li>
        <li><a href="http://elibrary.wayne.edu/patroninfo"><span class="icon-book"></span> Renew Books</a></li>
      </ul>
    </nav>
  </div>

  <div id="functionmenu" class="col-md-12 login-options">
    <div class="container">
      <div id="wsulinks">
        <a href="http://pipeline.wayne.edu">Pipeline</a>
        <a href="http://blackboard.wayne.edu">Blackboard</a>
        <a href="http://webmail.wayne.edu">Webmail</a>
      </div>
      <div id="secondarylinks">
        <ul class="login-nav">
          <li><a href="http://elibrary.wayne.edu/patroninfo">My Library Account</a></li>
          <li><a href="https://apps.med.wayne.edu/ssonew/?actionUrl=http://apps.med.wayne.edu/ureserve/">SoM Study Room Reservation</a></li>
          <li><a href="http://owa.med.wayne.edu/">SOM</a></li>
          <li><a href="http://www.dmc.org/staff">DMC</a></li>
          <li><a href="http://intrasource.karmanos.org/">Karmanos</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>
<!-- beta banner -->
      <style type="text/css">
        .feedback {
      background:rgba(255, 204, 51, 0.7);
      padding:5px;
      text-align: center;
      font-weight: bold;
    }
    </style>
      <div class="feedback">This is a beta site. Take it for a ride. <a href="https://waynestate.az1.qualtrics.com/SE/?SID=SV_2tXpXzf5WzDnW3X">Please give us feedback</a></div>
      <!-- beta banner -->
