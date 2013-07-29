<?php

function fct_passwd( $chrs = "")
{
   if( $chrs == "" ) $chrs = 8;
   $chaine = "";

   $list = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz!*$#|%";
   mt_srand((double)microtime()*1000000);
   $newstring="";

   while( strlen( $newstring )< $chrs ) {
   $newstring .= $list[mt_rand(0, strlen($list)-1)];
   }
   return $newstring;
 }


function makesize($bytes) {
  if (abs($bytes) < 1000 * 1024)
    return number_format($bytes / 1024, 2) . " Ko";
  if (abs($bytes) < 1000 * 1048576)
    return number_format($bytes / 1048576, 2) . " Mo";
  if (abs($bytes) < 1000 * 1073741824)
    return number_format($bytes / 1073741824, 2) . " Go";
    return number_format($bytes / 1099511627776, 2) . " To";
}

// IP Validation
function validip($ip)
{
    if (!empty($ip) && $ip==long2ip(ip2long($ip)))
    {
        // reserved IANA IPv4 addresses
        // http://www.iana.org/assignments/ipv4-address-space
        $reserved_ips = array (
                array('0.0.0.0','2.255.255.255'),
                array('10.0.0.0','10.255.255.255'),
                array('127.0.0.0','127.255.255.255'),
                array('169.254.0.0','169.254.255.255'),
                array('172.16.0.0','172.31.255.255'),
                array('192.0.2.0','192.0.2.255'),
                array('192.168.0.0','192.168.255.255'),
                array('255.255.255.0','255.255.255.255')
        );

        foreach ($reserved_ips as $r)
        {
                $min = ip2long($r[0]);
                $max = ip2long($r[1]);
                if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
        }
        return true;
    }
    else return false;
}

function getip() {
   if (isset($_SERVER["HTTP_CLIENT_IP"])) {
    if (validip($_SERVER["HTTP_CLIENT_IP"])) {
       return $_SERVER["HTTP_CLIENT_IP"];
     }
   }
   if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
     foreach (explode(",",$_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
       if (validip(trim($ip))) {
           return $ip;
       }
     }
   }
   if (validip(isset($_SERVER["HTTP_X_FORWARDED"])?$_SERVER["HTTP_X_FORWARDED"]:'127.0.0.1')) {
       return $_SERVER["HTTP_X_FORWARDED"];
   } elseif (validip(isset($_SERVER["HTTP_FORWARDED_FOR"])?$_SERVER["HTTP_FORWARDED_FOR"]:'127.0.0.1')) {
       return $_SERVER["HTTP_FORWARDED_FOR"];
   } elseif (validip(isset($_SERVER["HTTP_FORWARDED"])?$_SERVER["HTTP_FORWARDED"]:'127.0.0.1')) {
       return $_SERVER["HTTP_FORWARDED"];
   } elseif (validip(isset($_SERVER["HTTP_X_FORWARDED"])?$_SERVER["HTTP_X_FORWARDED"]:'127.0.0.1')) {
       return $_SERVER["HTTP_X_FORWARDED"];
   } else {
       return $_SERVER["REMOTE_ADDR"];
   }
}


