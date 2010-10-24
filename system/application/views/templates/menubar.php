<?
$base_url = base_url();

?>
<? if (isValidUser()) { ?>
<div id="menubar" class="box">
    <div class="box-right"><div class="box-left">
        <div class="box-top">
            <div class="right"><div class="left"><span></span></div></div>
        </div>
        <div class="box-content">
        
            <ul class="menu"><?
            
            foreach($views as $view)
            {
                $selected = "";
                if ($view["selected"])
                {
                    $selected = " class=\"selected\"";
                }
                echo "<li><a href=\"/dashboard/{$view['name']}\"$selected>{$view['display']}</a></li>";
            }
            
            $selected = "";
            if ($method == "settings")
            {
                $selected = " class=\"selected\"";
            }
            echo "<li><a href=\"/dashboard/settings\"$selected>Settings</a></li>";
            
            ?></ul>
        
        </div>
        <div class="box-bottom">
            <div class="right"><div class="left"><span></span></div></div>
        </div>
    </div></div>
</div>
<? } else { ?>
<div id="menubar">
    <div class="box">
        <div class="box-right"><div class="box-left">
            <div class="box-top">
                <div class="right"><div class="left"><span></span></div></div>
            </div>
            <div class="box-content">

                <ul class="menu"><!--
                    --><li><a href="/">Home</a></li><!--
                    --><li><a href="/">Sign Up</a></li><!--
                --></ul>

            </div>
            <div class="box-bottom">
                <div class="right"><div class="left"><span></span></div></div>
            </div>
        </div></div>
    </div>
    <br />
    <h2>Demo:</h2>
    <div class="box">
        <div class="box-right"><div class="box-left">
            <div class="box-top">
                <div class="right"><div class="left"><span></span></div></div>
            </div>
            <div class="box-content">

                <ul class="menu"><!--
                    --><li><a href="/dashboard">Overview</a></li><!--
                    --><li><a href="/dashboard/sources">Sources</a></li><!--
                    --><li><a href="/dashboard/visitors">Visitors</a></li><!--
                    --><li><a href="/dashboard/tools">Tools</a></li><!--
                    --><li><a href="/dashboard/settings">Settings</a></li><!--
                --></ul>

            </div>
            <div class="box-bottom">
                <div class="right"><div class="left"><span></span></div></div>
            </div>
        </div></div>
    </div>
</div>
<? } ?>
