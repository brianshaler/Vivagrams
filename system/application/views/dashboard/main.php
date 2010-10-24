<h3>Dashboard</h3>
<div style="width: 100%;">
<?
for ($i=0; $i<count($view["columns"]); $i++)
{
    $column = $view["columns"][$i];
    $pad = "";
    if ($i != 0) { $pad .= " dashboard-widget-column-pad-left"; }
    if ($i != count($view["columns"])-1) { $pad .= " dashboard-widget-column-pad-right"; }
    echo "<div class=\"dashboard-widget-column$pad\" style='width: ".$column["width"]."; float: left;'>";
    foreach ($column["widgets"] as $widget)
    {
        echo "<div class=\"dashboard-widget\">";
        echo "<h1>";
        echo $widget;
        echo "</h1>";
        echo "</div>";
    }
    echo "</div>";
}
?>
</div>