function textbbcode($form,$name,$content="",$print=true) {
$return="<script language=\"javascript\"  type=\"text/javascript\">

// Remember the current position.
function storeCaret(text)
{
    // Only bother if it will be useful.
    if (typeof(text.createTextRange) != \"undefined\")
        text.caretPos = document.selection.createRange().duplicate();
}

function SmileIT(smile,textarea){
    // Attempt to create a text range (IE).
    if (typeof(textarea.caretPos) != \"undefined\" && textarea.createTextRange)
    {
        var caretPos = textarea.caretPos;

        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? smile + ' ' : smile
        caretPos.select();
    }
    // Mozilla text range replace.
    else if (typeof(textarea.selectionStart) != \"undefined\")
    {
        var begin = textarea.value.substr(0, textarea.selectionStart);
        var end = textarea.value.substr(textarea.selectionEnd);
        var scrollPos = textarea.scrollTop;

        textarea.value = begin + smile + end;

        if (textarea.setSelectionRange)
        {
            textarea.focus();
            textarea.setSelectionRange(begin.length + smile.length, begin.length + smile.length);
        }
        textarea.scrollTop = scrollPos;
    }
    // Just put it on the end.
    else
    {
        textarea.value += smile;
        textarea.focus(textarea.value.length - 1);
    }
}

function PopMoreSmiles(form,name) {
         link='moresmiles.php?form='+form+'&text='+name
         newWin=window.open(link,'moresmile','height=500,width=300,resizable=yes,scrollbars=yes');
         if (window.focus) {newWin.focus()}
}
function BBTag(opentag, closetag, textarea)
{
    // Can a text range be created?
    if (typeof(textarea.caretPos) != \"undefined\" && textarea.createTextRange)
    {
        var caretPos = textarea.caretPos, temp_length = caretPos.text.length;

        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? opentag + caretPos.text + closetag + ' ' : opentag + caretPos.text + closetag;

        if (temp_length == 0)
        {
            caretPos.moveStart(\"character\", -closetag.length);
            caretPos.moveEnd(\"character\", -closetag.length);
            caretPos.select();
        }
        else
            textarea.focus(caretPos);
    }
    // Mozilla text range wrap.
    else if (typeof(textarea.selectionStart) != \"undefined\")
    {
        var begin = textarea.value.substr(0, textarea.selectionStart);
        var selection = textarea.value.substr(textarea.selectionStart, textarea.selectionEnd - textarea.selectionStart);
        var end = textarea.value.substr(textarea.selectionEnd);
        var newCursorPos = textarea.selectionStart;
        var scrollPos = textarea.scrollTop;

        textarea.value = begin + opentag + selection + closetag + end;

        if (textarea.setSelectionRange)
        {
            if (selection.length == 0)
                textarea.setSelectionRange(newCursorPos + opentag.length, newCursorPos + opentag.length);
            else
                textarea.setSelectionRange(newCursorPos, newCursorPos + opentag.length + selection.length + closetag.length);
            textarea.focus();
        }
        textarea.scrollTop = scrollPos;
    }
    // Just put them on the end, then.
    else
    {
        textarea.value += opentag + closetag;
        textarea.focus(textarea.value.length - 1);
    }
}
</script>

 <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td colspan=2>
      <table cellpadding=\"0\" cellspacing=\"1\">
      <tr>
      <td><input style=\"font-weight: bold;\" type=\"button\" name=\"bold\" value=\"B \" onclick=\"javascript: BBTag('[b]','[/b]',document.forms.$form.$name)\" /></td>
      <td><input style=\"font-style: italic;\" type=\"button\" name=\"italic\" value=\"i \" onclick=\"javascript: BBTag('[i]','[/i]',document.forms.$form.$name)\" /></td>
      <td><input style=\"text-decoration: underline;\" type=\"button\" name=\"underline\" value=\"U \" onclick=\"javascript: BBTag('[u]','[/u]',document.forms.$form.$name)\" /></td>
      <td><input type=\"button\" name=\"li\" value=\"List \" onclick=\"javascript: BBTag('[*]','',document.forms.$form.$name)\" /></td>
      <td><input type=\"button\" name=\"code\" value=\"Code\" onclick=\"javascript: BBTag('[code]','[/code]',document.forms.$form.$name)\" /></td>
      <td><input type=\"button\" name=\"quote\" value=\"Quote\" onclick=\"javascript: BBTag('[quote]','[/quote]',document.forms.$form.$name)\" /></td>
      <td><input type=\"button\" name=\"url\" value=\"Url\" onclick=\"javascript: BBTag('[url]','[/url]',document.forms.$form.$name)\" /></td>
      <td><input type=\"button\" name=\"img\" value=\"Img\" onclick=\"javascript: BBTag('[img]','[/img]',document.forms.$form.$name)\" /></td>
      <td>
<select onchange=\"BBTag('[color=' + this.options[this.selectedIndex].value.toLowerCase() + ']','[/color]',document.forms.$form.$name); this.selectedIndex = 0;\" size=\"1\" style=\"background-color:#DEDEDE;\" name=\"fontchange\">
            <option value=\"\" selected=\"selected\">Color</option>
            <option value=\"Black\" style=\"color:black\">Black</option>
            <option value=\"Red\" style=\"color:red\">Red</option>
            <option value=\"Yellow\" style=\"color:Yellow\">Yellow</option>
            <option value=\"Pink\" style=\"color:Pink\">Pink</option>
            <option value=\"Green\" style=\"color:Green\">Green</option>
            <option value=\"Orange\" style=\"color:Orange\">Orange</option>
            <option value=\"Purple\" style=\"color:Purple\">Purple</option>
            <option value=\"Blue\" style=\"color:Blue\">Blue</option>
            <option value=\"Beige\" style=\"color:Beige\">Beige</option>
            <option value=\"Brown\" style=\"color:Brown\">Brown</option>
            <option value=\"Teal\" style=\"color:Teal\">Teal</option>
            <option value=\"Navy\" style=\"color:Navy\">Navy</option>
            <option value=\"Maroon\" style=\"color:Maroon\">Maroon</option>
            <option value=\"LimeGreen\" style=\"color:LimeGreen\">Lime Green</option>
            </select>
      </td>
      <td>
            <select onchange=\"BBTag('[size=' + this.options[this.selectedIndex].value.toLowerCase() + ']','[/size]', document.forms.$form.$name); this.selectedIndex = 0;\" size=\"1\" style=\"background-color:#DEDEDE;\" name=\"fontchange\">
            <option value=\"\" selected=\"selected\">Font Size</option>
            <option value=\"1\">xx-small</option>
            <option value=\"2\">x-small</option>
            <option value=\"3\">small</option>
            <option value=\"4\">medium</option>
            <option value=\"5\">large</option>
            <option value=\"6\">x-large</option>
            <option value=\"7\">xx-large</option>
            </select>
      </td>
      </tr>
      </table>
      </td>
    </tr>
    <tr>
      <td>
      <textarea name=\"$name\" rows=\"10\" cols=\"40\" onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\" onchange=\"storeCaret(this);\">$content</textarea>
      </td>
      <td>
      <table width=\"100%\" cellpadding=\"1\" cellspacing=\"1\">";
      global $smilies, $count;
      while ((list($code, $url) = each($smilies)) && $count<20) {
         if ($count % 4==0)
            $return.="<tr>";

            $return.="\n<td><a href=\"javascript: SmileIT('".str_replace("'","\'",$code)."',document.forms.".$form.".".$name.");\"><img border=0 src=images/smilies/".$url."></a></td>";
            $count++;

         if ($count % 4==0)
            $return.="</tr>";
      }

      $return.="</table>
      <center><a href=\"javascript: PopMoreSmiles('$form','$name')\">".MORE_SMILES."</a></center>
      </td>
    </tr>
  </table>";
if($print)
print($return);
else
return $return;
}

function get_elapsed_time($ts)
{
  $mins = floor((time() - $ts) / 60);
  $hours = floor($mins / 60);
  $mins -= $hours * 60;
  $days = floor($hours / 24);
  $hours -= $days * 24;
  $weeks = floor($days / 7);
  $days -= $weeks * 7;
  $t = "";
  if ($weeks > 0)
    return "$weeks semaine" . ($weeks > 1 ? "s" : "");
  if ($days > 0)
    return "$days jour" . ($days > 1 ? "s" : "");
  if ($hours > 0)
    return "$hours heure" . ($hours > 1 ? "s" : "");
  if ($mins > 0)
    return "$mins min" . ($mins > 1 ? "s" : "");
  return "< 1 min";
}


function buildTreeArray($files)
{
    $ret = array();

    foreach ($files as $k => $v)
    {
        $filename=$v['filename'];

        $parts = preg_split('/\//', $filename, -1, PREG_SPLIT_NO_EMPTY);
        $leaf = array_pop($parts);

        // build parent structure
        $parent = &$ret;
        foreach ($parts as $part)
        {
                $parent = &$parent[$part];
        }

        if (empty($parent[$leaf]))
        {
                $v['filename']=$leaf;
                $parent[$leaf] = $v;
        }
    }

    return $ret;
}


function outputTree($files, $indent=1)
{
    echo "<table style=\"font-size: 7pt; width: 100%;\"";

    foreach($files as $k=>$v)
    {
        $entry=isset($v['filename']) ? $v['filename'] : $k;
        $size=$v['size'];

        if($indent==0)
        {
            // root
            $is_folder=true;
        }
        elseif(is_array($v) && (!array_key_exists('filename',$v) && !array_key_exists('size',$v)))
        {
            // normal node
            $is_folder=true;
        }
        else
        {
            // leaf node, i.e. a file
        $is_folder=false;
        }

        if($is_folder)
        {
            // we could output a folder icon here
        }
        else
        {
            // we could output an appropriate icon
            // based on file extension here
            $ext=pathinfo($entry,PATHINFO_EXTENSION);
        }

        echo "<tr><td style=\"border: 1px solid #D2D2D2;\">";
        echo $entry; // output folder name or filename

        if(!$is_folder)
        {
            // if it’s not a folder, show file size
            echo " (".makesize($size).")";
        }

        echo "</td></tr>";
 
        if(is_array($v) && $is_folder)
        {
            outputTree($v, ($indent+1));
        }
    }

    echo "</table>";
}


function unesc($x) {
    if (get_magic_quotes_gpc())
        return stripslashes($x);
    return $x;
}


// this returns all the categories
function categories($val="")
{
    echo "<select name='categorietorrent'><option value='0'>----</option>";
    $c_q = mysql_query("SELECT * FROM categories");
    while($c = mysql_fetch_array($c_q))
    {
        $cid = $c["nomcat"];
        $name = unesc($c["nomcat"]);

        $checked = "";
        if($cid == $val){ $checked = "selected"; }
        echo "<option $checked value='$cid'>$name</option>";
    }
    echo "</select>";
}


// this returns all the licences
function licences($val="")
{
    echo "<select name='licencetorrent'><option value='0'>----</option>";
    $c_q = mysql_query("SELECT * FROM licences");
    while($c = mysql_fetch_array($c_q))
    {
        $cid = $c["lnom"];
        $name = unesc($c["lnom"]);

        $checked = "";
        if($cid == $val){ $checked = "selected"; }
        echo "<option $checked value='$cid'>$name</option>";
    }
    echo "</select>";
}


?>
