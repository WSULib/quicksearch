<div id="toptabcontent" class="clearfix" >
    <div class="topSearchBox">
    <form action="pre-results.php">
    <p>
        <input type="text" name="lookfor" style="width: 350px;" id="lookfor" value=""/>  
        <input type="hidden" name="expander" value="fulltext" />
        <input type="hidden" name="s" value="y"/>
        
        <select name="type">
        <option id="type-keyword" name="type" value="keyword"  >Keyword</option>
        <option id="type-author" name="type" value="Author" >Author</option>
        <option id="type-title" name="type" value="title" >Title</option>     
        </select>
        <input type="submit" value="Search" />
        
    </p>
    </form>
    </div>
    <div class="loginform">
        <h2 style="font-size: ">Login</h2>
        <?php if($fail == 'y'){ ?>
        <div class="loginfailed">Invalid login -- pleasae try again</div>
        <?php } ?>
<form action="auth.php" method="post">
    <table>
        <tr><td><label style="font-size: 80%"><b>Username:</b> </label></td><td><input tyep="text" name="userId" value="" /></td></tr>
        <tr><td><label style="font-size: 80%"><b>Password:</b> </label></td><td><input type="password" name="password" value="" /></td></tr>              
        <input type="hidden" name="expander" value="<?php echo $expander?>"/>
        <input type="hidden" value="<?php echo $path?>" name="path"/>
        <tr><td></td><td><input type="submit" value="Login" /></td></tr>
        <?php if($path == "PDF"){ ?>
        <tr>
            <td><input type="hidden" value="<?php echo $db ?>" name ="db" /></td>
            <td><input type="hidden" value="<?php echo $an ?>" name="an" /></td>
        </tr>
        <?php } ?>
        <?php if($path == "results" || $path == 'box'){ ?>
        <tr>
            <td><input type="hidden" value="<?php echo $query ?>" name ="query" /></td>
            <td><input type="hidden" value="<?php echo $fieldCode?>" name="fieldcode"/></td>
        </tr>
        <?php } ?>
          <?php if($path == "record"||$path=="HTML"){ ?>
        <tr>
            <td><input type="hidden" value="<?php echo $db ?>" name ="db" /></td>
            <td><input type="hidden" value="<?php echo $query ?>" name="query"/></td>
            <td><input type="hidden" value="<?php echo $fieldCode?>" name="fieldcode"/></td>
            <td><input type="hidden" value="<?php echo $highlight?>" name="highlight"/></td>
            <td><input type="hidden" value="<?php echo $an ?>" name="an" /></td>
            <td><input type="hidden" value="<?php echo $resultId ?>" name="resultId" /></td>
            <td><input type="hidden" value="<?php echo $recordCount ?>" name="recordCount" /></td>
            <td><input type="hidden" value="<?php echo $f ?>" name="f" /></td>
            <td><input type="hidden" value="<?php echo $bn?>" name="bn"/></td>
        </tr>
        <?php } ?>
    </table>
</form>
    </div>
    
</div>

